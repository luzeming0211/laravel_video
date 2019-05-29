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
</head>

<body data-type="generalComponents">

@include('admin_inc.header')








<div class="tpl-page-container tpl-page-header-fixed">

    @include('admin_inc.leftbar')





    <div class="tpl-content-wrapper">

        <ol class="am-breadcrumb">
            <li><a href="#">评论管理</a></li>
            <li class="am-active">评论列表</li>
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
                                <button onclick="del_select()" type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
                            </div>
                        </div>
                    </div>
                    <div class="tpl-portlet-input tpl-fz-ml">
                        <div class="portlet-input input-small input-inline">
                            <div class="input-icon right">
                                <i class="am-icon-search"></i>
                                <input type="text" id="video_id" name="video_id" class="form-control form-control-solid" placeholder="视频id" value="@if(!empty($video_id)){{$video_id}}@endif"> </div>
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
                                    <th class="table-title">评论</th>
                                    <th class="table-type">视频id</th>
                                    <th class="table-author am-hide-sm-only">评论人</th>
                                    <th class="table-date am-hide-sm-only">评论时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comment as $key => $val)
                                <tr>
                                    <td><input type="checkbox"  name="item[]" value="{{$val->id}}"></td>
                                    <td>{{$val->id}}</td>
                                    <td>{{$val->comment}}</td>
                                    <td>{{$val->video_id}}</td>
                                    <td class="am-hide-sm-only">{{$val->username}}</td>
                                    <td class="am-hide-sm-only">{{$val->created_at}}</td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <div class="am-cf">

                                <div class="am-fr">
                                    {!!$comment->links('vendor.pagination.admin_pa')!!}
                                </div>
                            </div>
                            <hr>

                        </form>



                    </div>

                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>

        <div class="am-popup" id="my-popup" style="height: 500px;"  >
            <div class="am-popup-inner" style="padding-top:100px;" >
                <div class="am-popup-hd">
                    <h4 class="am-popup-title" id="des"></h4>
                    <span data-am-modal-close
                          class="am-close">&times;</span>
                </div>
                <div class="am-popup-bd">
                    <img id="thumb_address" src="" width="100%" height="300px"/>
                </div>
            </div>
        </div>






    </div>

</div>

<form method="post" action="/admin/video/comment/search" id="form">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
    <input type="hidden" id="form_id" name="form_id" value="">
</form>
@include('admin_inc.script')
<script>
    $(document).keyup(function(event){
        if(event.keyCode ==13){
            video_id = $("#video_id").val();
            if(video_id == ""){
                return false;
            }else{
                if(!isNumber(video_id)){
                    alert('请输入视频id');
                    return false;
                }
            }
            $("#form_id").val(video_id);
            $("#form").submit();
        }
    });
    function isNumber(value) {         //验证是否为数字
        var patrn = /^(-)?\d+(\.\d+)?$/;
        if (patrn.exec(value) == null || value == "") {
            return false
        } else {
            return true
        }
    }
</script>
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
            url: '/admin/video/comment/destroy',
            data: {
                id_array: id_array,
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    window.location.reload();
                }
            }
        });
    }
    function choose_all() {
        $("input[name='item[]']").prop("checked","true");
    }
    function big_thumb(des,thumb_address, obj) {
        $("#thumb_address").attr("src",thumb_address);
        $("#des").html(des);
    }
</script>
</html>