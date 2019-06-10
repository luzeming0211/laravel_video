<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Model\Pay_init_log;
use App\Model\Pay_log;
use App\Model\User_vip;
use App\Services\ComService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Yansongda\Pay\Log;
use Yansongda\Pay\Pay;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class AliPayController extends Controller
{
    protected $config = [
    'app_id' => '',
    'notify_url' => '',
    'return_url' => '',
    'ali_public_key' => '',
    // 加密方式： **RSA2**
    'private_key' => '=',
    'log' => [ // optional
        'file' => './logs/alipay.log',
        'level' => 'debug', // 建议生产环境等级调整为 info，开发环境为 debug
        'type' => 'daily', // optional, 可选 daily.
        'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
    ],
    'http' => [ // optional
        'timeout' => 50.0,
        'connect_timeout' => 50.0,
        // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
    ],
    'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
];


    public function index(Request $request)
    {
        $user = self::get_user();
        $userid = $user['userid'];
        $username = $user['username'];
        if ($request->isMethod('POST')) {
            $pay_init_log['userid']    = $request->input('userid');
            $pay_init_log['username']  = $request->input('username');
            $pay_init_log['pay_money'] = $request->input('pay_money');
            $month_num = intval($pay_init_log['pay_money']/10);
            $out_trade_no = time();
            $pay_init_log['out_trade_no'] = $out_trade_no;
            $pay_init_log['created_at'] = date('Y-m-d H:i:s', time());
            Pay_init_log::insert($pay_init_log);
            $order = [
                'out_trade_no' => $out_trade_no,
                'total_amount' => $pay_init_log['pay_money'],
                'subject' => 'hydrogen会员'.$month_num.'个月',
            ];
            if (ComService::isMobile()){
                $alipay = Pay::alipay($this->config)->wap($order);
            }else{
                $alipay = Pay::alipay($this->config)->web($order);
            }
            return $alipay;
        }
        if(ComService::is_weixin()){
            return view('errors.503',['error' =>'请用浏览器登录账号完成支付']);
        }
        if (ComService::isMobile()){
            if(empty($userid)){
                return redirect('mobile/login');
            }
            return view('mobile.pay_init',compact('userid','username'));
        }else{
            if(empty($userid)){
                return redirect('login');
            }
            return view('front.pay_init',compact('userid','username'));
        }
    }
    public function pay_sucess(Request $request){
        self::notify();

    }

    public function notify()
    {
        $alipay = Pay::alipay($this->config);
        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！
            if($data->trade_status == 'TRADE_SUCCESS' || $data->trade_status == 'TRADE_FINISHED' ){
                $pay_init_log = Pay_init_log::getInitLogByNO($data->out_trade_no);
                if(!empty($pay_init_log)){
                    $userid = $pay_init_log->userid;
                    $month_num  = $pay_init_log->pay_money/10;
                    $str = '+'.$month_num.' month';
                    $user_vip = User_vip::getUserVipByUserId($userid);
                    $now = date('Y-m-d H:i:s');
                    if($user_vip->e_time > $now){
                        $s_time = $user_vip->s_time;
                        $e_time = date('Y-m-d H:i:s',strtotime($str,strtotime($user_vip->e_time)));
                        User_vip::updUserVipByUserId($s_time ,$e_time,$userid);
                    }else{
                        $s_time = date('Y-m-d H:i:s',time());
                        $e_time = date('Y-m-d H:i:s',strtotime($str));
                        User_vip::updUserVipByUserId($s_time ,$e_time,$userid);
                    }
                }
            }
        } catch (\Exception $e) {
            // $e->getMessage();
        }
        return $alipay->success();
    }
}