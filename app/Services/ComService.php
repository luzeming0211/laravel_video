<?php

namespace App\Services;


use App\Model\Sens;
use App\Model\Wechat_user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ComService
{
//    public static function getUser()
//    {
//        if(ComService::is_weixin()){
//            $app = app('wechat.official_account');
//            if (!Session()->exists('wechat_user')) {
//                $response = $app->oauth->scopes(['snsapi_userinfo'])
//                    ->redirect();
//                echo $response;
//            }
//            $user = Wechat_user::get_wechat_user();
//            $userid = $user['userid'];
//            $username = $user['username'];
//            if(empty($userid)){
//                if(Session()->exists('wechat_user')) {
//                    return redirect('/mobile/bind');
//                }else{
//                    return view('errors.503',['error' =>'您暂未绑定']);
//                }
//            }
//        }else{
//            $user = self::get_user();
//            $userid = $user['userid'];
//            $username = $user['username'];
//            if(empty($userid)){
//                return redirect('mobile/login');
//            }
//        }
//        return $user;
//    }
    public static function isMobile(){
        $HTTP_USER_AGENT = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $sAgent = strtolower ($HTTP_USER_AGENT);
        if (preg_match('/iphone|android|ipad|windows phone|micromessenger/i', $sAgent)) {
            return true;
        }
        return false;
    }
    public static function is_weixin(){
        if ( strpos(($_SERVER['HTTP_USER_AGENT']),'MicroMessenger') !== false ) {
            return true;
        }
        return false;
    }
    public static function get_user(){
        if(Session()->exists('user')){
            $user = Session()->get('user');
        }else{
            $user['userid'] = '';
            $user['username'] = '';
        }
        return $user;
    }
    public static function user_agent()
    {
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
            return  'ios';
        }else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
            return 'android';
        }else{
            return 'pc';
        }
    }
    public static function hasDenyWord($words, $iLen=5)
    {
        $aDenyInfo = Sens::getSensAll();
        foreach ($aDenyInfo as $key => $value) {
            $aBlackList[] = $value['deny_word_ext'];
        }
        foreach ($aBlackList as $key => $value) {
            if (preg_match('/' . str_replace(' ', '[\s\S]{0,' . $iLen . '}', $value) . '/', $words)) {
                return $value;
            }
        }
        return false;
    }
    public  static function todayReward($week_count){
        switch ($week_count)
        {
            case 0:
                $reward_count = '2' ;
                break;
            case 1:
                $reward_count = '2' ;
                break;
            case 2:
                $reward_count = '2' ;
                break;
            case 3:
                $rand = rand(1,100);
                if($rand > 10){
                    $reward_count = '2' ;
                }else{
                    $reward_count = '3' ;
                }
                break;
            case 4:
                $reward_count = '2' ;
                break;
            case 5:
                $rand = rand(1,100);
                if($rand > 10){
                    $reward_count = '5' ;
                }else{
                    $reward_count = '2' ;
                }
                break;
            case 6:
                $reward_count = '6' ;
                break;
            case 7:
                $rand = rand(1,500);
                if($rand > 200){
                    $reward_count = '10' ;
                }else{
                    $reward_count = '2' ;
                }
                break;
            default:
                $reward_count = '5' ;
        }
        return  $reward_count;
    }
    public  static function is_idcard( $id )
    {
        $id = strtoupper($id);
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
        $arr_split = array();
        if(!preg_match($regx, $id))
        {
            return FALSE;
        }
        if(15==strlen($id)) //检查15位
        {
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";

            @preg_match($regx, $id, $arr_split);
            //检查生日日期是否正确
            $dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
            if(!strtotime($dtm_birth))
            {
                return FALSE;
            } else {
                return TRUE;
            }
        }
        else      //检查18位
        {
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
            @preg_match($regx, $id, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
            if(!strtotime($dtm_birth)) //检查生日日期是否正确
            {
                return FALSE;
            }
            else
            {
                //检验18位身份证的校验码是否正确。
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign = 0;
                for ( $i = 0; $i < 17; $i++ )
                {
                    $b = (int) $id{$i};
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($id,17, 1)){
                    return FALSE;
                }else {
                    return TRUE;
                }
            }
        }

    }
}