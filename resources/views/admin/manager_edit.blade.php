<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon"  type="image/png" href="{{asset('assets/i/favicon.png')}}" />
    <link rel="apple-touch-icon-precomposed"  href="{{asset('assets/i/app-icon72x72@2x.png')}}" />
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet"  href="{{asset('assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/admin.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/app.css')}}" />
</head>

<body data-type="generalComponents">

@include('admin_inc.header')


<div class="tpl-page-container tpl-page-header-fixed">
    @include('admin_inc.leftbar')




    <div class="tpl-content-wrapper">

        <ol class="am-breadcrumb">
            <li><a href="#">管理员管理</a></li>
            <li class="am-active">管理员编辑</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 编辑
                </div>


            </div>

            <div class="tpl-block">

                <div class="am-g">
                    <div class="tpl-form-body tpl-form-line">
                        <form class="am-form tpl-form-line-form" method="post" action="/admin/auth/ma/{{$admin_info->account_number}}">
                            @include('admin_inc.errors')
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put"/>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">account_number <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="account_number" id="account_number" value="{{$admin_info->account_number}}" readonly>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">用户名 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" name="name" id="name" value="{{$admin_info->name}}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">新密码 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="password" name="password" id="password" value="{{ old('password') }}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">确认密码 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>






    </div>

</div>

@include('admin_inc.script')
{{--<script>--}}
    {{--$(document).ready(function (){--}}
        {{--@if (Session::has('error'))--}}
        {{--alert('{{Session::get('error') }}');--}}
        {{--@endif--}}
    {{--});--}}
{{--</script>--}}

</body>

</html>