<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>签到</title>
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/sign/sign2.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/sign/calendar2.js')}}"></script>





</head>
<body>
<!-- 头部-导航栏 -->
@include('front_inc.header')
<!--内容-->
<script type="text/javascript">
    $(function(){
        //ajax获取日历json数据
        var signList=[
            @foreach($signin as $k => $vc)
            {"signDay":"{{$vc}}"},
            @endforeach
            ];
        calUtil.init(signList);
    });
</script>
<div class="content pad0">
    <div class="container clearfix">
        <div class="container-left">
            <ul>
                <li>
                    <a href="/sign" class="active">签到</a>
                </li>
                <li>
                    <a href="/me" >个人信息</a>
                </li>
                <li>
                    <a href="/collect" >我的收藏</a>
                </li>
                <li>
                    <a href="/mail" >站内信</a>
                </li>
            </ul>
        </div>
            <div class="container-right">

            <div class="view_list" style="pointer-events: none;">
                <div class="container__block">
                    <div style="" id="calendar"></div>

                    <div id="sign_note" style="text-align:center;position: relative;padding: 15px;    font-size: 14px;" >
                        <span style="color:red;">*规则：每天签到可获得2积分，每周的3、5、7天有机会获得3、5、10积分；<br>认证用户每天签到可以多获得2积分；每100积分就可兑换一个月会员</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flip" style="min-height: 80px;">
        <ul>
        </ul>
    </div>
</div>
<!-- 版权 -->
@include('front_inc.footer')


</body>
</html>
