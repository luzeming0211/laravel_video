<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <li><a href="#">vip管理</a></li>
            <li class="am-active">vip列表</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 列表
                </div>


            </div>
            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                {{--<button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del_select('/admin/auth/vip/del')"><span class="am-icon-trash-o"></span> 删除</button>--}}
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
                                    <th class="table-check"><input type="checkbox" class="tpl-table-fz-check" id="all" onclick="select_all()"></th>
                                    <th class="table-id">ID</th>
                                    <th class="table-title">开始时间</th>
                                    <th class="table-type">结束时间</th>
                                    <th class="table-date am-hide-sm-only">积分</th>
                                    <th class="table-edit">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user_vip as $key => $val)
                                    <tr>
                                        <td><input type="checkbox" name="item[]" value="{{$val->userid}}"></td>
                                        <td>{{$val->userid}}</td>
                                        <td>{{$val->s_time}}</td>
                                        <td>{{$val->e_time}}</td>
                                        <td class="am-hide-sm-only">{{$val->score}}</td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span><a href="/admin/auth/vip/{{$val->userid}}/edit">编辑</a></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <div class="am-cf">

                                <div class="am-fr">
                                    {!!$user_vip->links('vendor.pagination.admin_pa')!!}
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