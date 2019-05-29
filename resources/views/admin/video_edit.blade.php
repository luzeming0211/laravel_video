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
            <li class="am-active">视频编辑</li>
        </ol>
        <div class="tpl-portlet-components" >
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 编辑
                </div>
            </div>

            <div class="tpl-block">

                <div class="am-g">
                    <div class="tpl-form-body tpl-form-line">
                        <form class="am-form tpl-form-line-form" method="post" action="/admin/video/{{$video->id}}">
                            <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" id="id" name="id" value="{{$video->id}}">
                            <input type="hidden" name="_method" value="put"/>
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">视频简介 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="description" placeholder="请输入视频简介" name="description" value="{{$video->description}}">
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">视频类别 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 1}" name="catid">
                                        @foreach($category as $key=>$val)
                                            <option value="{{$val->id}}" {{$val->id ==$video->catid?'selected':''}}>{{$val->catname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-phone" class="am-u-sm-3 am-form-label">医生ID <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 1}" name="userid">
                                        @foreach($user_doc as $key=>$val)
                                            <option value="{{$val->doc_id}}" {{$val->doc_id ==$video->userid?'selected':''}} {{$val->catname}}>{{$val->doc_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">点击量 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="number" name="pv" id="pv" value="{{$video->pv}}">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">封面图 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <div class="am-form-group am-form-file">
                                        <input  id="upload_file" name="upload_file"  type="file" onchange="uploadThumb()"/>
                                        <input type="text" class="form-control" id="thumb" name="thumb" value="{{$video->thumb}}"  readonly>
                                        <img style="width:360px;height:200px;" alt="" id="tmp_thumb" src="{{$video->thumb}}"/>
                                    </div>

                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">视频上传 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <div class="am-form-group am-form-file">
                                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 视频上传</button>
                                        <input  id="upload_video" name="upload_video"  type="file" onchange="uploadVideo()"/>
                                        <input type="hidden" class="form-control" id="video" name="video" value="{{$video->video}}">
                                        <input type="text" class="form-control" id="video_edit" name="video_edit" value="{{$video->video}}" readonly>
                                    </div>

                                </div>
                            </div>



                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">是否显示</label>
                                <div class="am-u-sm-9">
                                    <div class="tpl-switch">
                                        <input type="checkbox" class="ios-switch bigswitch tpl-switch-btn"  name="is_show" id="is_show" @if ($video->is_show == 1) checked="checked"@endif/>
                                        <div class="tpl-switch-btn-view">
                                            <div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">是否vip</label>
                                <div class="am-u-sm-9">
                                    <div class="tpl-switch">
                                        <input type="checkbox" class="ios-switch bigswitch tpl-switch-btn"  name="is_admin" id="is_admin" @if ($video->is_admin == 1) checked="checked"@endif/>
                                        <div class="tpl-switch-btn-view">
                                            <div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">审核状态</label>
                                <div class="am-u-sm-9">
                                    <div class="tpl-switch">
                                        <input type="checkbox" class="ios-switch bigswitch tpl-switch-btn"  name="status" id="status" @if ($video->status == 'FINISH') checked="checked"@endif/>
                                        <div class="tpl-switch-btn-view">
                                            <div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3">
                                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>


        <div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-5" id="my-modal-loading">
            <div class="am-modal-dialog">
                <div class="am-modal-hd">正在处理视频请稍后...</div>
                <div class="am-modal-bd">
                    <span class="am-icon-spinner am-icon-spin"></span>
                </div>
            </div>
        </div>


    </div>

</div>

@include('admin_inc.script')
<script language="JavaScript" src="{{asset('assets/js/ajaxfileupload.js')}}"></script>
<script>
    function uploadThumb() {
        //图片格式验证
        var x = document.getElementById("upload_file");
        if (!x || !x.value) return;
        var patn = /\.jpg$|\.jpeg$|\.png$|\.gif$/i;
        if (!patn.test(x.value)) {
            alert("您选择的似乎不是图像文件。");
            x.value = "";
            return;
        }
        $.ajaxFileUpload({
            url: "/admin/video/upload-thumb",
            secureuri: false,
            fileElementId: "upload_file",
            dataType: "json",
            data:{'_token':$("#_token").val()

            },
            success: function(data, status) {
                if(data.success){
                    $("#thumb").val(data.photo);
                    $("#tmp_thumb").attr("src", data.photo);
                    alert("保存缩略图完成");
                }else{
                    alert(data.msg);}
            }
        })
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
        $('#my-modal-loading').modal('open');
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
                    $('#my-modal-loading').modal('close');
                    // alert("保存视频完成");
                }else{
                    alert(data.msg);}
            }
        })
    }
</script>
</body>

</html>