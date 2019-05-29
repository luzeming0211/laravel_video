<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>用户登录</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"  href="{{asset('assets/login/css/base.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/login/css/iconfont.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/login/css/reg.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/alert/sweetalert.css')}}" />

</head>
<body>
<div id="ajax-hook"></div>
<div class="wrap">
    <div class="wpn">
        <div class="form-data pos">
            <div class="change-login">
                <p class="account_number on">账号登录</p>
                <p class="message">扫码登录</p>
            </div>
            <div class="form1">
                <p class="p-input pos">
                    <label for="email">请输入邮箱</label>
                    <input type="text" name="email" id="email">
                    <span class="tel-warn num-err hide"><em>账号或密码错误，请重新输入</em><i class="icon-warn"></i></span>
                </p>
                <p class="p-input pos">
                    <label for="password">请输入密码</label>
                    <input type="password" name="password" id="password" autocomplete="new-password">
                    <span class="tel-warn pass-err" style="display: none" id="error_msg"><em>账号或密码错误，请重新输入</em><i class="icon-warn"></i></span>
                </p>
            </div>
            <div class="form2 hide" style="text-align: center">
                <img src="{{$url}}" style="width: 50%;height: 50%;">
            </div>
            <div class="r-forget cl">
                <a href="/reg" class="z">账号注册</a>
                <a href="/forget" class="y">忘记密码</a>
            </div>
            <button class="lang-btn off log-btn" onclick="check_login()">登录</button>
            <div class="third-party">
                {{--<a href="#" class="log-qq icon-qq-round" onclick="other_login()"></a>--}}
                {{--<a href="#" class="log-qq icon-weixin" id="wechat_login" ></a>--}}
                {{--<a href="#" class="log-qq icon-sina1" onclick="other_login()"></a>--}}
            </div>
            <p class="right">Powered by © 2019</p>
        </div>
    </div>
</div>
<script language="JavaScript" src="{{asset('assets/login/js/jquery.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/login/js/agree.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/login/js/login.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/alert/sweetalert.min.js')}}"></script>
<script>
//    var domain = window.location.hostname
//    var url = 'http://'+domain;
    function check_login(){
        var email = $("#email").val();
        var password =  $("#password").val();
        if(email == "" || password == ""){
            alert("邮箱或密码不能为空");
            return false;
        }
        $.post(
            '/login_do',
            {
                '_token':"{{csrf_token()}}",
                'email':email,
                'password':password
            },
            function (data) {
                console.log(data);
                if(data.success){
                    window.location.href="{{$ref_url}}";
                }else if (data.fail){
                    error_msg();
                }
            },
            'json'
        );



    }
    function error_msg(){
        $("#error_msg").show();
    }
    $(document).ready(function (){

        interval = window.setInterval("is_login()",2000);//两秒加载

    });
    function is_login() {
        var ticket = '{{$ticket}}';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/wechat/login',
            data: {
                ticket:ticket
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if(data > 0){
                    swal({
                        title: "",
                        text: "登录成功!",
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer:2000
                    })
                    setTimeout(function(){
                        window.location.replace("{{$ref_url}}");
                    },2000)

                }
            }
        });
    }
//    function other_login() {
//        swal({
//            title: "",
//            text: "暂不支持此登录方式!",
//            showConfirmButton: false,
//            showCancelButton: false,
//            timer:1000
//        })
//    }
</script>
</body>
</html>