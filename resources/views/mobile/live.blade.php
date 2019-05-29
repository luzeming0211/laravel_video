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
    <style>
        a {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="head_box" style="border-bottom: 1px solid #dbdbdb;">
    <div class="head_block">直播列表</div>
    <a class="back" href="javascript:void(0);"></a>
</div>
<div class="ptop25">
    <div class="video_box">
        @foreach($live as $key=>$val)
        <div class="video_line">
            <div class="video_pic">
                <a href="/mobile/live/{{$val->id}}">
                    <img src="{{$val->thu}}" style="height:88px;" />
                </a>
            </div>
            <div class="video_infor">
                <div class="video_tit">
                    <a href="/mobile/live/{{$val->id}}">
                        {{$val->des}}                     </a>
                </div>
                <div class="video_doc">
                         </div>
                <div class="video_condition">
                    <div class="replay"></div>
                </div>
            </div>
        </div>
        @endforeach



    </div>
</div>
   <script>
    $(".search_no_btn").click(function(){
        window.location.href="http://class.medlive.cn";
    });
    $(".search_btn").click(function(){
        var search = $("#search").val();
        if (search == '' || search == null) {
            alert('请输入检索词');
            return false;
        }
        window.location.href = '/mobile/search?search='+search;
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
