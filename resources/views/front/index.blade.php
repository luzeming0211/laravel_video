<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>HYDROGEN学院</title>

    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/laydate.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/alert/sweetalert.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/laydate.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/leftTime.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/alert/sweetalert.min.js')}}"></script>


    <script>
        @foreach($live as $liv=>$va)
        $.leftTime('{{$va->start_time}}',function(d){
            $("{{'#hour_'.$liv}}").text(d.d);
            $("{{'#minute_'.$liv}}").text(d.m);
            $("{{'#second_'.$liv}}").text(d.s);
        });
        @endforeach
    </script>
</head>
<body>
<!-- 头部-导航栏 -->
@include('front_inc.header')
<!-- banner -->
<div class="banner">
    <div class="banner--content">
        <div id="slideBox" class="slideBox">
            <div class="hd">
                <span class="pageState"></span>
            </div>
            <div class="bd">
                <ul>
                    <li><a href="{{$ad_index1->url}}" target="_blank"><img  src="{{$ad_index1->photo}}"/></a></li>
                    <li><a href="{{$ad_index2->url}}" target="_blank"><img  src="{{$ad_index2->photo}}"/></a></li>
                    {{--<li><a href="{{(config('hydrogen.default_url1'))}}" target="_blank"><img  src="{{asset(config('hydrogen.default_pic1'))}}"/></a></li>--}}
                    {{--<li><a href="{{(config('hydrogen.default_url2'))}}" target="_blank"><img  src="{{asset(config('hydrogen.default_pic2'))}}"/></a></li>--}}
                </ul>
            </div>
            <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
            <a class="prev" href="javascript:void(0)"></a>
            <a class="next" href="javascript:void(0)"></a>
        </div>
    </div>
</div>
<!--内容-->
<div class="content">
    <div class="container">
        <div class="container__block">
            <div class="title clearfix">
                <div class="title__left">
                    近期直播
                </div>
                <div class="title__right">
                    <a href="/live">正在直播 ></a>
                </div>
            </div>
            <div class="content__list clearfix">
                @if($live->isEmpty()) <div class="txt" style="font-size:16px;color:#666666;height:48px">&nbsp;&nbsp;暂无期待直播，您可观看正在直播</div> @endif
                @foreach($live as $liv=>$val)
                    <a href="javascript:void(0);"  onclick="expect_live('{{$liv}}' , '{{$val}}')" @if($liv == 0) class="content__line" @else class="content__line mar0"  @endif >
                        <div class="pic">
                            <img src="{{$val->thu}}" alt="">
                        </div>
                        <div class="txt">
                            <h4>{{$val->des}}</h4>
                            <div style="min-height: 54px;">
                                <p>主讲：
                                    {{$val->doc_name}}{{$val->profess}}            	</p>
                                <p style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis"> {{$val->summary}}      </p>
                            </div>
                            <div class="clearfix">
                                <div id="colockbox" class="countdown class_id_549">
                                    距开始 <span class="hour" id="{{'hour_'.$liv}}" >00</span> : <span class="minute" id="{{'minute_'.$liv}}" >00</span> : <span class="second" id="{{'second_'.$liv}}" >00</span>
                                </div>
                                <div class="time">
                                    {{$val->date}}           </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="title clearfix">
                <div class="title__left">
                    为你推荐
                </div>
                <div class="title__right">
                    <a href="/video/cat/0">查看全部 ></a>
                </div>
            </div>
            <div class="content__list content__list_2 clearfix">
                @foreach($video as $key=>$val)
                    <a href="/video/{{$val->id}}" @if($key==0||($key%3)!=0) class="content__line" @else class="content__line mar0" @endif>
                        <div class="pic">
                            <img src="{{$val->thumb}}" alt="">
                            <div class="play_cover">
                                <div class="play_bg"></div>
                                <div class="play">点击观看</div>
                            </div>
                        </div>
                        <div class="txt">
                            <h4>{{$val->description}}</h4>
                            <div>

                                <p>主讲：{{$val->doc_name}}{{$val->profess}}</p>
                                <p>科室：{{$val->catname}}</p>
                                <p>会员专享：
                                    @if($val->is_admin == 1)
                                        是
                                    @else
                                        否
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="more_btn_block">
            {{--//<input class="more_btn" type="button" value="查看更多" onclick="window.location.href='http://class.medlive.cn/class/list/0'"/>--}}
        </div>
    </div>
</div><!-- 版权 -->
@include('front_inc.footer')
</body>
<script>
    jQuery(".slideBox").slide({mainCell:".bd ul",autoPlay:($('.slideBox .bd li').length>1?true:false),effect:"leftLoop"});
    function expect_live(id ,val) {
        var domain = window.location.hostname
        var url = 'http://'+domain+"/live/";
        val = JSON.parse(val);
        live_id = val.id;
        var hour =$('#hour_'+id).html();
        var minute =$('#minute_'+id).html();
        var second =$('#second_'+id).html();
        if(hour == "00" && minute == "00" && second == "00"){
            window.location.href = url + live_id;
        }else{
            swal({
                title: "",
                text: "敬请期待",
                timer:1000,
                showConfirmButton: false,
                showCancelButton: false,
            })
        }
    }
</script>
</html>
