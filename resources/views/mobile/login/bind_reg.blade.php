<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>注册</title>
    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/login.css')}}" />
</head>
<body>

<div class="large-box">
    <form id="login_form" class="fm-v clearfix" action="/mobile/bind_reg" method="post">
        <div class="error login_wrong" style="opacity:0;">
            &nbsp;
        </div>
        <div class="wrap1">
            <div class="page-top-title">欢迎来到Hydrogen学院</div>

            <div class="login_box2" >
                {!! csrf_field() !!}
                <input class="loge-input sign-input first-input phone-input" type="text" name="name" id="name" placeholder="用户名" value="{{old('name')}}" />

                <div id="userNameMsg" class="phone-title">请输入用户名</div>
                <input class="loge-input sign-input first-input phone-input" type="text" name="email" id="email" placeholder="邮箱" value="{{old('email')}}" />

                <div id="userEmailMsg" class="phone-title">请输入邮箱</div>
                <input class="loge-input sign-input first-input phone-input" type="password" name="password" id="password" placeholder="密码" value="{{old('password')}}" />

                <div id="userPwdMsg" class="phone-title">请输入密码</div>
                <input class="loge-input sign-input first-input phone-input" type="password"  name="password_confirmation" id="password_confirmation"  placeholder="确认密码" value="{{old('password_confirmation')}}">

                <div id="passPwdMsg" class="phone-title">请再次输入密码</div>
            </div>

            <button name="loginsubmit" onclick="checkReg();" type="button" class="on-e-btn">注册</button>
        </div>

    </form>
</div>
<div id="captchaCover" class="cover" style="display: none;"></div>
</body>
<script>
    //用户登录的输入校验
    function checkReg(){
        var  name = $('#name').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        var temp = document.getElementById("email");
        var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if(name == '' || name == null){
            showMsg('用户名不能为空', 'passPwdMsg')
            return false;
        }
        if (!myreg.test(temp.value.trim())) {
            showMsg('邮箱有误', 'passPwdMsg')
            return false;
        }
        if(password == '' || password == null){
            showMsg('密码不能为空', 'passPwdMsg')
            return false;
        }
        if(password_confirmation == '' || password_confirmation == null){
            showMsg('确认密码不能为空', 'passPwdMsg')
            return false;
        }
        if(password_confirmation != password){
            showMsg('两次密码不一致', 'passPwdMsg')
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
        @if (Session::has('error'))
        showMsg('{{Session::get('error') }}','passPwdMsg');
        @endif
        @if(!empty($msg))
        showMsg('{{$msg}}','passPwdMsg');
        @endif

    });
</script>

</html>

