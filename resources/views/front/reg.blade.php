<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>用户注册</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="网站关键词">
    <meta name="Description" content="网站介绍">
    <link rel="stylesheet"  href="{{asset('assets/login/css/base.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/login/css/iconfont.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/login/css/reg.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/alert/sweetalert.css')}}" />
    <script language="JavaScript" src="{{asset('assets/alert/sweetalert.min.js')}}"></script>
</head>
<body>
<div id="ajax-hook"></div>
<div class="wrap">
    <div class="wpn">
        <div class="form-data pos">
            <form>
                <p class="p-input pos">
                    <label for="name">用户名</label>
                    <input type="text" id="name" name="name" autocomplete="off" >
                    <span class="tel-warn tel-err hide"><em></em><i class="icon-warn"></i></span>
                </p>
                <p class="p-input pos" >
                    <label for="veri-code">邮箱</label>
                    <input type="email" name="email" id="email">
                </p>
                <p class="p-input pos" >
                    <label for="passport">输入密码</label>
                    <input type="password" id="password" name="password">
                    <span class="tel-warn pwd-err hide"><em></em><i class="icon-warn" style="margin-left: 5px"></i></span>
                </p>
                <p class="p-input pos" >
                    <label for="passport2">确认密码</label>
                    <input type="password" id="password-confirm" name="password-confirm">
                    <span class="tel-warn confirmpwd-err hide"><em></em><i class="icon-warn" style="margin-left: 5px"></i></span>
                </p>
            </form>
            <button class="lang-btn" onclick="reg()">注册</button>
            <div class="bottom-info">已有账号，<a href="/login">马上登录</a></div>
            <p class="right">Powered by © 2019</p>
        </div>
    </div>
</div>
<script language="JavaScript" src="{{asset('assets/login/js/jquery.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/login/js/agree.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/login/js/login.js')}}"></script>

<script>
    function reg() {
        var domain = window.location.hostname
        var url = 'http://'+domain+"/code";
        var name = $("#name").val();
        var email = $("#email").val();
        var password =  $("#password").val();
        var password_confirmation =  $("#password-confirm").val();
        var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;

        if( name == "" || email == "" || password == "" || password_confirmation == ""){
            alert("请填写完整信息");
            return false;
        }
        if (!myreg.test(email)) {
            alert('邮箱有误')
            return false;
        }
        if(password_confirmation != password){
            alert('两次密码不一致');
            return false;
        }
        $.post(
            '/reg_do',
            {
                '_token':"{{csrf_token()}}",
                'name':name,
                'email':email,
                'password':password,
                'password_confirmation':password_confirmation
            },
            function (data) {
                if(data.fail){
                    alert(data.msg);
                    return false;
                }
                if(data.success){
                    swal(
                        {
                            title:"",
                            text:"还差最后一步就注册成功了",
                            showCancelButton:false,
                            confirmButtonColor:"#DD6B55",
                            confirmButtonText:"确定",
                            closeOnConfirm:true,
                            closeOnCancel:true
                        },
                        function(isConfirm)
                        {
                            if(isConfirm)
                            {
                                window.location.href=url;
                            }
                        }
                    )
                }
            },
            'json'
        );

    }
</script>
</body>
</html>