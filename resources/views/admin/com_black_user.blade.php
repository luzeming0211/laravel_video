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
            <li><a href="#">视频管理</a></li>
            <li class="am-active">评论黑名单</li>
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
                                <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del_select('/admin/video/comment/black/del')"><span class="am-icon-trash-o"></span> 删除</button>
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
                                    <th class="table-title">userid</th>
                                    <th class="table-type">原因</th>
                                    <th class="table-type">次数</th>
                                    <th class="table-date am-hide-sm-only">创建时间</th>
                                    <th class="table-date am-hide-sm-only">编辑时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($black_user as $key => $val)
                                    <tr>
                                        <td><input type="checkbox" name="item[]" value="{{$val->userid}}"></td>
                                        <td>{{$val->userid}}</td>
                                        <td>{{$val->reason}}</td>
                                        <td>{{$val->num}}</td>
                                        <td class="am-hide-sm-only">{{$val->created_at}}</td>
                                        <td class="am-hide-sm-only">{{$val->updated_at}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <div class="am-cf">

                                <div class="am-fr">
                                    {!!$black_user->links('vendor.pagination.admin_pa')!!}
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