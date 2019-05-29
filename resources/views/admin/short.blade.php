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
            <li><a href="#">视频管理</a></li>
            <li class="am-active">短视频</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 列表
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">
                    <div class="portlet-input input-small input-inline">

                    </div>
                </div>


            </div>
            <div class="tpl-block">
                <div class="am-g">
                    <div class="am-u-sm-12 am-u-md-6">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span><a href="/admin/short/create">新增</a> </button>
                                <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del_select('/admin/short/del')"><span class="am-icon-trash-o"></span> 删除</button>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-3">
                        <div class="am-form-group">

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
                                    <th class="table-title">描述</th>
                                    <th class="table-title">是否置顶</th>
                                    <th class="table-date am-hide-sm-only">时间</th>
                                    <th class="table-date am-hide-sm-only">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($short as $key => $val)
                                <tr>
                                    <td><input type="checkbox"  name="item[]" value="{{$val->id}}"></td>
                                    <th class="table-title">{{$val->des}}</th>
                                    <th class="table-title">@if($val->is_top == 'Y')是@endif @if($val->is_top == 'N')否@endif</th>
                                    <th class="table-date am-hide-sm-only">{{$val->created_at}}</th>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button" class="am-btn am-btn-default "><span class="am-icon-edit"></span><a href="/admin/short/{{$val->id}}/edit">编辑</a></button>
                                                @if($val->is_top == 'N')
                                                <button type="button" class="am-btn am-btn-default" onclick="top_this('{{$val->id}}','Y')"><span class="am-icon-plus"></span> 置顶</button>
                                                @endif
                                                @if($val->is_top == 'Y')
                                                <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="top_this('{{$val->id}}','N')"><span class="am-icon-plus"></span> 取消</button>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="am-cf">

                                <div class="am-fr">
                                    {!!$short->links('vendor.pagination.admin_pa')!!}
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
<script>
    function top_this(id,act) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/short/top',
            data: {
                id: id,
                act: act,
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    window.location.reload();
                }
            }
        });
    }
    function uploadVideo() {
        var x = document.getElementById("upload_video");
        if (!x || !x.value) return;
        var patn = /\.rvmb$|\.flv$|\.mp4$|\.avi$|\.wmv$/i;
        if (!patn.test(x.value)) {
            alert("您选择的似乎不是视频文件。");
            x.value = "";
            return;
        }
        $.ajaxFileUpload({
            timeout:999999,
            url: "/admin/video/upload-video",
            secureuri: false,
            fileElementId: "upload_video",
            dataType: "json",
            data:{'_token':$("#_token").val()
            },
            success: function(data, status) {
                if(data.success){
                    $("#video_edit").val(data.video);
                    alert("保存视频完成");
                }else{
                    alert(data.msg);}
            }
        })
    }
</script>
</body>
</html>