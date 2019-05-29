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
        <div class="head_block">Hydrogen学院</div>
        <a class="back" href="/mobile/index"></a>
        <a class="search" href="/mobile/search"></a>
        <a class="user" href="#"></a>
    </div><div class="nav_box" style="border-bottom: 1px solid #dbdbdb;">
        <div class="sml_menu_box">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a 	href="/mobile/index" >推荐</a>
                    </div>
                    @if(!empty($catid))
                        <div class="swiper-slide">
                            <a class="sele" href="javascript:void(0);"
                               onclick="moveSlide({{$catid}});">{{$catinfo->catname}}
                            </a>
                        </div>
                    @endif

                    @foreach($category2 as $key => $val)
                        @if($catid == $val->id)
                            @continue
                        @endif
                        <div class="swiper-slide" >
                            <a id="{{$val->id}}"
                               href="javascript:void(0);" onclick="moveSlide({{$val->id}})"
                            >
                                {{$val->catname}}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="nav_more">
            <div class="more"></div>
        </div>
    </div>

    <div class="review_box clearfix" style="padding-top: 20px;" id="video_content">
        @foreach($video as $key=>$val)
            <div class="review_block" >
                <div class="review_pic">
                    <a href="/mobile/detail/{{$val->id}}"
                       class="review_link">  <img src="{{$val->thumb}}" />  </a>
                </div>
                <div class="review_tit">
                    <a href="/mobile/detail/{{$val->id}}">{{$val->description}}		</a>
                </div>
                <div class="review_infor">
                    科室：{{$val->catname}}
                </div>
                <div class="review_infor">
                    专家：{{$val->doc_name}}{{$val->profess}}
                </div>
                <div class="review_infor">
                    会员专享：@if($val->is_admin == 1)
                        是
                    @else
                        否
                    @endif
                </div>
            </div>
        @endforeach
        @if($video->total() > 8)
            <div class="loading_box" onclick="more(8,'{{$catid}}',2)" id="more"><div class="loading">点击加载更多</div></div>
        @else
            <div class="loading_box" ><div class="loading">已加载全部</div></div>
        @endif
    </div>
    <div class="cover"></div>
    @include('mobile_inc.right')
    <div class="nav_all_box" id="nav_all_box">
        <div class="nav_all_tit">
            所有科室 <input type="button" class="nav_all_close" />
        </div>
        <div class="nav_all_cont">
            <ul>
                @foreach($category2 as $key => $val)

                    <li><a id="{{$val->id}}"
                           class="all_branch_id "
                           href="/mobile/cat?cat={{$val->id}}"> {{$val->catname}}		</a>
                    </li>

                @endforeach
                <li class="interval"></li>
            </ul>
        </div>
    </div>
</html>
<script>
    var page = 2;
    function more(size,catid,page) {
        $.post(
            '/mobile/cat/more',
            {
                '_token':"{{csrf_token()}}",
                'page':page,
                'size':size,
                'catid':catid,
            },
            function (data) {
                var list = $("#video_content");
                list.append(data.data);
                $("#more").remove();
            },
            'json'
        );
        page++;
    }
    function moveSlide(catid) {
        $.post(
            '/mobile/cat',
            {
                '_token':"{{csrf_token()}}",
                'catid': catid,
            },
            function (data) {
                $("#video_content").html("");
                var list = $("#video_content");
                list.append(data.video);
                $("#banner_photo").remove();
                $("#live_now").remove();
                $("#live_now_title").remove();
                $("#video_title").remove();
                $("#recent_live").remove();
                $("#recent_live_content").remove();
            },
            'json'
        );
    }
</script>
<script language="JavaScript" src="{{asset('assets/mobile/js/index.js')}}"></script>