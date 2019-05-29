<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台登录</title>
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon"  type="image/png" href="{{asset('assets/i/favicon.png')}}" />
    <link rel="apple-touch-icon-precomposed"  href="{{asset('assets/i/app-icon72x72@2x.png')}}" />
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet"  href="{{asset('assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/admin.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/app.css')}}" />
</head>

<body data-type="login">

<div class="am-g myapp-login">
    <div class="myapp-login-logo-block  tpl-login-max">
        <div class="myapp-login-logo-text">
            <div class="myapp-login-logo-text">
                HYDROGEN 学院<span> </span> <i class="am-icon-skyatlas"></i>

            </div>
        </div>

        <div class="login-font">
        </div>
        <div class="am-u-sm-10 login-am-center">
            <form class="am-form" method="post" action="{{ url('admin/login') }}">
                {!! csrf_field() !!}
                <fieldset>
                    <div class="am-form-group">
                        <input type="text" class="" id="account_number" name="account_number" placeholder="请输入用户名" value="{{ old('account_number') }}">
                    </div>
                    <div class="am-form-group">
                        <input type="password" class="" id="password" name="password" placeholder="请输入密码">
                    </div>
                    <p><button type="submit" class="am-btn am-btn-default">登录</button></p>
                </fieldset>
            </form>
        </div>
    </div>
</div>

@include('admin_inc.script')
</body>

</html>