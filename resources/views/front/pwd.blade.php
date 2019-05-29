<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改密码</title>
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
            <form method="post" action="/edit_pwd" id="edit_pwd_form">
                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                <input type="hidden" id="email" name="email" value="{{$email}}">
            <div class="register-top">
                <div class="clearfix"><a href="/login">马上登录</a><span>已有账号，</span></div>
            </div>
            <div class="register-li">
                <div class="register-input-li">
                    <input class="register-input-ones js-input" name="pwd" id="pwd" type="text">
                    <div class="placeHolder" id="pwd_placeHolder">密码</div>
                </div>
                <br>
                <div class="register-input-li">
                    <input class="register-input-ones js-input" name="conf_pwd" id="conf_pwd" type="text">
                    <div class="placeHolder">确认密码</div>
                </div>
            </div>


            <button class="login-submit" type="button" onclick="sub_pwd_form()">提交</button>
            </form>
        </div>
    </div>
    @include('front_inc.footer')
</div>
</body>
<script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/code/js/public.js')}}"></script>
<script>
    function sub_pwd_form() {
        var pwd =  $("#pwd").val();
        var conf_pwd =  $("#conf_pwd").val();
        if( pwd == "" || conf_pwd == ""){
            alert("请填写完整信息");
            return false;
        }
        if(pwd.length < 6 || pwd.length >18 ){
            alert("密码在6-18位之间");
            return false;
        }
        if(pwd != conf_pwd){
            alert('两次密码不一致');
            return false;
        }
        $("#edit_pwd_form").submit();
    }
</script>
</html>