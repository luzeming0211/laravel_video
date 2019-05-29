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
            <li><a href="#">用户管理</a></li>
            <li class="am-active">用户列表</li>
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
                                <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span><a href="/admin/auth/user/create">新增</a> </button>
                                <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del_select('/admin/auth/ma/del')"><span class="am-icon-trash-o"></span> 删除</button>
                                <button type="button" class="am-btn am-btn-warning"></span><a href="/admin/auth/user/export">用户数据导出</a> </button>
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
                                    <th class="table-title">用户名</th>
                                    <th class="table-type">邮箱</th>
                                    <th class="table-date am-hide-sm-only">创建时间</th>
                                    <th class="table-edit">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user as $key => $val)
                                    <tr>
                                        <td><input type="checkbox" name="item[]" value="{{$val->userid}}"></td>
                                        <td>{{$val->userid}}</td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->email}}</td>
                                        <td class="am-hide-sm-only">{{$val->create_time}}</td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs">
                                                    <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span><a href="/admin/auth/user/{{$val->userid}}/edit">编辑</a></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <div class="am-cf">

                                <div class="am-fr">
                                    {!!$user->links('vendor.pagination.admin_pa')!!}
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