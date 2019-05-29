<?php
/**
 * 功能：公共方法
 * 日期：2018/02/28
 * auth：xsl
 */

/**
 * 功能：过滤emoji表情
 * @param $str 表情字符串
 * @return $str 过滤后的表情字符串
 */
function filterEmoji($str)
{
    $str = preg_replace_callback( '/./u',
        function (array $match) {
            return strlen($match[0]) >= 4 ? '' : $match[0];
        },
        $str);
    return $str;
}

/**
 * 判断文件的MIME类型是否为图片
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

/**
 * 创建文件夹
 */
function mkdir_upload($sPath, $sMode = 0777)
{
    if (!file_exists($sPath)){
        mkdir_upload(dirname($sPath), $sMode);
        //http://php.net/manual/zh/function.mkdir.php
        mkdir($sPath, $sMode);
    }
}

/**
 * 对提交的数据进行trim
 */
//if(!function_exists('submit_filter')) {
//    function submit_filter($sSubmitStr)
//    {
//        return trim($sSubmitStr);
//    }
//}


function submit_filter($sSubmitStr)
{
    return trim(htmlspecialchars($sSubmitStr));
}
/**
 * curl请求
 * @param $sUrl
 * @param string $aData
 * @return mixed
 */
function httpRequest($sUrl, $aData=''){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $sUrl);
    if($aData){
        curl_setopt ( $curl, CURLOPT_POST, 1 );
        curl_setopt ( $curl, CURLOPT_POSTFIELDS, $aData );
    }
    $oRes = curl_exec($curl);
    curl_close($curl);

    return $oRes;

}

/**
 * 获取accesstoken
 * @param $sAppId
 * @param $sSecret
 * @return mixed
 */
function getAccessToken($sAppId, $sSecret)
{
    $aAccessToken = session('access_token');
    if ( ! session('access_token')){
        $sTokenUrl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $sAppId . '&secret=' . $sSecret;
        $aResult = json_decode(httpRequest($sTokenUrl), true);
        if (isset($aResult['errcode'])) {
           return $aResult;
        }
        $aAccessToken = $aResult['access_token'];
        session('access_token', $aResult['access_token']);
    }
    return $aAccessToken;
}

//获取routeName
function getRouteName($i=1){
    $url = $_SERVER['REQUEST_URI'];
    $url = str_replace(strstr($url,'?'),'',$url);
    $aItems = explode('/',$url);
    $class = isset($aItems[$i])?$aItems[$i]:'';
    return $class;
}

//获取请求接口(不包含参数)
function getRouteName2(){
    $url = $_SERVER['REQUEST_URI'];
    $url = str_replace(strstr($url,'?'),'',$url);
    return $url;
}

/**
 * 记录错误日志
 */
function record_error_log($sErrorMsg)
{
    $sErrorLogPath = storage_path() . '/logs/';
    if ( ! file_exists($sErrorLogPath)) {
        mkdir($sErrorLogPath, 0775, true);
    }
    file_put_contents(storage_path() . '/logs/error.log',  '[' . date('Y-m-d H:i:s') . '] ' . $_SERVER['REQUEST_METHOD'] . '：' . $sErrorMsg ."\r\n", FILE_APPEND);
}

/**
 * 获取医脉通用户信息
 */
function getUserinfo($uid){
    $url = 'http://api.medlive.cn/user/get_user_info.php';
    $sHashId =  getHashidOrCheckid($uid, 'dasfgfsdbz');
    $sCheckId = getHashidOrCheckid($uid, 'hiewrsbzxc');
//    dd($sHashId);
//    $sHashId = '36130560508272';//闫磊医脉通id的hash值
//    $sCheckId = '404380110809004';
    $result = requestApiByCurl($url, array('hashid'=>$sHashId,'checkid'=>$sCheckId), 'get');
    return $result;
}

/**
 * 用户id加密
 */
function getHashidOrCheckid($user, $downloadKey='') {
    if (empty($user)) {
        return '0';
    }
    $crc = intval(sprintf('%u', crc32($downloadKey . "asdfwrew.USER_SEED")));
    $hash = $crc - $user;
    $hash2 = sprintf('%u', crc32($hash . 'werhhs.USER_SEED2'));
    $k1 = substr($hash2, 0, 3);
    $k2 = substr($hash2, -2);
    return $k1 . $hash . $k2;
}

/**
 * 接口通讯方式
 */
function requestApiByCurl($sUrl, $aData, $sMethod = 'Post', $iTimeout = 10) {
    $sMethod = strtolower ( $sMethod );
    $ch = curl_init ();
    if ($sMethod == 'get') {
        $sUrl .= '?' . http_build_query ( $aData );
    }
    curl_setopt ( $ch, CURLOPT_URL, $sUrl );
    if ($sMethod == 'post') {
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $aData );
    }
    $iTimeout = intval ( $iTimeout );
    if ($iTimeout) {
        curl_setopt ( $ch, CURLOPT_TIMEOUT, $iTimeout );
    }
    ob_start ();
    curl_exec ( $ch );
    $sOut = ob_get_clean ();
    curl_close ( $ch );
    return json_decode ($sOut, true);
}

/**
 *
 * 生成略缩图
 * @param  $im 图片
 * @param  $dest 目标路径
 * @param unknown_type $maxwidth ：最大宽度
 * @param unknown_type $maxheight： 最大高度
 */
function resizeImage($im, $dest, $maxwidth, $maxheight)
{
    $img = getimagesize($im);
    switch ($img[2]) {
        case 1:
            $im = @imagecreatefromgif($im);
            break;
        case 2:
            $im = @imagecreatefromjpeg($im);
            break;
        case 3:
            $im = @imagecreatefrompng($im);
            break;
    }
    $pic_width = imagesx($im);
    $pic_height = imagesy($im);
    $resizewidth_tag = false;
    $resizeheight_tag = false;
    if (($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
        if ($maxwidth && $pic_width > $maxwidth) {
            $widthratio = $maxwidth / $pic_width;
            $resizewidth_tag = true;
        }

        if ($maxheight && $pic_height > $maxheight) {
            $heightratio = $maxheight / $pic_height;
            $resizeheight_tag = true;
        }

        if ($resizewidth_tag && $resizeheight_tag) {
            if ($widthratio < $heightratio){
                $ratio = $widthratio;
            }
            else{
                $ratio = $heightratio;
            }
        }

        if ($resizewidth_tag && !$resizeheight_tag){
            $ratio = $widthratio;
        }

        if ($resizeheight_tag && !$resizewidth_tag){
            $ratio = $heightratio;
        }
        $newwidth = $pic_width * $ratio;
        $newheight = $pic_height * $ratio;

        if (function_exists("imagecopyresampled")) {
            $newim = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
        } else {
            $newim = imagecreate($newwidth, $newheight);
            imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $pic_width, $pic_height);
        }

        imagejpeg($newim, $dest);
        imagedestroy($newim);
    } else {
        imagejpeg($im, $dest);
    }
}

function ip() {
    if (PHP_SAPI == 'cli')
        return 'unknown';
    if (getenv ( 'HTTP_CLIENT_IP' ) && strcasecmp ( getenv ( 'HTTP_CLIENT_IP' ), 'unknown' )) {
        $ip = getenv ( 'HTTP_CLIENT_IP' );
    } elseif (getenv ( 'HTTP_X_FORWARDED_FOR' ) && strcasecmp ( getenv ( 'HTTP_X_FORWARDED_FOR' ), 'unknown' )) {
        $ip = getenv ( 'HTTP_X_FORWARDED_FOR' );
    } elseif (getenv ( 'REMOTE_ADDR' ) && strcasecmp ( getenv ( 'REMOTE_ADDR' ), 'unknown' )) {
        $ip = getenv ( 'REMOTE_ADDR' );
    } elseif (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], 'unknown' )) {
        $ip = $_SERVER ['REMOTE_ADDR'];
    }
    return preg_match ( "/[\d\.]{7,15}/", $ip, $matches ) ? $matches [0] : 'unknown';
}

/**
 * 根据length生成随机数
 */
function generate_code($length = 4) {
    $min = pow(10 , ($length - 1));
    $max = pow(10, $length) - 1;
    return rand($min, $max);
}