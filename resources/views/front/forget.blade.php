<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>忘记密码</title>
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
                <div class="register-top">
                    <div class="clearfix"><a href="/login">马上登录</a><span>已有账号，</span></div>
                </div>
            <form method="post" action="/forget" id="f_form">
                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                <div class="register-li">
                    <div class="register-input-li">
                        <input class="register-input-ones js-input" name="email" id="email" type="text">
                        <div class="placeHolder">邮箱</div>
                    </div>
                    <br>
                    <div class="register-input-li register-input-liTwos clearfix">
                        <input class="register-input-twos js-input" type="text" name="f_code" id="f_code">
                        <div class="placeHolder">邮箱验证码</div>
                        <button class="get-code" type="button" onclick="get_f_code()" id="get_code">获取验证码</button>
                    </div>
                </div>
                <button class="login-submit" type="button" onclick="sub_f_form()">提交</button>
            </form>
        </div>
    </div>
    @include('front_inc.footer')
</div>
</body>
<script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/code/js/public.js')}}"></script>
<script>
    function get_f_code() {
        var  email = $("#email").val()
        var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if (!myreg.test(email)) {
            alert('邮箱有误')
            return false;
        }
        if (email != ""){
            $.post(
                '/f_code',
                {
                    '_token': $("#_token").val(),
                    'email':email,
                },
                function (data) {
                    console.log(data);
                    if(data.fail){
                        alert(data.msg);
                        return false;
                    }
                    if(data.success){
                        setTime($("#get_code"))
                    }
                },
                'json'
            );
        }else{
            alert("信息不全");
            return false;
        }
    }
    function sub_f_form() {
        var  email = $("#email").val();
        var  f_code = $("#f_code").val();
        if (email == "" || f_code == ""){
            alert("信息不全");
            return false;
        }else{
            $("#f_form").submit();
        }
    }
</script>
</html>