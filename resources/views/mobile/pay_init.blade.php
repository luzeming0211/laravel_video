<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet"  href="{{asset('assets/pay/css/new_file.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/pay/layer/mobile/need/layer.css')}}" />
    <script language="JavaScript" src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/pay/js/new_file.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/pay/layer/layer.js')}}"></script>
    <title>Hydrogen充值</title>
</head>
<body>
<!--头部  star-->
<header>
    <a href="javascript:history.go(-1);">
        <div class="_left"><img src="{{asset('assets/pay/images/Arrow_left_icon.png')}}"></div>
        充值
    </a>
</header>
<!--头部 end-->
<div class="banner">
    <img src="{{asset('assets/pay/images/banner.png')}}" width="100%" height="100%"/>
</div>
<!--充值列表-->
<div class="person_wallet_recharge">
    <ul class="ul">
        <li>
            <h2 onclick="select_month('10')">1个月</h2>
            <div class="sel" style="" ></div>
        </li>
        <li>
            <h2 onclick="select_month('30')">3个月</h2>
            <div class="sel" style="" ></div>
        </li>
        <li>
            <h2 onclick="select_month('60')">6个月</h2>
            <div class="sel" style=""  ></div>
        </li>
        <li>
            <h2 onclick="select_month('80')">8个月</h2>
            <div class="sel" style=""  ></div>
        </li>
        <li>
            <h2  onclick="select_month('100')">10个月</h2>
            <div class="sel" style="" ></div>
        </li>
        <li>
            <h2 onclick="select_month('120')">12个月</h2>
            <div class="sel" style=""  ></div>
        </li>
        {{--<li>--}}
            {{--<h2>￥10000</h2>--}}
            {{--<div class="sel" style=""></div>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<h2>￥20000</h2>--}}
            {{--<div class="sel" style=""></div>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<h2>￥50000</h2>--}}
            {{--<div class="sel" style=""></div>--}}
        {{--</li>--}}
        <div style="clear: both;"></div>
    </ul>
    <div class="pic"><input type="text" placeholder="点我联系客服" id="txt" readonly /></div>
    <div class="botton">我要充值</div>
    <div class="agreement"><p>点击我要充值，即您已经表示同意<a>《协议》</a></p></div>
    <div class="nav">
        <ul>
            <li><a>{{$userid}}</a></li>
            <li><a>活动规则</a></li>
            <li style="border-right: none;"><a>我的奖品</a></li>
        </ul>
    </div>
    <!--遮罩层-->
    <div class="f-overlay"></div>
    <div class="addvideo" style="display: none;">
        <h3>本次充值<span id="tem_money">0</span>元</h3>
        <ul>
            {{--<li><a>微信支付</a></li>--}}
            <li><a onclick="sub_form()">支付宝支付</a></li>
            <li class="cal">取消</li>
        </ul>
    </div>
</div>
<form method="post" action="/pay" id="form">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
    <input type="hidden" id="userid" name="userid" value="{{$userid}}">
    <input type="hidden" id="username" name="username" value="{{$username}}">
    <input type="hidden" id="pay_money" name="pay_money" value="">
</form>
<script>
    function sub_form() {
      $("#form").submit();
    }
    function select_month(select_money) {
        $("#pay_money").val(select_money);
        $("#tem_money").html(select_money);
    }
</script>
</body>
</html>
