<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$video->catname}}</title>
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/laydate.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/alert/sweetalert.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/alert/sweetalert.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/zan_pc.js')}}" charset="utf-8"></script>


    <link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.1/skins/default/aliplayer-min.css" />
    <script type="text/javascript" charset="utf-8" src="https://g.alicdn.com/de/prismplayer/2.8.1/aliplayer-min.js"></script>
    <script type="text/javascript" charset="utf-8" src="https://player.alicdn.com/aliplayer/presentation/js/aliplayercomponents.min.js"></script>
    <script>
        var username = "{{$username}}";
        var userid = "{{$userid}}";
        var video_id = "{{$video->id}}";
        var video_url = "{{env('PLAY_URL')}}"+video_id;
    </script>
    <script>
    var xhr = new XMLHttpRequest();
    //配置请求方式、请求地址以及是否同步
    xhr.open('post', '/play/'+video_id, true);
    //设置请求结果类型为blob
    xhr.responseType = 'blob';
    //请求成功回调函数
    xhr.onload = function(e) {
    console.log(this.status);
    if (this.status == 200) {//请求成功
    //获取blob对象
    var blob = this.response;
    console.log(blob);
    //获取blob对象地址，并把值赋给容器
    // video_url =  URL.createObjectURL(blob);
    $("#sound").attr("src", URL.createObjectURL(blob));
    }
    };
    xhr.send();
    </script>
</head>
<body>
<!-- 头部-导航栏 -->
@include('front_inc.header')
<input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">

<div class="content_live_bg">
    <div class="content_live_box">
        <div class="tit_box clearfix">
            <div class="tit_left">{{$video->catname}}</div>
            <div class="tit_right">
                @if($video->is_admin)
                    <h4 style="float: left;color: red;">会员专享视频</h4>
                @else
                    <h4 style="float: left;">免费视频</h4>
                @endif
                <input type="button" class="btn btn_icon2
                @if(!empty($is_like))
                @if($is_like->del_flg == 'N')
                {{'btn_icon2_sele'}}
                @endif
                @endif" data-classid="{{$video->id}}"  id="like" onclick="like(this, 'like')"/>
                <input type="button" class="btn btn_icon3
                @if(!empty($is_collect))
                @if($is_collect->del_flg == 'N')
                {{'btn_icon3_sele'}}
                @endif
                @endif" data-classid="{{$video->id}}"  id="collect" onclick="collect(this, 'collect')"/>
            </div>
        </div>


        <div class="video_live_box">
            <div class="video_live_cont">
                <div id='a1' style="height: 500px;">
                    <video id="sound" style="height: 500px;" controls="controls"></video>
                </div>
            </div>

            <div class="video_live_right">
                <div class="tab_box">
                    <div class="tab_block">
                        <a class="sele" href="JavaScript:void(0)">评论</a>
                    </div>

                    <div class="clear"></div>
                </div>

                <div class="dialogue_box" id="talk" style="height:370px;">
                    {{--//评论区--}}
                    @foreach($video_comment as $k => $vc)
                        <span style="color:blue">{{$vc->username}}</span><span style="color:blue">：</span>{{$vc->comment}}<br>
                    @endforeach
                </div>

                <div class="send_box">
                    <input class="send_txt" type="text" id='send'/>
                    <input class="send_btn" type="button" value="发送" id="sendBtn"/>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="content_live_box clearfix">
    <div class="content_live_left">
        <div class="title_box">
            视频简介
        </div>
        <div class="video_time">
            {{$video->description}}
        </div>
        <div class="intro_box">
            <div class="tit">医生介绍:</div>
            <div class="intro_block clearfix">
                <div class="intro_left">
                    <img class="doc_pic" src="{{$video->thumb}}" />
                </div>
                <div class="intro_right">
                    <p>{{$video->summary}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="content_live_right" style="padding-top: 20px;">
        <div class="title_box">相关视频</div>
        @foreach($other_video as $key => $val)
            <div class="related_video_box">
                <div class="related_video_block clearfix">
                    <div class="related_left">
                        <a href="/video/{{$val->id}}">
                            <img class="related_pic" src="{{$val->thumb}}" />
                        </a>
                    </div>
                    <div class="related_right">
                        <div class="related_tit">
                            <a href="/video/{{$val->id}}">
                                {{$val->description}}                       </a>
                        </div>
                        <div class="related_txt"> 主讲：
                            {{$val->doc_name}}                         </div>
                        <div class="related_txt">
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        @endforeach

    </div>

</div>
<div class="cover" style="display: none;"></div>
<script>
    $(document).keyup(function(event){
        if(event.keyCode ==13){
            username = "{{$username}}";
            userid = "{{$userid}}";
            var video_id = "{{$video->id}}";
            if ((username == null) ||username == "") {
                window.location.href=login_url;return false;
            }
            var url = '/video/add-comment';
            var comment = $.trim($('#send').val());
            if(!comment){
                // alert('请输入内容！');
                return false;
            }
            if (comment.length > 1000) {
                alert("内容太长，最多 1000个文字");
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
                    $("#talk").append(str);
                    $('.dialogue_box').scrollTop( $('.dialogue_box')[0].scrollHeight );
                    $('#send').val('');
                }else{
                    swal({
                        title: "",
                        text: msg.error,
                        showConfirmButton: false,
                        showCancelButton: false,
                        timer:2000
                    })
                    $('#send').val('');
                }

            },'json');
        }
    });
</script>
<script>
    var domain = window.location.hostname
    var login_url = 'http://'+domain+"/login";
    $('#sendBtn').click(function(){
        username = "{{$username}}";
        userid = "{{$userid}}";
        var video_id = "{{$video->id}}";
        if ((username == null) ||username == "") {
            window.location.href=login_url;return false;
        }
        var url = '/video/add-comment';
        var comment = $.trim($('#send').val());
        if(!comment){
            // alert('请输入内容！');
            return false;
        }
        if (comment.length > 1000) {
            alert("内容太长，最多 1000个文字");
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
                $("#talk").append(str);
                $('.dialogue_box').scrollTop( $('.dialogue_box')[0].scrollHeight );
                $('#send').val('');
            }else{
                swal({
                    title: "",
                    text: msg.error,
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer:2000
                })
                $('#send').val('');
            }

        },'json');
    });

</script>
<!-- 版权 -->
@include('front_inc.footer')

</body>
</html>
