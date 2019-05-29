<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <li class="am-active">直播新增</li>
        </ol>
        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> 直播新增
                </div>


            </div>

            <div class="tpl-block">

                <div class="am-g">
                    <div class="tpl-form-body tpl-form-line">
                        <form class="am-form tpl-form-line-form" method="post" action="/admin/live/store">
                            <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">简介 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="des" placeholder="请输入视频简介" name="des">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">开始时间 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input size="16" type="text" name="start_time" value="{{$now_time}}" readonly class="form-datetime-lang am-form-field">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">结束时间 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input size="16" type="text" name="end_time" value="{{$now_time}}" readonly class="form-datetime-lang am-form-field">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label">点击量 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="number" name="pv" id="pv">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">封面 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <div class="am-form-group am-form-file">
                                        <input  id="upload_file" name="upload_file"  type="file" onchange="uploadThumb()"/>
                                        <input type="hidden" class="form-control" id="photo_add" name="photo_add" >
                                        <img style="width:360px;height:200px;" alt="" id="thumb" src="{{asset('assets/img/a5.png')}}"/>
                                    </div>

                                </div>
                            </div>



                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">用户ID <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <select data-am-selected="{searchBox: 1}" name="userid">
                                        @foreach($user_doc as $key=>$val)
                                            <option value="{{$val->doc_id}}">{{$val->doc_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">APPNAME <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="appname"  name="appname">
                                    <div>

                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">StreamName <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="streamname"  name="streamname">
                                    <button type="button" class="am-btn am-btn-success" onclick="getplay_url()">生成推流地址</button>
                                    <div>

                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">播放地址 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="play_url"  name="play_url">
                                    <div>

                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">推流地址 <span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" id="push_url"  name="push_url">
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
                if(data.success){
                    $("#photo_add").val(data.photo);
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