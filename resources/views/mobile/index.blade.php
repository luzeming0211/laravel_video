<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/index.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/alert/sweetalert.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/leftTime.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/alert/sweetalert.min.js')}}"></script>
    <title>Hydrogen学院</title>
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
<div class="scroll_box">
    <div class="head_box" style="border-bottom: 1px solid #dbdbdb;">
        <div class="head_block">Hydrogen学院</div>
        <a class="back" href="/mobile/index"></a>
    </div>
    <div class="nav_box" style="border-bottom: 1px solid #dbdbdb;">
        <div class="sml_menu_box">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a class="sele"	href="/mobile/index" >推荐</a>
                    </div>
                    @foreach($category2 as $key => $val)
                        <div class="swiper-slide">
                            <a      id="{{$val->id}}"
                                    href="/mobile/cat?cat={{$val->id}}"
                            > {{$val->catname}}					</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="nav_more">
            <div class="more"></div>
        </div>
    </div>
    <div class="banner_box no_branch" id="banner_photo">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="{{$ad_index1->url}}"> <img style="width: 100%;height: 210px"
                                      src="{{$ad_index1->photo}}" /> </a>
                </div>
                <div class="swiper-slide">
                    <a href="{{$ad_index2->url}}"> <img style="width: 100%;height: 210px"
                                      src="{{$ad_index2->photo}}" /> </a>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    @if(!$live->isEmpty())
    <div class="tit_box no_branch" id="recent_live">
        <div class="tit_left">近期直播</div>
        <div class="tit_right">
            <a href="/mobile/live" class="more">全部</a>
        </div>
    </div>
    <div class="video_box no_branch" id="recent_live_content">
        @if(empty($live))
            <div class="txt" style="font-size: 15px; color: #666666; height: 40px">&nbsp;&nbsp;&nbsp;暂无直播，敬请期待</div>
        @endif
        @foreach($live as $liv=>$val)
            <div class="video_line">
                <div class="video_pic">
                    <a href="javascript:void(0);"  onclick="expect_live('{{$liv}}' , '{{$val}}')">  <img src="{{$val->thu}}" style="height: 88px;">  </a>
                </div>
                <div class="video_infor">
                    <div class="video_tit">
                        <a href="#">{{$val->des}}		</a>
                    </div>
                    <div class="video_doc" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis">
                        {{$val->doc_name}}{{$val->profess}}      	 /  {{$val->summary}}		</div>
                    <div class="video_condition">
                        <div id="colockbox" class="countdown class_id_549">
                            距开始 <span class="hour" id="{{'hour_'.$liv}}" >00</span> : <span class="minute" id="{{'minute_'.$liv}}">00</span> : <span class="second" id="{{'second_'.$liv}}">00</span>
                        </div>
                        <div class="video_time">
                            {{$val->date}}   			</div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
    <div class="tit_box no_branch" id="live_now_title">
        <div class="tit_left">正在直播</div>
        <div class="tit_right">
            <a href="/mobile/live" class="more">全部</a>
        </div>
    </div>
    <div class="review_box clearfix" style="" id="live_now">
        @foreach($liveIng as $key=>$val)
            <div class="review_block">
                <div class="review_pic">
                    <a href="/mobile/live/{{$val->id}}"
                       class="review_link">  <img src="{{$val->thu}}" />  </a>
                </div>
                <div class="review_tit">
                    <a href="/mobile/live/{{$val->id}}">{{$val->des}}		</a>
                </div>
                <div class="review_infor">
                    专家：{{$val->doc_name}}{{$val->profess}}			</div>
            </div>
        @endforeach
    </div>
    <div class="tit_box no_branch" id="video_title">
        <div class="tit_left">为你推荐</div>
        <div class="tit_right">
        </div>
    </div>
    <div class="review_box clearfix"  style="padding-top: 20px;"  id="video_content">
        @foreach($video as $key=>$val)
            <div class="review_block">
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
    </div>
    <div class="cover"></div>
    <div class="nav_all_box" id="nav_all_box">
        <div class="nav_all_tit">
            所有科室 <input type="button" class="nav_all_close" />
        </div>
        <div class="nav_all_cont">
            <ul>
                @foreach($category2 as $key => $val)

                    <li><a id="{{$val->id}}"
                           class="all_branch_id "
                           href="/mobile/cat?cat={{$val->id}}" > {{$val->catname}}		</a>
                    </li>

                @endforeach
                <li class="interval"></li>
            </ul>
        </div>
    </div>
    <script language="JavaScript" src="{{asset('assets/mobile/js/index.js')}}"></script>
    <script>
        function expect_live(id ,val) {
            var domain = window.location.hostname
            var url = 'http://'+domain+"/mobile/live/";
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

</body>
</html>
