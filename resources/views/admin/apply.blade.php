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
            <li><a href="#">认证申请</a></li>
            <li class="am-active">申请列表</li>
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

                </div>
                <div class="am-u-sm-12">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                        <thead>
                        <tr>
                            <th >ID</th>
                            <th >userid</th>
                            <th >姓名</th>
                            <th >身份证</th>
                            <th >医生证号</th>
                            <th >申请时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($apply_list as $key => $val)
                        <tr class="gradeX">
                            <td class="am-text-middle">{{$val->id}}</td>
                            <td class="am-text-middle">{{$val->userid}}</td>
                            <td class="am-text-middle">{{$val->name}}</td>
                            <td class="am-text-middle">{{$val->idcard}}</td>
                            <td class="am-text-middle">{{$val->doc_card_id}}</td>
                            <td class="am-text-middle">{{$val->created_at}}</td>
                            <td class="am-text-middle">
                                <div class="tpl-table-black-operation">
                                    @if($val->status=='READY')
                                    <button class="am-btn am-btn-default am-btn-success" onclick="user_action('{{$val->userid}}' , 'ACCESS')">通过</button>
                                    <button class="am-btn am-btn-default am-btn-secondary" onclick="user_action('{{$val->userid}}' , 'REJECT')">驳回</button>
                                    @elseif($val->status=='ACCESS')
                                        <button class="am-btn am-btn-default am-btn-success">已通过</button>
                                    @elseif($val->status=='REJECT')
                                        <button class="am-btn am-btn-default am-btn-secondary">已驳回</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
    </div>

</div>


@include('admin_inc.script')
</body>
<script>
    function user_action(userid, type) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/auth/action',
            data: {
                userid: userid,
                type: type,
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