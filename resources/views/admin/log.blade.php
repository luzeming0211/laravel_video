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





    <div class="tpl-content-wrapper">

        <ol class="am-breadcrumb">
            <li><a href="#">登录Log</a></li>
            <li class="am-active">列表</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 列表
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">
                </div>


            </div>
            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <button onclick="del_select()" type="button" class="am-btn am-btn-default"><span class="am-icon-warning"></span> 删除</button>
                                <button onclick="clear_log()" type="button" class="am-btn am-btn-default"><span class="am-icon-danger"></span> 清理log</button>
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
                                    <th class="table-type">openid</th>
                                    <th class="table-type">userid</th>
                                    <th class="table-type">username</th>
                                    <th class="table-date am-hide-sm-only">时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($login_log as $key => $val)
                                <tr>
                                    <td><input type="checkbox"  name="item[]" value="{{$val->id}}"></td>
                                    <td>{{$val->id}}</td>
                                    <td>@if(empty($val->openid))空@endif @if(!empty($val->openid)){{$val->openid}}@endif</td>
                                    <td>{{$val->userid}}</td>
                                    <td class="am-hide-sm-only">{{$val->username}}</td>
                                    <td class="am-hide-sm-only">{{$val->created_at}}</td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <div class="am-cf">

                                <div class="am-fr">
                                    {!!$login_log->links('vendor.pagination.admin_pa')!!}
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
<script>
    function abandon_all() {
        $("input[name='item[]']").removeAttr("checked");
    }

    function del_select() {
        var id_array=new Array();
        $('input[name="item[]"]:checked').each(function(){
            id_array.push($(this).val());//向数组中添加元素
        });
        console.log(id_array);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/log/del',
            data: {
                id_array: id_array,
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    window.location.reload();
                }
            }
        });
    }
    function choose_all() {
        $("input[name='item[]']").prop("checked","true");
    }
    function clear_log() {
        var choice = confirm("请在夜间清理登录log");
        if (!choice) {
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/log/clear',
            data: {

            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    window.location.reload();
                }
            }
        });
    }

</script>
</html>