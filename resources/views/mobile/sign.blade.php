<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>签到</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet"  href="{{asset('assets/css/sign/sign2.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/index.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/alert/sweetalert.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/sign/calendar2.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/alert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            var signList=[
                    @foreach($signin as $k => $vc)
                    {"signDay":"{{$vc}}"},
                    @endforeach
            ];
            calUtil.init(signList);
        });
    </script>

</head>
<body>
<div class="head_box" style="border-bottom: 1px solid #dbdbdb;">
    <div class="head_block">Hydrogen学院</div>
    <a class="back" href="/mobile/index"></a>
</div>
<div id="calendar"  style="pointer-events: none;"></div>
<div id="sign_note" style="text-align:center;position: relative;padding: 15px;    font-size: 14px;">
    <span style="color:red;">*规则：每天签到可获得2积分，每周的3、5、7天有机会获得3、5、10积分；认证用户可获得更多积分；</span>
</div>
</body>
<script>
    $(document).ready(function() {
        @if($flag)
        swal({
            title: "",
            text: "签到成功!",
            showConfirmButton: false,
            showCancelButton: false,
            timer:2000
        })
        @else
        swal({
            title: "",
            text: "你今天已经签到!",
            showConfirmButton: false,
            showCancelButton: false,
            timer:2000
        })
        @endif
    });
</script>
</html>