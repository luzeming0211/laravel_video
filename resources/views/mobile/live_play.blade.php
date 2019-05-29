<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/index.css')}}" />
    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>

    <link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.1/skins/default/aliplayer-min.css" />
    <script type="text/javascript" charset="utf-8" src="https://g.alicdn.com/de/prismplayer/2.8.1/aliplayer-min.js"></script>
    <script type="text/javascript" charset="utf-8" src="https://player.alicdn.com/aliplayer/presentation/js/aliplayercomponents.min.js"></script>
    <title>直播</title>
</head>
<body>

<div class="head_box">
    <div class="head_block">{{$live->des}}</div>
    <a class="back" href="javascript:void(0);"></a>
</div>
<div class="pic_box">
    <div id='player' style="height: 210.94px">

    </div>
</div>

<div class="sml_nav_box">
    <a class="sele" href="javascript:void(0)">评论</a>
</div>

<div class="dialogue_bg">
    <div class="dialogue_box" >

    </div>
</div>
<div class="send_box">
    <input class="send_txt" type="text" id='send'>
    <input class="send_btn" type="button" value="发送" id="sendBtn" onclick="send_dammu()">
</div>
<script>
     live_id = '{{$live_id}}';
     userid = '{{$userid}}';
     username = '{{$username}}';
     user_agent = '{{$user_agent}}';
     is_mobile = "1";
</script>
 <script>
     $(document).ready(function () {
         //菜单选择
         $('.sml_nav_box a').click(function () {
             $('.sml_nav_box a').removeClass("sele");
             $(this).addClass("sele");
         });
         $('.dialogue_box').height($(window).height()-$('.head_box').height()-$('.pic_box').height()-$('.sml_nav_box').height()-$('.send_box').height()-30);
     });
    $(".back").click(function(){
        if(history.length > 2){
            window.history.go( -1 );
        }else{
            window.location.href= 'http://'+domain+'/mobile/index';
        }
    });
</script>
<script>
    var player = new Aliplayer({
        id: "player",
        source: '{{$live->play_url}}',
        width: "100%",
        "autoplay": true,
        "isLive": true,
        "rePlay": false,
        "playsinline": true,
        "preload": true,
        "controlBarVisibility": "hover",
        "useH5Prism": false
    }, function (player) {
        player._switchLevel = 0;
        console.log("播放器创建成功");
    });
</script>
{{--<script>--}}
    {{--var videoObject = {--}}
        {{--autoplay:true,--}}
        {{--container: '#player',//“#”代表容器的ID，“.”或“”代表容器的class--}}
        {{--variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象--}}
        {{--flashplayer:false,//如果强制使用flashplayer则设置成true--}}
        {{--live:true,//直播视频形式--}}
        {{--loaded: 'loadedHandler',--}}
        {{--video:'{{$live->play_url}}'//视频地址--}}
    {{--};--}}
{{--</script>--}}
{{--<script language="JavaScript" src="{{asset('assets/js/danmu.js')}}" charset="utf-8"></script>--}}
<script>
    var port = '{{(config('swoole.port'))}}';
    ws = new WebSocket("ws://47.95.12.100:"+port);
</script>
<script language="JavaScript" src="{{asset('assets/js/live_websocekt.js')}}" charset="utf-8"></script>
<script>
    $(document).keyup(function(event){
        if(event.keyCode ==13){
            send_dammu();
        }
    });
</script>
</body>