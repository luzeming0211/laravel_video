<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>直播</title>
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
<div class="content">
    <div class="container">
        <div class="container__block">
            <div class="content__list content__list_2 clearfix">
                @if($live->isEmpty()) <div class="txt" style="font-size:16px;color:#666666;height:48px">&nbsp;&nbsp;暂无直播，敬请期待</div> @endif

                @foreach($live as $key=>$val)
                    <a href="/live/{{$val->id}}" @if($key==0||($key%3)!=0) class="content__line" @else class="content__line mar0" @endif>
                        <div class="pic">
                            <img src="{{$val->thu}}" alt="">
                        </div>
                        <div class="txt">
                            <h4>{{$val->des}}</h4>
                            <div>
                                <p>主讲：
                                    吉中孚教授             	</p>
                                <p></p>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </div>
    <div class="flip">
        <ul>
        </ul>
    </div>
</div>
<!-- 版权 -->
@include('front_inc.footer')

</body>
</html>
