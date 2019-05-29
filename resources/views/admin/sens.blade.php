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
            <li><a href="#">敏感词管理</a></li>
            <li class="am-active">文字列表</li>
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
                                <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="del_select('/admin/sens/del')"><span class="am-icon-trash-o"></span> 删除</button>
                                {{--<button class="am-btn am-btn-default" onclick="import_sens()">导入敏感词库</button>--}}
                                <button
                                        type="button"
                                        class="am-btn am-btn-danger"
                                        data-am-modal="{target: '#my-popup'}">
                                    导入敏感词库
                                </button>
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
                                    <th class="table-title">词汇</th>
                                    <th class="table-type">词汇</th>
                                    <th class="table-date am-hide-sm-only">时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sens as $key => $val)
                                <tr>
                                    <td><input type="checkbox"  name="item[]" value="{{$val->id}}"></td>
                                    <td>{{$val->id}}</td>
                                    <td><a href="#">{{$val->deny_word}}</a></td>
                                    <td>{{$val->deny_word_ext}}</td>
                                    <td class="am-hide-sm-only">{{$val->created_at}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="am-cf">
                                <div class="am-fr">
                                    {!!$sens->links('vendor.pagination.admin_pa')!!}
                                </div>
                            </div>
                            <hr>

                        </form>


                        <div class="am-popup" id="my-popup" style="height: 300px;" >
                            <div class="am-popup-inner">
                                <div class="am-popup-hd">
                                    <h4 class="am-popup-title">导入敏感词库</h4>
                                    <span data-am-modal-close
                                          class="am-close">&times;</span>
                                </div>
                                <div class="am-popup-bd">
                                    <div class="am-form-group am-form-file">
                                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 敏感词上传</button>
                                        <input  id="file" name="file"  type="file" onchange="up_file()"/>
                                        <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                                    </div>
                                    <span style="color: red">
                                         *至少两列有表头
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>


    </div>

</div>

@include('admin_inc.script')
<script language="JavaScript" src="{{asset('assets/js/ajaxfileupload.js')}}"></script>
<script>
    function up_file() {
        $.ajaxFileUpload({
            url: "/admin/sens/upload_sens",
            secureuri: false,
            fileElementId: "file",
            dataType: "json",
            data:{
                '_token':$("#_token").val()
            },
            success: function(data, status) {
                console.log(data);
                if(data.success){
                    alert("导入完成");
                    location.reload();
                }
                if(data.fail){
                    alert(data.msg);
                }
            }
        })
    }
</script>
</body>
</html>