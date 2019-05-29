<?php


namespace App\Http\Controllers\Ident\Front;

use App\Model\Forget_code;
use App\Model\Login_log;
use App\Model\Mail;
use App\Model\Reg_code;
use App\Model\User;
use App\Model\User_vip;
use App\Model\Wechat_user;
use Exception;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;


use App\Services\SendMailService;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function reg_new(Request $request){
        if(Session::has('reg_userid')){
            return Redirect::to('/code');
        }
        return view('front.reg');
    }
    public function login_new(Request $request){
        if (Session()->exists('user')) {
            return Redirect::to('/');
        }
        $ref_url = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:'http://boser1u.top';
        if($ref_url == 'http://boser1u.top/login'){
            $ref_url = 'http://boser1u.top';
        }
        $app = app('wechat.official_account');
        $result = $app->qrcode->temporary('scan', 3600);
        $ticket = $result['ticket'];
        $url = $app->qrcode->url($ticket);
        Login_log::addLoginLog($ticket);
        return view('front.login',compact('url','ticket','ref_url'));
    }
    //登录页面
    public function login_do(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            $login['email'] = $data['email'];
            $login['password'] = $data['password'];
            $validator = User::validateLogin($login);
            if ($validator->fails()) {
                return json_encode(['fail'=>1,'msg'=>$validator->errors()->first()]);
            }
            $res = User::check_pwd($login['email'], $login['password']);
            if($res){
                $user= User::getUser($login['email']);
                if(!empty($user)){
                  $user['userid'] = $user->userid;
                  $user['username'] = $user->name;
                  Session()->put('user', $user);
                  return json_encode(['success' => 1, 'msg' => '登录成功']);
                }
            }else{
                return json_encode(['fail'=>1,'msg'=>'用户名或密码错误'.rand(1,9)]);
            }
        }
    }
    //微信扫码登录
    public function is_login(Request $request)
    {
        if($request->ajax()) {
            $ticket = $request->input('ticket');
            $openid =  Login_log::getOpenIdByTicket($ticket);
            if(!empty($openid)){
                $wechat_user_info = Wechat_user::getBindWechatUser($openid);
                if(!empty($wechat_user_info)){
                    $user['userid']  = $wechat_user_info-> userid;
                    $user['username'] = $wechat_user_info-> nickname;
                    Session()->put('user', $user);
                    return response()->json($user['userid']);
                }
            }else{
                return response()->json(null);
            }
        }
    }
    //退出登录
    public function logout()
    {
        if (Session()->exists('user')) {
            Session()->forget('user');
        }
        return Redirect::to('/');
    }

    public function reg_do(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = User::addUserValidate($request->input());
            if ($validator->fails()) {
                return json_encode(['fail'=>1,'msg'=>$validator->errors()->first()]);
            }
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $userid = User::addUser($name, $email, $password);
            //生成验证码
            $builder = new CaptchaBuilder();
            $builder->build(150,32);
            $code = $builder->getPhrase();
            //注册插入email code
            Reg_code::addCode($userid, $code, 'web');
            //发送邮件
            try{
                SendMailService::send($code, trim($request->email),'注册验证码');
            }catch (Exception $e){
                User::delUserById($userid);
                User_vip::delUserVipByid($userid);
                return json_encode(['fail'=>1,'msg'=>'邮箱有误请您输入正确的邮箱地址']);
            }
            session()->put('reg_userid',$userid);
            if($userid){
                return json_encode(['success' => 1, 'msg' => '注册成功']);
            }else{
                return json_encode(['fail' => 0, 'msg' => '注册失败']);
            }
        }

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
                Session()->forget('reg_userid');
                Mail::addMailByUserId($userid ,'感谢您注册Hydrogen学院，我们会为您提供丰富的知识');
                return redirect('/login');
            }else{
                return view('errors.503',['error' =>'验证码不正确，或者过期']);
            }
        }
        if(session()->exists('user')){
            return redirect()->back();
        }
        $userid = session()->get('reg_userid');
        if(empty($userid)){
            return view('errors.503',['error' =>'您的验证已经超时，请重新注册','url' => '/reg']);
        }
        return view('front.code',compact('userid'));
    }
    public function  forget(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->input('email');
            $f_code = $request->input('f_code');
            if(empty($email) || empty($f_code)){
                return view('errors.503',['error' =>'邮箱或验证码信息有误']);
            }
            $email = Forget_code::checkForgetCode($email ,$f_code);
            if(is_null($email)){
                return view('errors.503',['error' =>'验证码错误或者已经过期']);
            }
            return view('front.pwd',compact('email'));
        }
        if(session()->exists('user')){
            return redirect('/');
        }
        return view('front.forget');
    }
    public function  getForgetCode(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->input('email');
            $res = User::getUserByEmail($email);
            if(is_null($res)){
                return json_encode(['fail'=>true,'msg'=>'此邮箱地址不存在']);
            }
            //生成验证码
            $builder = new CaptchaBuilder();
            $builder->build(150,32);
            $code = $builder->getPhrase();
            //忘记密码 code
            Forget_code::addForgetCode($email, $code, 'web');
            //发送邮件
            try{
                SendMailService::send($code, $request->email, '忘记密码验证');
            }catch (Exception $e){
                return json_encode(['fail'=>true,'msg'=>'邮箱有误请您输入正确的邮箱地址']);
            }
            return json_encode(['success'=>true,'msg'=>'发送忘记密码邮箱成功']);
        }
    }
    public function  editPwd(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->input('email');
            $pwd = $request->input('pwd');
            $conf_pwd = $request->input('conf_pwd');
            if(strlen($pwd) < 6 || strlen($pwd) >18 ){
                return view('errors.503',['error' =>'密码长度请在6到18位之间']);
            }
            if($pwd != $conf_pwd){
                return view('errors.503',['error' =>'两次密码不一致']);
            }
            $res = User::editPwd($email , $pwd);
            if($res){
                return redirect('/login');
            }
        }
    }
}