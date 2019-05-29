<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>



    <title>Hydrogen学院</title>
</head>

<body>
<img src="{{$url}}">
</body>
<script>
    var domain = "{{env('APP_URL')}}";
    $(document).ready(function (){

        interval = window.setInterval("is_login()",2000);//两秒加载

    });
    function alert111() {

    }
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
                    window.location.replace(domain);
                }
            }
        });
    }

</script>
</html>
