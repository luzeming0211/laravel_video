<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>医生认证</title>
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/auth/home.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/auth/base.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/certify.js')}}"></script>
</head>
<body>
<!-- 头部-导航栏 -->
@include('front_inc.header')
<!--内容-->
<div class="content">
            <section class="aui-content">
                <div style="height:20px;"></div>
                <div class="aui-content-up">
                    <form action="/auth-do" name="form1" method="post" enctype="multipart/form-data" >
                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="userid" name="userid" value="{{$userid}}">
                        <div class="aui-content-up-form">
                            @if(empty($user_info))
                                <h2>认证申请，申请机会仅有一次请您谨慎填写</h2>
                            @endif
                            @if(!empty($user_info))
                                    @if($user_info->status == 'READY')
                                        <h2>您已经递交认证申请，请耐心等候，2-3个工作日将为您下发审核结果</h2>
                                    @endif
                                    @if($user_info->status == 'ACCESS')
                                        <h2>您认证申请已经通过，享受高速的积分体验吧</h2>
                                    @endif
                                    @if($user_info->status == 'REJECT')
                                        <h2>您认证申请已经被驳回，如有异议请联系站方 TEL:13013001000</h2>
                                    @endif
                            @endif
                        </div>
                        <div @if(!empty($user_info))style="pointer-events: none;" @endif>
                        <div class="aui-form-group clear">
                            <label class="aui-label-control">
                                姓名 <em>*</em>
                            </label>
                            <div class="aui-form-input">
                                <input type="text" class="aui-form-control-two" name="name" onBlur="checkna()" required placeholder="请输入身份证名字"   @if(!empty($user_info)) value="{{$user_info->name}}" readonly @endif>
                                <span class="tips" id="divname">长度1~6个字符</span>
                            </div>
                        </div>
                        <div class="aui-form-group clear">
                            <label class="aui-label-control">
                                医生证号 <em>*</em>
                            </label>
                            <div class="aui-form-input">
                                <input type="text" class="aui-form-control-two" name="doc_card_id" id="doc_card_id" onBlur="check_doc_card_id()"@if(!empty($user_info)) value="{{$user_info->doc_card_id}}" readonly @endif  placeholder="请输入15位的医生证号"  required/>
                                <span class="tips" id="div_doc_card_id">必须是15位的数字</span>
                            </div>
                        </div>
                        <div class="aui-form-group clear">
                            <label class="aui-label-control">
                                身份证号码 <em>*</em>
                            </label>
                            <div class="aui-form-input">
                                <input type="text" class="aui-form-control-two" name="idcard" id="idcard"  @if(!empty($user_info)) value="{{$user_info->idcard}}" readonly @endif onBlur="check_idcard()"placeholder="请输入身份证号码"  required/>
                                <span class="tips" id="div_idcard">必须是18位</span>
                            </div>
                        </div>
                        <div class="aui-form-group-text">
                            @if(empty($user_info))
                                <button class="aui-btn aui-btn-account" type="button" onclick="check_info()">保存并提交审核</button>
                            @endif
                        </div>
                        </div>

                    </form>
                </div>
            </section>
</div>
<!-- 版权 -->
@include('front_inc.footer')
</body>
</html>
