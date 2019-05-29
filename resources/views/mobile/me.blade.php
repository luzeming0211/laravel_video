<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/index.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/mobile/css/me.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/alert/sweetalert.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/alert/sweetalert.min.js')}}"></script>

    <script>
        userid = '{{$userid}}';
    </script>
    <title>Hydrogen学院</title>
</head>

<body>
<div class="scroll_box">
    <div class="head_box" style="border-bottom: 1px solid #dbdbdb;">
        <div class="head_block">Hydrogen学院</div>
        <a class="back" href="/mobile/index"></a>
    </div>
    <div class="review_box clearfix" style="" >
        <div >
            <div class="profile-card js-profile-card">
                <div class="profile-card__img" style="box-shadow: none;">
                </div>
                <div class="profile-card__cnt js-profile-cnt">
                    <div class="profile-card__name">亲爱的{{$username}}</div>
                    <div class="profile-card__txt">{{$vip_msg}}
                        <br>
                        <strong>{{$e_time}}</strong></div>
                    <div class="profile-card-loc">
                        <span class="profile-card-loc__txt"></span>
                    </div>

                    <div class="profile-card-inf">
                        <div class="profile-card-inf__item" style="min-width: 10px">
                            <div class="profile-card-inf__title">{{$collect_num->num}}</div>
                            <div class="profile-card-inf__txt">收藏</div>
                        </div>

                        <div class="profile-card-inf__item" style="min-width: 10px">
                            <div class="profile-card-inf__title">{{$like_num->num}}</div>
                            <div class="profile-card-inf__txt">点赞</div>
                        </div>


                        <div class="profile-card-inf__item" style="min-width: 10px">
                            <div class="profile-card-inf__title">{{$score}}</div>
                            <div class="profile-card-inf__txt">积分</div>
                        </div>
                    </div>

                    <div class="profile-card-ctr">
                        <a href="javascript:void(0)"   onclick="certify()" class="profile-card__button button--blue js-message-btn" >我要认证</a>
                        <a href="/pay" class="profile-card__button button--orange">开通会员</a>
                        <a href="#" onclick="addscore({{$score}})" class="profile-card__button button--blue">积分兑换</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</html>
<script>
    function certify() {
        swal({
            title: "",
            text: "请在电脑上完成认证",
            timer:1000,
            showConfirmButton: false,
            showCancelButton: false,
        })
    }
</script>
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
                alert(msg.error);
            }
        },'json');
    }
</script>
