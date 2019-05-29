<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/index.css')}}" />
    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    {{--<script type="text/javascript" src="static/js/countdown.js"></script>--}}



    <title>Hydrogen学院</title>
</head>

<body>
<div class="scroll_box">
    <div class="head_box" style="border-bottom: 1px solid #dbdbdb;">
        <div class="head_block">Hydrogen学院</div>
        <a class="back" href="/mobile/index"></a>
    </div>
    <div class="review_box clearfix"  style="padding-top: 20px;" >
            @foreach($video as $key=>$val)
            <div class="review_block">
                <div class="review_pic">
                    <a href="/mobile/detail/{{$val->id}}"
                       class="review_link">  <img src="{{$val->thumb}}" style="height: 124.51px"/>  </a>
                </div>
                <div class="review_tit">
                    <a href="/mobile/detail/{{$val->id}}">{{$val->description}}		</a>
                </div>
                <div class="review_infor">
                    科室：{{$val->catname}}			</div>
                <div class="review_infor">
                    专家：{{$val->doc_name}}{{$val->profess}}	</div>
            </div>
            @endforeach
    </div>
    {{--<script language="JavaScript" src="{{asset('assets/mobile/js/class.js')}}"></script>--}}
    <div class="cover"></div>
</html>
{{--<script>--}}
    {{--//    alert($('.banner_box .swiper-slide').length>1?true:false);--}}
    {{--//banner轮播--}}
    {{--var bannerSwiper = new Swiper('.banner_box .swiper-container', {--}}
        {{--pagination: '.banner_box .swiper-pagination',--}}
        {{--paginationType: 'fraction',--}}
        {{--loop : $('.banner_box .swiper-slide').length>1?true:false,--}}
        {{--autoplay : 3000--}}
    {{--});--}}
    {{--$(".cover").click(function(){--}}
        {{--$(".menu_open").hide();--}}
        {{--$(".cover").hide();--}}
        {{--$("#nav_all_box").hide();--}}
    {{--});--}}
    {{--$(".user").click(function(){--}}
        {{--$(".menu_open").show();--}}
        {{--$(".cover").show();--}}
    {{--});--}}
    {{--$(function () {--}}
        {{--//“近期直播”时间--}}
        {{--if($('.video_condition').width()<$('.countdown').width()+$('.video_time').width()) {--}}
            {{--$('.video_time').css({"float":"left","text-align":"left"});--}}
        {{--}--}}
        {{--//定义回顾中图片大小--}}
        {{--$('.review_pic img').height($('.review_pic').width()*252/336);--}}
        {{--$('.review_link').height ($('.review_pic').width()*252/336);--}}


        {{--//菜单--}}
        {{--$('.user').click(function () {--}}
            {{--event.stopPropagation();--}}
            {{--$('.menu_box').addClass("menu_open");--}}
            {{--$('.cover').show();--}}
        {{--});--}}

        {{--//科室--}}
        {{--$('.nav_more').click(function () {--}}
            {{--event.stopPropagation();--}}
            {{--$('.nav_all_box').addClass("nav_all_show");--}}
            {{--$('.cover').show();--}}
            {{--$('.nav_all_box').show();--}}
        {{--});--}}
        {{--$('.nav_all_tit').click(function () {--}}
            {{--event.stopPropagation();--}}
            {{--$('.nav_all_box').removeClass("nav_all_show");--}}
            {{--$('.cover').hide();--}}
        {{--});--}}
        {{--$(document).click(function(){--}}
            {{--//$('.menu_box').removeClass("menu_open");--}}
            {{--//$('.nav_all_box').removeClass("nav_all_show");--}}
            {{--//$('.cover').hide();--}}
        {{--});--}}
    {{--})--}}
{{--</script>--}}