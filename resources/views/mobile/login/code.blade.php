<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>邮箱验证码</title>
    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/login.css')}}" />
</head>
<body>

<div class="large-box">
    <form id="login_form" class="fm-v clearfix" action="/mobile/code" method="post">
        <div class="error login_wrong" style="opacity:0;">
            &nbsp;
        </div>
        <div class="wrap1">
            <div class="page-top-title">欢迎来到Hydrogen学院</div>

            <div class="login_box2" >
                {!! csrf_field() !!}
                <input type="hidden" name="userid" id="userid"  value="{{$userid}}" >
                <input class="loge-input sign-input first-input phone-input" type="text" name="code" id="code" placeholder="邮箱验证码" value="" />
                <div id="userEmailMsg" class="phone-title">请输入邮箱验证码</div>
            </div>

            <button  id="loginsubmit" type="submit" class="on-e-btn">确定</button>
        </div>
    </form>
</div>
<div id="captchaCover" class="cover" style="display: none;"></div>

</body>
<script>

</script>
</html>

