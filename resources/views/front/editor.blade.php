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

    @include('admin_inc.script')
<!-- 配置文件 -->
    <script src="{{asset('assets/ueditor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script src="{{asset('assets/ueditor/ueditor.all.js')}}"></script>
    <!-- 语言包文件(建议手动加载语言包，避免在ie下，因为加载语言失败导致编辑器加载失败) -->
    <script src="{{asset('assets/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <!--135编辑器-->
</head>

<body data-type="generalComponents">









<div class="tpl-page-container tpl-page-header-fixed">

    {{--@include('admin_inc.leftbar')--}}

<form method="post" action="editor_do">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
    <script id="content" name="content" type="text/plain"></script>
    <script type="text/javascript">
        var editor = UE.getEditor('content', {
            initialFrameHeight: 200,
            autoHeightEnabled: true,
            zIndex: 1300,
            toolbars: [
                [
                    'anchor', //锚点
                    'undo', //撤销
                    'redo', //重做
                    'bold', //加粗
                    'indent', //首行缩进
                    'snapscreen', //截图
                    'italic', //斜体
                    'underline', //下划线
                    'strikethrough', //删除线
                    'subscript', //下标
                    'fontborder', //字符边框
                    'superscript', //上标
                    'formatmatch', //格式刷
                    'source', //源代码
                    'blockquote', //引用
                    'pasteplain', //纯文本粘贴模式
                    'selectall', //全选
                    'print', //打印
                    'preview', //预览
                    'horizontal', //分隔线
                    'removeformat', //清除格式
                    'time', //时间
                    'date', //日期
                    'unlink', //取消链接
                    'simpleupload', //单图上传
                    'insertvideo', //视频
                ]
            ],
        });
    </script>



    <div class="am-form-group">
        <div class="am-u-sm-12 am-u-sm-push-12">
            <input type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success"
                   value="提交" />
        </div>
    </div>

    </form>





</div>

<script>
    var content = UE.getEditor('content').getContent();
    function check_1() {
        alert(content);
    }
</script>
</body>
</html>