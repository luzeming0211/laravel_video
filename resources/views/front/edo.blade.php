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

    @include('admin_inc.script')
<!-- 配置文件 -->
    <script src="{{asset('assets/ueditor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script src="{{asset('assets/ueditor/ueditor.all.js')}}"></script>
    <!-- 语言包文件(建议手动加载语言包，避免在ie下，因为加载语言失败导致编辑器加载失败) -->
    <script src="{{asset('assets/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <!--135编辑器-->
</head>

<body data-type="generalComponents">





{!! $data !!}



{{--<div class="tpl-page-container tpl-page-header-fixed">--}}








{{--</div>--}}

</body>
</html>