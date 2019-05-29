<?php
return [
    'aliyun' => [
        'region_id' => 'cn-shanghai',
        'access_key' => env('ALIYUN_ACCESS_KEY'),
        'access_key_secret' => env('ALIYUN_ACCESS_KEY_SECRET'),
        // 推流域名
        'push_domain' => 'rtmp://push.boser1u.top',
        // 鉴权key
        'auth_key' => 'VoH4dCUv4s',
        // 鉴权有效时间 单位秒
        'auth_timestamp' => '3600',
        // 鉴权rand 随机数，一般设成0
        'auth_rand' => '0',
        // 鉴权uid 暂未使用（设置成0即可)
        'auth_uid' => '0',
        // 播放域名
        'vhost' => 'play.boser1u.top', //改成自己的播放域名
        // 播放类型 rtmp flv m3u8
        'play_type' => 'rtmp',
        // oss 专用 借用地方
        'end_point' => 'oss-cn-shanghai.aliyuncs.com',
        // 直播视频默认的分辨率
        'default_width' => '1280',
        'default_height' => '720',
        //'cateid' => '10000', //分类ID 阿里云后台查看
    ]
];