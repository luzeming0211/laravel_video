<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/index.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/zan.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/alert/sweetalert.css')}}" />
    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/alert/sweetalert.min.js')}}"></script>

    <link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.2/skins/default/aliplayer-min.css" />
    <script type="text/javascript" charset="utf-8" src="https://g.alicdn.com/de/prismplayer/2.8.2/aliplayer-min.js"></script>
    <script type="text/javascript" charset="utf-8" src="https://player.alicdn.com/aliplayer/presentation/js/aliplayercomponents.min.js"></script>

    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        <?php $app = app('wechat.official_account'); ?>
        wx.config(<?php echo $app->jssdk->buildConfig(array('onMenuShareTimeline', 'onMenuShareAppMessage'), false) ?>);
        wx.ready(function () {
            var domain = "{{env('APP_URL')}}";
            wx.onMenuShareTimeline({
                title: 'HYDROGEN学院',
                imgUrl: domain+'{{$video->thumb}}',
                success: function () {
                    alert("已分享到朋友圈");
                },
                cancel: function () {
                    alert("取消分享到朋友圈");
                }
            });
            //分享给朋友
            wx.onMenuShareAppMessage({
                title: 'HYDROGEN学院',
                imgUrl: domain+'{{$video->thumb}}',
                success: function () {
                    alert("已分享给好友");
                },
                cancel: function () {
                    alert("取消分享给好友");
                }
            });
        });
    </script>
    <title>HYDROGEN学院</title>
    <script>
        var username = "{{$username}}";
        var userid = "{{$userid}}";
    </script>
    <script language="JavaScript" src="{{asset('assets/js/zan_m.js')}}" charset="utf-8"></script>
</head>

<body>
<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
<div class="head_box">
    <div class="head_block">
        {{$video->description}}
    </div>
    <input style="position: absolute;top: 5px;right: 5px;" type="button" class="btn btn_icon2
     @if(!empty($is_like))
        @if($is_like->del_flg == 'N')
        {{'btn_icon2_sele'}}
        @endif
        @endif" data-classid="{{$video->id}}"  id="like" onclick="like(this, 'like')"/>
        <input  style="position: absolute;top: 5px;right: 45px;" type="button" class="btn btn_icon3
        @if(!empty($is_collect))
        @if($is_collect->del_flg == 'N')
        {{'btn_icon3_sele'}}
        @endif
    @endif" data-classid="{{$video->id}}"  id="collect" onclick="collect(this, 'collect')"/>
    <a class="back" href="javascript:void(0);"></a>

</div>
<div class="pic_box">
    <div id='a1'>

    </div>
</div>
<script>
    var player = new Aliplayer({
        id: "a1",
        source: "{{env('PLAY_URL')}}"+'{{$video->id}}',
        width: "100%",
        autoplay: true,
        isLive: false,
        "skinLayout": [
            {
                "name": "bigPlayButton",
                "align": "blabs",
                "x": 30,
                "y": 80
            },
            {
                "name": "H5Loading",
                "align": "cc"
            },
            {
                "name": "errorDisplay",
                "align": "tlabs",
                "x": 0,
                "y": 0
            },
            {
                "name": "infoDisplay"
            },
            {
                "name": "tooltip",
                "align": "blabs",
                "x": 0,
                "y": 56
            },
            {
                "name": "thumbnail"
            },
            {
                "name": "controlBar",
                "align": "blabs",
                "x": 0,
                "y": 0,
                "children": [
                    {
                        "name": "progress",
                        "align": "blabs",
                        "x": 0,
                        "y": 44
                    },
                    {
                        "name": "playButton",
                        "align": "tl",
                        "x": 15,
                        "y": 12
                    },
                    {
                        "name": "fullScreenButton",
                        "align": "tr",
                        "x": 10,
                        "y": 12
                    },
                    {
                        "name": "setting",
                        "align": "tr",
                        "x": 15,
                        "y": 12
                    },
                    {
                        "name": "volume",
                        "align": "tr",
                        "x": 5,
                        "y": 10
                    }
                ]
            }
        ],
        @if($vipOrNO == 1)
                components: [{
                    name: 'MemoryPlayComponent',
                    type: AliPlayerComponent.MemoryPlayComponent,
                }]
                @else
                @if($video->is_admin)
                components: [{
                    name: 'PreviewVodComponent',
                    type: AliPlayerComponent.PreviewVodComponent,
                    args: ['{{(config('hydrogen.look_time'))}}', '#endPreviewTemplate', ` 观看完整视频`]
                }]
                @endif
        @endif

    }, function (player) {
        console.log("播放器创建成功");
    });
</script>
<div class="sml_nav_box">
    <a class="sele" href="javascript:void(0)">评论</a>
</div>

<div class="dialogue_bg">
    <div class="dialogue_box">
        @foreach($video_comment as $k => $vc)
            <span style="color:blue">{{$vc->username}}</span><span style="color:blue">：</span>{{$vc->comment}}<br>
        @endforeach
    </div>

</div>

<div class="send_box">
    <input class="send_txt" type="text" id='send'>
    <input class="send_btn" type="button" value="发送" id="sendBtn">
</div>
 <script>
    $(document).ready(function () {
        //菜单选择
        $('.sml_nav_box a').click(function () {
            $('.sml_nav_box a').removeClass("sele");
            $(this).addClass("sele");
        });
        $('.dialogue_box').height($(window).height()-$('.head_box').height()-$('.pic_box').height()-$('.sml_nav_box').height()-$('.send_box').height()-30);
    });
    var domain = window.location.hostname
    $('#sendBtn').click(function(){
        {{--username = "{{$username}}";--}}
        {{--userid = "{{$userid}}";--}}
        var video_id = "{{$video->id}}";
        if (userid == "" || username == "") {
            alert('请您登录后发表评论');
            window.location.href= 'http://'+domain+'/mobile/login';
        }
        var url = '/video/add-comment';
        var comment = $.trim($('#send').val());
        if(!comment){
            // alert('请输入内容！');
            return false;
        }
        if (comment.length > 30) {
            alert("内容太长，最多 30个文字");
            return false;
        }
        var data = {
            '_token': "{!! csrf_token() !!}",
            'userid' : userid,
            'username' : username,
            'video_id' : video_id,
            'comment'  : comment,
        }
        $.post(url, data, function(msg){
            if(msg.result == 'OK'){
                var str='<span style="color:blue">{{$username}}</span><span style="color:blue">：</span>'+comment+'<br>';
                $(".dialogue_box").append(str);
                $('.dialogue_box').scrollTop( $('.dialogue_box')[0].scrollHeight );
                $('#send').val('');
            }else{
                alert(msg.error);
                $('#send').val('');
            }

        },'json');
    });

    $(".back").click(function(){
        if(history.length > 2){
            window.history.go( -1 );
        }else{
            window.location.href= 'http://'+domain+'/mobile/index';
        }
    });
</script>
</body>