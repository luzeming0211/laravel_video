<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>登录</title>
    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/login.css')}}" />
</head>
<body>

<div class="large-box">
    <form id="login_form" class="fm-v clearfix" action="/mobile/login" method="post">
        <div class="error login_wrong" style="opacity:0;">
            &nbsp;
        </div>
        <div class="wrap1">
            <div class="page-top-title">欢迎来到Hydrogen学院</div>

            <div class="login_box2" >
                {!! csrf_field() !!}
                <input type="hidden" name="ref_url" value="@if(!empty($ref_url)){{$ref_url}}@endif">
                <input class="loge-input sign-input first-input phone-input" type="text" name="email" id="email" placeholder="邮箱" value="{{old('email')}}" autocapitalize="on"/>
                <div id="userEmailMsg" class="phone-title">请输入邮箱</div>
                <input class="sign-input password-input" type="password" id="password" name="password" autocomplete="off" placeholder="密码" value="">
                <div id="passwordMsg" class="phone-title">请输入密码</div>
            </div>
            <button name="loginsubmit" id="loginsubmit" onclick="checkLogin();" type="button" class="on-e-btn">登录</button>
            <button type="button" class="go-password-btn login_box1"><a href="/mobile/reg" >点我注册</a></button>
        </div>
    </form>
</div>
<div id="captchaCover" class="cover" style="display: none;"></div>

</body>
<script>
    function checkLogin(){
        var temp = document.getElementById("email");                 //对电子邮件的验证
        var password = $('#password').val();
        var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;

        if(password == '' || password == null){
            showMsg('密码为空', 'passwordMsg')
            return false;
        }
        if (!myreg.test(temp.value)) {
            showMsg('邮箱有误', 'passwordMsg')
            return false;
        }
        $('#login_form').submit();
    }

    function showMsg(msg, id) {
        $("#" + id).html(msg);
        $("#" + id).css("opacity", 1);
    }

    function hideMsg(id) {
        if(id != null){
            $("#" + id).css("opacity", 0);
        }else{
            $("#telMsg").css("opacity", 0);
            $("#smsCodeMsg").css("opacity", 0);
            $("#userNameMsg").css("opacity", 0);
            $("#passwordMsg").css("opacity", 0);
        }
    }
    $(document).ready(function (){

        @if(!empty($msg))
        showMsg('{{$msg}}','passwordMsg');
        @endif

        @if(!empty($errors))
        @foreach ($errors->all() as $error)
        showMsg('{{$error}}','passwordMsg');
        @endforeach
        @endif
    });
</script>
</html>

