##我的毕设设计：视频网站 使用框架laravel5.7

demo地址

- http://boser1u.top

##用户端功能

-  浏览录播视频：
-  浏览直播视频：
-  会员开通：
-  收藏录播视频
-  评论录播视频：
-  点赞录播视频：
-  积分兑换：
-  敏感词过滤
-  用户认证：
-  PC端微信扫码登录：
-  
####系统管理员功能

- 用户管理：可以实现对用户的增加、删除、修改和查询以及导出excel。
- 视频管理：可以实现对视频的增加、修改和删除。
- 直播管理：可以实现对视频的审核、屏蔽和删除。
- 评论管理：可以实现评论的删除和查询。
- 敏感词管理：可以实现对敏感词的增加、删除和查询。
- 广告管理：可以实现对非会员用户的视频前置广告管理、以及对首页广告位的管理。
- 站内信管理：可以实现对站内信的查看和删除。

#更多功能等你发现

##服务器所需环境


- redis          存储正在观看直播的客户端

- swoole          websocekt 实时弹幕

- ffmpeg          视频切割  视频截图

- yansongda-pay   支付宝支付

- easywechat      公众号

##所需的包

````
        "php": "^7.1.3",
        "fideloper/proxy": "^4.0",
        "gregwar/captcha": "^1.1",
        "guzzlehttp/guzzle": "^6.3",
        "intervention/image": "^2.4",
        "laravel/framework": "5.7.*",
        "laravel/tinker": "^1.0",
        "maatwebsite/excel": "~2.1",
        "overtrue/laravel-wechat": "~4.0",
        "overtrue/wechat": "~4.0",
        "php-ffmpeg/php-ffmpeg": "^0.14.0",
        "predis/predis": "^1.1",
        "simplesoftwareio/simple-qrcode": "^2.0",
        "yansongda/pay": "^2.6",
        "zgldh/qiniu-laravel-storage": "^0.10.0"
````
##使用方法

1. git clone
1. cd www #你的服务器放网站的目录后 composer install
1. 修改 .env.example 为 .env 并修改为自己的配置信息
2. 修改 alipayController 下的支付宝支付配置信息
1. redis
1. 配置smtp
1. php artisan migrate #安装数据表结构
1. 填充数据php artisan db:seed
1. 获取微信appid sercret token
1. 配置smtp
1. 获取阿里云直播appid key （不用直播可不管）
1. 网站能打开后开启swoole websocekt服务 php artisan swoole:action start


####
    如有疑问请联系我 903101767@qq.com