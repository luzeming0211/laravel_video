<?php
return [
    'pay' => [
        // APPID
        'app_id' => '',
        // 支付宝 支付成功后 主动通知商户服务器地址  注意 是post请求
        'notify_url' => '',
        // 支付宝 支付成功后 回调页面 get
        'return_url' => '',
        // 公钥（注意是支付宝的公钥，不是商家应用公钥）
        'ali_public_key' => '//tRXvBAp1lImzlojPOmGWPZQATcF8gE6///fLISsD1M///E20oyWwkz+/qw4TpPvyvvkOMLb+akwIDAQAB',
        // 加密方式： **RSA2** 私钥 商家应用私钥
        'private_key' => '+50AJ+++/KLoiqSRGaGiSFPlM+WqZOMFGAXM++De40Ta7LgK963xuJxpfJMMVtrpzo2hhw+C/1tTUk6fZ/zaWCi/+njsRi3v6C61TbmD9v7WXweHI4FOuk51M/v1KStEMY7Ak863J+BefpcbYtOcBEHARW6pwrcVQIDAQABAoIBAH/qNrXD2G5svLClx2zuCwSa4cD8Fms+PhXbODdiLSIod9/fsAa29txCGOn71mQK52hCaYu+CAiSC3gWmuPcSw9Jceh0RMVmE1BhCnatnssO9/2dHB5ko81XCohZImt9vy3Nhw1rxBSWtp+av567r2BVmDQj6o0tIqYXVyiWBTCQ+lPCIW8+5nLTU1A8TSulAyQ8Lz+o9o8a6J5o4OLHZ/XdEaQO9KcsxjfhDeslADRC7sueuz7V1a7nRRm73bTTqCDUfL892JFXEuKVV2idazc7YYX6hi4IdrLzyjC+X60m8TyZ7FHVrghmzXKPSnAu+YkJVQB2GtEhTzVD3ZE2muECgYEA23Xlv5SZKahpXkwfaz6CDvgWnbyZIWTdkdTmGxm6Ei8uIfvMdazVso4Ph+Ey47c4ore3a/8663dD+TVEYy7RjOMynPE8pLjjhbfSHFHJrvGTqJ5tFXmSPnFU7eqLCjvmyGlk7rVmYX2R/fdBwkjsKnZlWuq2ao2ylV0Uc3jn1H8CgYEAwry+Rzh7zSG6kdrWyJt45DZ12wUQ0H3JkBLZkfbynb/1lNWGlU0EOnboR+AMJIVuVHbT3JQVjDHFmtP1Tb+Yny2fif5ycGv5R5DkDgUxUwH5263bP8LKQ64QcgnBUP3Aldy9du1lNCJUobtBXQKAwltf/zfQeAPU1my6LWt0VSsCgYEA13PDfnYQeAlSiLULE2pmnPOKoIkLfPFdZVIyJeD3/+o5zDs72zs3APje3nOEVnMGMxlSBcCow4pvPTXCUe0g5MQYaGOdOcoZ9KkmqY7SBeI9KImAZljX7l2tF3Xv0rhENfTilkeYn5V7wm0ALhERag6aKsvLEojSDjk3XrYQQ1kCgYEAo3aTsmzzXsmFNpGf4VzAKbCdVW/3IUu1Oj7YavIDze8oUfq6sfCoL/tIF602BCIM7tGgHXQgckIFQWXSb6T4lAVT+h2gKkY4RZ6WED7DnI34EjLp66ey6QTfwRn3L+kRE7rrPz0eyphWujvZLh2/v2W8Oxu63kM5EZTK4v1j9WkCgYByHHCl9p0nZzJY61BIpPhx2+lwuKRXNu5fx9lgC5v+1AbgmfzSwsPdV4ZYiq10uHXEnxXTEbJ8wu2yZ8kxHskTWmJoqopE2oW0/0gEm0k4BL6BrZfnljolXX1sLH9bMQcshgbvQOEHHR0FwKcsT+x3/u0SY3sEVMpDMA/k1HiLJQ==',
        'log' => [ // optional
            'file' => '../storage/logs/alipay.log',
            'level' => 'debug', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'daily', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
        ],
        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ]
];