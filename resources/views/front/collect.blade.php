<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>收藏</title>
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>



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
                    <a href="/collect" class="active">我的收藏</a>
                </li>
                <li>
                    <a href="/mail" >站内信</a>
                </li>
            </ul>
        </div>
            <div class="container-right">
            <div class="title">
                <p>本周收藏数 <span>{{$recent_count}}</span></p>
            </div>
            <div class="view_list">
                <div class="container__block">
                    <div class="content__list content__list_2 clearfix">
                        @foreach($video as $key=>$val)
                            <a href="/video/{{$val->id}}" @if($key==0||($key%2)!=0) class="content__line" @else class="content__line mar0" @endif>
                                <div class="pic">
                                    <img src="{{$val->thumb}}"  alt="">
                                </div>
                                <div class="txt">
                                    <h4>{{$val->description}}</h4>
                                    <div>
                                        <p>主讲：{{$val->doc_name}}{{$val->profess}}</p>
                                        <p>科室：{{$val->catname}}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
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
