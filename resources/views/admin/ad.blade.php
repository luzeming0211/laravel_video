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
    {{--<link rel="stylesheet"  href="{{asset('assets/css/app1.css')}}" />--}}
</head>

<body data-type="generalComponents">

@include('admin_inc.header')








<div class="tpl-page-container tpl-page-header-fixed">

    @include('admin_inc.leftbar')
    @include('admin_inc.msg')




    <div class="tpl-content-wrapper">

        <ol class="am-breadcrumb">
            <li><a href="#">广告</a></li>
            <li class="am-active">列表</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 列表
                </div>

            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-g">
                    <div class="tpl-table-images">
                        <form class="am-form">
                            <table class="am-table am-table-striped am-table-hover table-main">
                                <thead>
                                <tr>
                                    <th class="table-id">ID</th>
                                    <th class="table-type">标题</th>
                                    <th class="table-type">图片</th>
                                    <th class="table-type">位置</th>
                                    <th class="table-type">链接</th>
                                    <th class="table-date am-hide-sm-only">时间</th>
                                    <th class="table-date am-hide-sm-only">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ad as $key => $val)
                                <tr>
                                    <td>{{$val->id}}</td>
                                    <td>{{$val->title}}</td>
                                    <td>{{$val->photo}}</td>
                                    <td>{{$val->position}}</td>
                                    <td>{{$val->url}}</td>
                                    <td class="am-hide-sm-only">{{$val->created_at}}</td>
                                    <td class="am-hide-sm-only"><button> <a href="/admin/ad/{{$val->id}}/edit">修改</a> </button></td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <div class="am-cf">

                                <div class="am-fr">
                                    {!!$ad->links('vendor.pagination.admin_pa')!!}
                                </div>
                            </div>
                            <hr>

                        </form>



                    </div>

                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>
    </div>

</div>

@include('admin_inc.script')
</body>
</html>