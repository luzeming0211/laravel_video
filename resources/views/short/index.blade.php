<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>快看快学</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet"  href="{{asset('assets/short/css/sm.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/short/css/sm-extend.min.css')}}" />

    <link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.1/skins/default/aliplayer-min.css" />
    <script type="text/javascript" charset="utf-8" src="https://g.alicdn.com/de/prismplayer/2.8.1/aliplayer-min.js"></script>
    <script type="text/javascript" charset="utf-8" src="https://player.alicdn.com/aliplayer/presentation/js/aliplayercomponents.min.js"></script>
</head>
<body>
<div class="page-group">
    <div class="page page-current">
        <header class="bar bar-nav">
            <a href="/" class="icon icon-home pull-left"></a>
            <h1 class="title">快看快学</h1>
        </header>
        <div class="content">
            {{--<link rel="stylesheet"  href="{{asset('assets/short/css/fluidplayer.min.css')}}" />--}}
            {{--<script language="JavaScript" src="{{asset('assets/short/js/fluidplayer.js')}}"></script>--}}


            @foreach($short_top as $key => $val)
                <div class="card demo-card-header-pic" id="{{'video_'.$val->id}}">
                    <div id="{{'video_div'.$val->id}}">
                        <div valign="bottom" class="card-header color-white no-border no-padding">
                            <img class='card-cover' src="{{$val->pic}}" onclick="play_video('{{env('SHORT_URL').$val->id}}',$(this),'{{$val->id}}')" />
                        </div>
                        <div class="card-content">
                            <div class="card-content-inner">
                                <p>{{$val->des}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($short as $key => $val)
            <div class="card demo-card-header-pic" id="{{'video_'.$val->id}}">
                <div id="{{'video_div'.$val->id}}">
                    <div valign="bottom" class="card-header color-white no-border no-padding">
                        <img class='card-cover' src="{{$val->pic}}" onclick="play_video('{{env('SHORT_URL').$val->id}}',$(this),'{{$val->id}}')" />
                    </div>
                    <div class="card-content">
                        <div class="card-content-inner">
                            <p>{{$val->des}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach






            <div class="content-block" style="margin-bottom:150px">
                <p class="buttons-row">
                    @if(!empty($short->previousPageUrl()))
                    <a  href="{{$short->previousPageUrl()}}" class="button button-big button-round">上一页</a>
                    @endif
                    @if(!empty($short->nextPageUrl()))
                    <a  href="{{$short->nextPageUrl()}}" class="button button-big button-round">下一页</a>
                    @endif
                </p>
            </div>
        </div>
    </div>

</div>
<script language="JavaScript" src="{{asset('assets/short/js/jquery.min.js')}}"></script>
<script>
    is_play = false;
    hide_div = "";
    function play_video(url,obj,video_id){
        console.log(hide_div);
        if(hide_div != ""){
            $("#"+hide_div).show();
        }
        if(is_play){
            $(".play_div").remove();
        }
        var rand = Math.floor(Math.random()*999);
        var videoId = 'my-video'+rand;
        $("#play_div").remove();
        $("#video_div"+video_id).hide();
        $("#video_"+video_id).append('<div id="'+videoId+'" style="width: 100%" class="play_div"></div>');
        var player = new Aliplayer({
            id: videoId,
            source: url,
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
                    "name": "thumbnail"
                },
                {
                    "name": "controlBar",
                    "align": "blabs",
                    "x": 0,
                    "y": 0,
                    "children": [
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
                        }
                    ]
                }
            ]
        }, function (player) {
            is_play = true;
            hide_div = "video_div"+video_id;
            // player.play();
            console.log("播放器创建成功");
        });
    }
</script>
</body>
</html>