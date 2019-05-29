<!doctype html>
<html class="no-js fixed-layout">
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
    <script language="JavaScript" src="{{asset('assets/js/echarts.min.js')}}"></script>
    <title>@yield('title')</title>
</head>
<body data-type="index">

    @section('jsandcss')
<script language="JavaScript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/js/amazeui.min.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/js/iscroll.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/js/app.js')}}"></script>
@show

