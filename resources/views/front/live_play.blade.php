<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>直播观看</title>
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/laydate.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/ckplayer/ckplayer.js')}}" charset="utf-8"></script>

</head>
<body>
<!-- 头部-导航栏 -->
@include('front_inc.header')

<div class="content_live_bg">
    <div class="content_live_box">
        <div class="tit_box clearfix">
            <div class="tit_left"></div>
            <div class="tit_right">
            </div>
        </div>
        <div class="video_live_box">
            <div class="video_live_cont">
                <div class="prism-player" id="player-con" style="height: 500px"></div>
            </div>
            <div class="video_live_right">
                <div class="tab_box">
                    <div class="tab_block">
                        <a class="sele" href="JavaScript:void(0)">评论</a>
                    </div>
                    {{--<div class="tab_block">--}}
                        {{--<a  href="JavaScript:void(0)">当前观看人数20</a>--}}
                    {{--</div>--}}
                    <div class="clear"></div>
                </div>
                <div class="dialogue_box" id="talk" style="height:370px;">
                    {{--//评论区--}}
                    {{--@foreach($video_comment as $k => $vc)--}}
                    {{--<span style="color:blue">ewqe</span><span style="color:blue">：</span><a href="/">eqeq</a><br>--}}
                    {{--@endforeach--}}
                </div>

                <div class="send_box">
                    <input class="send_txt" type="text" id='send'/>
                    <input class="send_btn" type="button" value="发送" id='send_btn' onclick="send_dammu()"/>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="content_live_box clearfix">
</div>
<div class="cover" style="display: none;"></div>
<script>
     live_id = '{{$live_id}}';
     userid = '{{$userid}}';
     username = '{{$username}}';
     user_agent = '{{$user_agent}}';
     is_mobile = "0";
</script>
<!-- 版权 -->
@include('front_inc.footer')
<script>
    var videoObject = {
        autoplay:true,
        container: '#player-con',//“#”代表容器的ID，“.”或“”代表容器的class
        variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
        // html5m3u8: true,
        flashplayer:false,//如果强制使用flashplayer则设置成true
        live:true,//直播视频形式
        loaded: 'loadedHandler',
        video:'{{$live->play_url}}'//视频地址
    };
</script>
<script language="JavaScript" src="{{asset('assets/js/danmu.js')}}" charset="utf-8"></script>
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
</html>
