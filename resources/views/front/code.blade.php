<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>邮箱验证码</title>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/code/css/index.css')}}" />
    <!--[if lt IE 8]>
    <style>
        .register-box>.page-main{
            padding-bottom: 0;
        }
    </style>
    <![endif]-->
</head>
<body>
<div class="large-box register-box">
    <div class="page-header">
        <div class="wrap1">
            <img style="width: 258px;height: 70px" src="{{asset('assets/img/logo.png')}}" class="logo"  alt="">
        </div>
    </div>
    <div class="page-main register-main">
        <div class="wrap1 main-box clearfix">
            <form method="post" action="/code">
            <div class="register-top">
                <div class="clearfix"><a href="/login">马上登录</a><span>已有账号，</span></div>
            </div>
            <div class="register-li">
                <div style="text-align: center">请输入邮箱验证码</div>
                <div class="register-input-li">
                    <input class="register-input-ones js-input" name="code" id="code" type="text">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="userid" id="userid"  value="{{$userid}}" >
                    <div class="placeHolder"></div>
                </div>
            </div>


            <button class="login-submit">提交</button><!--该按钮不可点击的样式为login-submit-disabled类名，可直接追加上去并且加disabled属性。-->
            </form>
        </div>
    </div>
    @include('front_inc.footer')
</div>
</body>
<script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/code/js/public.js')}}"></script>
</html>