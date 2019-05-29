<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/index.css')}}" />
    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <title>Hydrogen学院</title>
</head>

<body>
<div class="scroll_box">
    <div class="head_box" style="border-bottom: 1px solid #dbdbdb;">
        <div class="head_block">视频详情</div>
        <a class="back" href="javascript:void(0);"></a>
    </div>
    <div class="relative" style="min-height: 15px;">
        <img src="{{$video->thumb}}" />
    </div>
    <div class="detail_box">
        <div class="detail_tit">{{$video->catname}}</div>
        <div class="detail_time">{{$video->created_at}} </div>
        <div class="detail_btm">
            <input class="detail_btn" type="button" value="观看视频" id='turnclose'/>
        </div>
    </div>
</div>
<div class="" style="z-index: 100;">
    <div class="sml_nav_box">
        <a class="sele" href="#">直播简介</a>
        <a href="#">专家介绍</a>
        <a href="#">相关直播</a>
    </div>
</div>
<div class="cont_box" style="padding-top: 20px;">
    <div class="txt_block txt_block1">
        <p class="txt"> {{$video->description}}</p>
    </div>
    <div class="txt_block txt_block2" style="display: none;">
        <p class="txt">{{$video->summary}}</p>
    </div>
    <div class="video_box txt_block3" style="display: none;">
        @foreach($other_video as $key => $val)
        <div class="video_line">
            <div class="video_pic">
                <a href="/mobile/detail/{{$val->id}}">
                    <img src="{{$video->thumb}}" style="height:88px;">
                </a>
            </div>
            <div class="video_infor">
                <div class="video_tit">
                    <a href="/mobile/detail/{{$val->id}}">
                        {{$val->description}}                            </a>
                </div>
                <div class="video_doc">
                    {{$val->doc_name}}                     </div>
                <div class="video_condition">
                    <div class="replay">观看回放</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="cover" style="display: none;"></div>
<script>

    $(document).ready(function () {
        //菜单选择
        $('.sml_nav_box a').click(function () {
            $('.sml_nav_box a').removeClass("sele");
            $(this).addClass("sele");
            $('html,body').animate({
                scrollTop:$('.scroll_box').height()
            },500);

            var sele = $(".sele").text();
            if (sele == '直播简介') {
                $(".txt_block1").show();
                $(".txt_block2").hide();
                $(".txt_block3").hide();
            } else if (sele == '专家介绍') {
                $(".txt_block1").hide();
                $(".txt_block2").show();
                $(".txt_block3").hide();
            } else {
                $(".txt_block1").hide();
                $(".txt_block2").hide();
                $(".txt_block3").show();
            }
        });

        $(window).scroll(function () {
            if($(window).scrollTop()>$('.scroll_box').height()){
                $('.sml_nav_box').parent().addClass("fixed");
                $('.cont_box').css("padding-top","60px");
                $('.cont_box').css("min-height",$(window).height()-69);
            } else {
                $('.sml_nav_box').parent().removeClass("fixed");
                $('.cont_box').css("padding-top","20px");
                $('.cont_box').css("min-height",$(window).height()-20);
            }
        });
    });



    var domain = window.location.hostname
    $("#turnclose").click(function(){
        var url = 'http://'+domain+'/mobile/video/{{$video->id}}';
        window.location.href=url;
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
</html>
