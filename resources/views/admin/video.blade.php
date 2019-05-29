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
            <li><a href="#">视频管理</a></li>
            <li class="am-active">视频列表</li>
        </ol>
        <div class="tpl-portlet-components" @if(isset($catid)) style="height: 1700px" @endif  >
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
                                <button type="button" class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span><a href="/admin/video/create">新增</a> </button>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12 am-u-md-3">
                        <div class="am-form-group">
                            <select data-am-selected="{btnSize: 'sm'}" id="cat">
                                <option value="all" >全部</option>
                                @foreach($category as $k=>$v)
                                    <option value="{{$v->id}}" @if(isset($catid) && $catid == $v->id) selected = "selected" @endif>{{$v->catname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="am-g">
                    <div class="tpl-table-images">
                        @if($video->isEmpty())
                            <h5 >找不到视频</h5>
                        @endif
                        @foreach($video as $key=>$val)
                        <div class="am-u-sm-12 am-u-md-6 am-u-lg-4" id="{{$val->id}}">
                            <div class="tpl-table-images-content">
                                <div class="tpl-table-images-content-i-time">发布时间：{{$val->created_at}}</div>
                                <div class="tpl-i-title">
                                   类别： {{$val->catname}}
                                </div>
                                <a href="/video/{{$val->id}}" target="_blank" class="tpl-table-images-content-i">
                                    <div class="tpl-table-images-content-i-info">
                                            <span class="ico">
                                    {{--<img  src="{{asset('assets/img/user02.png')}}" alt="">--}}
                                                {{$val->userid}}
                                                <br>
                                                {{$val->id}}
                                 </span>

                                    </div>
                                    <span class="tpl-table-images-content-i-shadow"></span>
                                    <img  src="{{$val->thumb}}" alt="" style="height: 200px">
                                </a>
                                <div class="tpl-table-images-content-block">
                                    <div class="tpl-i-font">
                                        {{$val->description}}                                    </div>
                                    <div class="tpl-i-more">
                                        <ul>
                                            <li><span class="am-icon-hand-pointer-o font-green">  {{$val->pv}}</span></li>
                                            {{--<li><span class="am-icon-qq am-text-warning"> 100+</span></li>--}}
                                            {{--<li><span class="am-icon-weixin am-text-success"> 235+</span></li>--}}
                                        </ul>
                                    </div>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs tpl-edit-content-btn">
                                            <button type="button" class="am-btn am-btn-default am-btn-success" data-am-modal="{target: '#my-popup'}" onclick="big_thumb('{{$val->description}}','{{$val->thumb}}',this)" ><span class="am-icon-plus"></span> 大图</button>
                                            <button type="button" class="am-btn am-btn-default am-btn-secondary"><span class="am-icon-edit"></span> <a href="/admin/video/{{$val->id}}">编辑</a> </button>
                                            <button type="button" class="am-btn am-btn-default am-btn-warning"><span class="am-icon-archive"></span> {{$val->status =='READY'?'待审核':'已完成'}}</button>
                                            <button type="button" class="am-btn am-btn-default am-btn-danger" onclick="delete_id('/admin/video/{{$val->id}}',{{$val->id}})"><span class="am-icon-trash-o" ></span> 删除</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="am-u-lg-12">
                            <div class="am-cf">

                                <div class="am-fr">
                                    {!!$video->links('vendor.pagination.admin_pa')!!}
                                </div>
                            </div>
                            <hr>
                        </div>

                    </div>

                </div>
            </div>
            <div class="tpl-alert"></div>
        </div>

    </div>

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

@include('admin_inc.script')
</body>
<script>
    $(" #cat").change(function(){
        catid = $("option:selected",this).val();
        var domain = "{{env('APP_URL')}}";
        window.location.href = domain +'/admin/video/cat/'+catid;
    });
    function big_thumb(des,thumb_address, obj) {
        $("#thumb_address").attr("src",thumb_address);
        $("#des").html(des);
    }
    function delete_this(id, obj) {
        var choice = confirm("确定删除?");
        var div = $("#"+id);
        if (!choice) {
            return false;
        }
        div.remove();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/video/destroy',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    alert(data);
                }
            }
        });
    }
</script>
</html>