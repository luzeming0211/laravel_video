<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>个人信息</title>
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/me.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/alert/sweetalert.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/alert/sweetalert.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>
    <script>
        userid = '{{$userid}}';
    </script>
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
                    <a href="/me" class="active" >个人信息</a>
                </li>
                <li>
                    <a href="/collect" >我的收藏</a>
                </li>
                <li>
                    <a href="/mail" >站内信</a>
                </li>
            </ul>
        </div>
        <div class="view_list" >
            <div >
            <div class="profile-card js-profile-card">
                <div class="profile-card__img" style="box-shadow: none;">
                </div>

                <div class="profile-card__cnt js-profile-cnt">
                    <div class="profile-card__name">{{$userid}}亲爱的{{$username}}用户您好</div>
                    <div class="profile-card__txt">{{$vip_msg}} <strong>{{$e_time}}</strong></div>
                    <div class="profile-card-loc">
                   <span class="profile-card-loc__txt"></span>
                    </div>

                    <div class="profile-card-inf">
                        <div class="profile-card-inf__item">
                            <div class="profile-card-inf__title">{{$collect_num->num}}</div>
                            <div class="profile-card-inf__txt">收藏</div>
                        </div>

                        <div class="profile-card-inf__item">
                            <div class="profile-card-inf__title">{{$like_num->num}}</div>
                            <div class="profile-card-inf__txt">点赞</div>
                        </div>


                        <div class="profile-card-inf__item">
                            <div class="profile-card-inf__title">{{$score}}</div>
                            <div class="profile-card-inf__txt">积分</div>
                        </div>
                    </div>

                    <div class="profile-card-ctr">
                        <a href="/auth" class="profile-card__button button--blue js-message-btn" >我要认证</a>
                        <a href="/pay" class="profile-card__button button--orange">开通会员</a>
                        <a href="#" onclick="addscore({{$score}})" class="profile-card__button button--blue">积分兑换</a>
                    </div>



                    </div>



                </div>



            </div>


        </div>

        <div class="div_tip" style="background: white;color: mediumvioletred;">
            <div class="tip" >
                <p>会员特权：</p>
                每月仅10元
                <br/>
                看视频免等待；
                <br/>
                丰富的视频资源；
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
<script>
    function addscore(score) {
        if(score < 100){
            swal({
                title: "",
                text: "积分不够无法兑换!",
                showConfirmButton: false,
                showCancelButton: false,
                timer:1000
            })
            return false;
        }
        swal(
            {
                title:"",
                text:"点击确定消耗积分兑换会员",
                showCancelButton:true,
                confirmButtonColor:"#DD6B55",
                confirmButtonText:"确定",
                cancelButtonText:"取消",
                closeOnConfirm:true,
                closeOnCancel:true
            },
            function(isConfirm)
            {
                if(isConfirm)
                {
                    confirm_add(score)
                }
            }
        )
    }
    function confirm_add(score) {
        var data = {
            '_token': "{!! csrf_token() !!}",
            'userid' : userid,
            'score' : score,
        }
        var url = '/me/score';
        $.post(url, data, function(msg){
            console.log(msg);
            if(msg.success){
                window.location.reload();
            }else{
                swal({
                    title: "",
                    text: msg.error,
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer:1000
                })
            }
        },'json');
    }
</script>
</html>
