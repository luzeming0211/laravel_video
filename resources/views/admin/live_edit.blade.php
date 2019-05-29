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
    <link rel="stylesheet"  href="{{asset('assets/css/amazeui.datetimepicker.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/admin.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/app.css')}}" />
</head>

<body data-type="generalComponents">

@include('admin_inc.header')


<div class="tpl-page-container tpl-page-header-fixed">
    @include('admin_inc.leftbar')




    <div class="tpl-content-wrapper">

        <ol class="am-breadcrumb">
            <li><a href="#">直播</a></li>
            <li class="am-active">直播编辑</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 直播编辑
                </div>


            </div>

            <div class="tpl-block">

                <div class="am-g">
                    <div class="tpl-form-body tpl-form-line">
                        <form class="am-form tpl-form-line-form" method="post" action="/admin/live/edit-do">
                            <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" id="id" name="id" value="{{$live->id}}">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">简介 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="des" placeholder="请输入视频简介" name="des" value="{{$live->des}}">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">开始时间 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input size="16" type="text" name="start_time" value="{{$live->start_time}}" readonly class="form-datetime-lang am-form-field">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">结束时间 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input size="16" type="text" name="end_time" value="{{$live->end_time}}" readonly class="form-datetime-lang am-form-field">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">点击量 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="number" name="pv" id="pv" value="{{$live->pv}}">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">封面 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <div class="am-form-group am-form-file">
                                        <input  id="upload_file" name="upload_file"  type="file" onchange="uploadThumb()"/>
                                        <input type="hidden" class="form-control" id="photo_edit" name="photo_edit"value="{{$live->thu}}" >
                                        <img style="width:360px;height:200px;" alt="" id="thumb" src="{{$live->thu}}"/>
                                    </div>

                                </div>
                            </div>



                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">用户ID <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 1}" name="userid">
                                        @foreach($user_doc as $key=>$val)
                                            <option value="{{$val->doc_id}}" {{$val->doc_id == $live->userid?'selected':''}} {{$val->catname}}>{{$val->doc_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">APPNAME <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="appname"  name="appname" placeholder="不需要修改就别填写">
                                    <div>

                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">StreamName <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="streamname"  name="streamname" placeholder="不需要修改就别填写">
                                    <button type="button" class="am-btn am-btn-success" onclick="getplay_url()">生成推流地址</button>
                                    <div>

                                    </div>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">播放地址 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="play_url"  name="play_url" value="{{$live->play_url}}">
                                    <div>

                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">推流地址 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="push_url"  name="push_url" value="{{$live->push_url}}">
                                    <div>

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









    </div>

</div>


@include('admin_inc.script')
<script language="JavaScript" src="{{asset('assets/js/amazeui.datetimepicker.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/js/ajaxfileupload.js')}}"></script>
<script>
    function getplay_url() {
        var appName  = $("#appname").val();
        var streamName = $("#streamname").val();
        if(appName == ""){
            alert("appName不能为空");
            return false;
        }
        if(streamName == ""){
            alert("streamName不能为空");
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/live/url',
            data: {
                appName: appName,
                streamName: streamName,
            },
            dataType: 'json',
            success: function(data) {
                $("#play_url").val(data.play_url);
                $("#push_url").val(data.push_url);
            }
        });
    }
    function uploadThumb() {
        $.ajaxFileUpload({
            url: "/admin/video/upload-thumb",
            secureuri: false,
            fileElementId: "upload_file",
            dataType: "json",
            data:{'_token':$("#_token").val()

            },
            success: function(data, status) {
                console.log(data);
                if(data.success){
                    $("#photo_edit").val(data.photo);
                    $("#thumb").attr("src", data.photo);
                    alert("保存缩略图完成");
                }else{
                    alert(data.msg);}
            }
        })
    }
    (function($){
        // 也可以在页面中引入 amazeui.datetimepicker.zh-CN.js
        $.fn.datetimepicker.dates['zh-CN'] = {
            days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
            daysShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六", "周日"],
            daysMin:  ["日", "一", "二", "三", "四", "五", "六", "日"],
            months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
            monthsShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
            today: "今日",
            suffix: [],
            meridiem: ["上午", "下午"]
        };

        $('.form-datetime-lang').datetimepicker({
            language:  'zh-CN',
            format: 'yyyy-mm-dd hh:ii'
        });
    }(jQuery));
</script>

</body>

</html>