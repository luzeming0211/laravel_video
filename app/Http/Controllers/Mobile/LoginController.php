<?php


namespace App\Http\Controllers\Mobile;

use App\Model\Mail;
use App\Model\Reg_code;
use App\Model\User;
use App\Model\User_vip;
use App\Model\Wechat_user;
use App\Services\ComService;
use App\Services\SendMailService;
use Gregwar\Captcha\CaptchaBuilder;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    public function bind(Request $request){
        if(!ComService::is_weixin()){
            return redirect('/mobile/index');
        }
        if(ComService::is_weixin()){
            $user = Wechat_user::get_wechat_user();
            if(empty($user)){
                $app = app('wechat.official_account');
                if (!$request->session()->exists('wechat_user')) {
                    $response = $app->oauth->scopes(['snsapi_userinfo'])
                        ->redirect();
                    echo $response; die();
                }
            }
        }
            $msg= '';
        if ($request->isMethod('post')) {
            $data = $request->input();
            $res = User::validateIdentify($data['email'], $data['password']);
            if($res){
                $user= User::getUser($data['email']);
                if(!empty($user)){
                    $user['userid'] = $user->userid;
                    $user['username'] = $user->name;
                    Session()->put('user', $user);
                    $data = Session()->get('wechat_user');
                    Wechat_user::bindWeChatUser($data->id, $user);
                    return redirect('/');
                }
            }else{
                return back()->withErrors('用户名或者密码错误')->withInput();
            }
        }
        return view('mobile.login.bind' ,compact('msg'));
    }

    //登录页面
    public function login(Request $request)
    {
        if(Session::exists('user')){
            return redirect('/');
        }
        if($request->method() == 'GET'){
            $ref_url = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:'http://boser1u.top';
            if($ref_url == 'http://boser1u.top/moblie/login' || empty($ref_url)){
                $ref_url = 'http://boser1u.top';
            }
            $data = $request->input();
            if(empty($data)){
                $msg = '请登录';
            }else{
                $msg = $data['msg'];
            }
            return view('mobile.login.login' ,compact('msg','openid','ref_url'));
        }
        if ($request->isMethod('post')) {
            $data = $request->input();
            $ref_url = substr($data['ref_url'],18);
            $res = User::validateIdentify($data['email'], $data['password']);
            if($res){
                $user= User::getUser($data['email']);
                if(!empty($user)){
                    $user['userid'] = $user->userid;
                    $user['username'] = $user->name;
                    Session()->put('user', $user);
                    return redirect($ref_url);
                }
            }else{
                return back()->withErrors('用户名或者密码错误')->withInput();
            }
        }
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = User::addUserValidate($request->input());
            if ($validator->fails()) {
                $msg = $validator->errors()->first();
                return back()->with('error',$msg )->withInput();die();
            }
            $userid = User::addUser($request->name, $request->email, $request->password);
            //生成验证码
            $builder = new CaptchaBuilder();
            $builder->build(150,32);
            $code = $builder->getPhrase();
            //注册插入email code
            Reg_code::addCode($userid, $code, 'wap');
            //发送邮件
            try{
                SendMailService::send($code, $request->email ,'注册验证码');
            }catch (Exception $e){
                User::delUserById($userid);
                User_vip::delUserVipByid($userid);
                return back()->with('error','邮箱有误请您输入正确的邮箱地址' )->withInput();
            }
            session()->put('reg_userid',$userid);
            return Redirect::to('/mobile/code?msg=请输入邮箱验证码');
        }
        if(Session::has('reg_userid')){
            return Redirect::to('/mobile/code?msg=请输入邮箱验证码');
        }
        return view('mobile.login.reg');

    }
    public function bind_reg(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = User::addUserValidate($request->input());
            if ($validator->fails()) {
                $msg = $validator->errors()->first();
                return back()->with('error',$msg )->withInput();
            }
            $userid = User::addUser($request->name, $request->email, $request->password);
            //生成验证码
            $builder = new CaptchaBuilder();
            $builder->build(150,32);
            $code = $builder->getPhrase();
            //注册插入email code
            Reg_code::addCode($userid, $code, 'wap');
            //发送邮件
            try{
                SendMailService::send($code, $request->email,'注册验证码');
            }catch (Exception $e){
                User::delUserById($userid);
                User_vip::delUserVipByid($userid);
                return back()->with('error','邮箱有误请您输入正确的邮箱地址' )->withInput();
            }
            session()->put('reg_userid',$userid);
            return Redirect::to('/mobile/code?msg=请输入邮箱验证码');
        }
        if(Session::has('reg_userid')){
            return Redirect::to('/mobile/code?msg=请输入邮箱验证码');
        }
        return view('mobile.login.bind_reg');

    }

    public function code(Request $request)
    {
        if ($request->isMethod('post')) {
            $code = $request->input('code');
            $userid = $request->input('userid');
            if(empty($code) || empty($userid)){
                return view('errors.503',['error' =>'验证码为空']);
            }
            $userid = Reg_code::check_code($userid, $code);
            if($userid){
                User::editUserFlag($userid);
                User_vip::addUserVipInit($userid);
                Mail::addMailByUserId($userid ,'感谢您注册Hydrogen学院，我们会为您提供丰富的知识');
                if(ComService::is_weixin()){
                    return redirect('/mobile/bind');
                }else{
                    return redirect('/mobile/login');
                }
            }else{
                return view('errors.503',['error' =>'验证码不正确，或者过期']);
            }
        }else{
            if(session()->exists('user')){
                return redirect()->back();
            }
            $userid = session()->get('reg_userid');
            if(empty($userid)){
                return view('errors.503',['error' =>'您的验证已经超时，请重新注册','url' => '/mobile/reg']);
            }
            return view('mobile.login.code',compact('userid'));
        }
    }
}