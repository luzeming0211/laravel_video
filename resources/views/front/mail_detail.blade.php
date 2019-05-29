<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>站内信</title>
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/mail.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>
    <style type="text/css">
        *{
            margin:0;
            padding:0;
        }
        #box{
            position: relative;
            top:100px;
            left:100px;
            width: 300px;
            height: 200px;
            background: #43a0ff;
            -moz-border-radius: 12px;
            -webkit-border-radius: 12px;
            border-radius: 12px;
        }
        #box:before{
            position: absolute;
            content: "";
            width: 0;
            height: 0;
            right: 100%;
            top: 38px;
            border-top: 13px solid transparent;
            border-right: 26px solid #43a0ff;
            border-bottom: 13px solid transparent;
        }
    </style>
</head>
<body>
<!-- 头部-导航栏 -->
@include('front_inc.header')
<!--内容-->
<div class="content pad0">
    <div class="container clearfix">
        <div class="container-left">
            <ul>
                <li>
                    <a href="/sign" >签到</a>
                </li>
                <li>
                    <a href="/me" >个人信息</a>
                </li>
                <li>
                    <a href="/collect" >我的收藏</a>
                </li>
                <li>
                    <a href="/mail" class="active">站内信</a>
                </li>
            </ul>
        </div>
            <div class="container-right">
                <div>
                    {{--{!! $data !!}--}}
                    {{--<div id="box">--}}
                        {{--<div  style="color: #5a4d4d;font-size: 19px;padding: 30px;text-indent: 1em;">--}}
                            {{--dawdawddawdwadwa打哇打大娃大娃大娃打的--}}
                        {{--</div>--}}
                    {{--</div>--}}
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
