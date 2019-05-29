<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/index.css')}}" />
    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <title>Hydrogen学院_搜索</title>
    <style>
        a {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="search_box">
    <div class="search_cont">
        <div class="search_txt">
            <span class="search_icon" style="border-right: 2px solid #ffffff;"></span>
            <input class="txt" id="search" type="text" placeholder="搜索" value=""  autofocus="autofocus"/>
        </div>
    </div>
    <input class="search_btn" type="button" value="搜索" />
</div>
<div class="ptop25">
    <div class="video_box">
        @if(!empty($video))
        @foreach($video as $key=>$val)
        <div class="video_line">
            <div class="video_pic">
                <a href="/mobile/detail/{{$val->id}}">
                    <img src="{{$val->thumb}}" style="height:88px;" />
                </a>
            </div>
            <div class="video_infor">
                <div class="video_tit">
                    <a href="/mobile/detail/{{$val->id}}">
                        {{$val->description}}                     </a>
                </div>
                <div class="video_doc">
                    {{$val->doc_name}}{{$val->profess}}                   </div>
                <div class="video_condition">
                    <div class="replay">观看回放</div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
   <script>
    $(".search_btn").click(function(){
        var search = $("#search").val();
        if (search == '' || search == null) {
            alert('请输入检索词');
            return false;
        }
        window.location.href = '/mobile/search?search='+search;
    });
</script>
</body>

</html>
