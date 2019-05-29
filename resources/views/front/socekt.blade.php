<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>直播观看</title>
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/laydate.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/ckplayer/ckplayer.js')}}" charset="utf-8"></script>

</head>
<body>
<!-- 头部-导航栏 -->
@include('front_inc.header')

<div class="content_live_bg">
    <div class="content_live_box">
        <div class="tit_box clearfix">
            <div class="tit_left"></div>
            <div class="tit_right">
                {{--<input type="button" class="btn btn_icon1"  onclick="open_danmu()"/>--}}
                {{--<input type="button" class="effect"  onclick="open_danmu()" value="Exponential"/>--}}
                {{--<input type="button" class="btn btn_icon2 " data-classid="560" data-type="school" />--}}
                {{--<input type="button" class="btn btn_icon3 " data-classid="560" data-type="school" />--}}
            </div>
        </div>
        <div class="video_live_box">
            <div class="video_live_cont">
                <div class="prism-player" id="player-con" style="height: 500px"></div>
            </div>
            <div class="video_live_right">
                <div class="tab_box">
                    <div class="tab_block">
                        <a class="sele" href="JavaScript:void(0)">评论</a>
                    </div>

                    <div class="clear"></div>
                </div>
                <div class="dialogue_box" id="talk" style="height:370px;">
                    {{--//评论区--}}
                    {{--@foreach($video_comment as $k => $vc)--}}
                    {{--<span style="color:blue">{{$vc->username}}</span><span style="color:blue">：</span>{{$vc->comment}}<br>--}}
                    {{--@endforeach--}}
                </div>

                <div class="send_box">
                    <input class="send_txt" type="text" id='send'/>
                    <input class="send_btn" type="button" value="发送" onclick="send_dammu()"/>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="content_live_box clearfix">


</div>
<div class="cover" style="display: none;"></div>
<script>


    ws = new WebSocket("ws://47.95.12.100:9528");
    var code = Math.random().toString(36).substr(2);
    ws.onopen = function (evt) {
        var data = {
            live_id: '{{$live_id}}',
            userid: '{{$userid}}',
            code: code,
            type: 'connect'
        };
        ws.send(JSON.stringify(data));
    };
    ws.onmessage=function(evt){
        var obj = JSON.parse(evt.data);
        text = obj.message;
        newAnimate();
        console.log(text);
    };
    ws.onclose = function () {
        //    发送房间号相关信息，以识别connect id
        var data = {
            live_id: '{{$live_id}}',
            userid: '{{$userid}}',
            code: code,
            type: 'close'
        };
        ws.send(JSON.stringify(data));
    };
    $('.btn_icon1').click(function(){
        $(".cover").show();
        $(".erweima_box").show();
    });
    function send_dammu() {
        var dammu = $("#send").val();
        if(dammu == ""){
            alert("发送内容不能为空");
            return false;
        }
        var str='<span style="color:blue">{{$username}}</span><span style="color:blue">：</span>'+dammu+'<br>';
        if(dammu != ""){
            text = dammu;
        }
        var data = {
            danmu: text,
            userid: '{{$userid}}',
            live_id: '{{$live_id}}',
            type: 'message'
        };
        $("#talk").append(str);
        $('.dialogue_box').scrollTop( $('.dialogue_box')[0].scrollHeight );
        $('#send').val('');
        ws.send(JSON.stringify(data));
    }
</script>
<!-- 版权 -->
@include('front_inc.footer')

<script>
    var nowI = 5;
    var speed = 5;
    var attribute = 'x';
    var start = 0,
        end = 0;
    var animatePosition = [];
    var alpha = 1;
    var effectName = "Quadratic";
    var  typeName = "easeOut";

    var playerLoad = true;
    var videoObject = {
        container: '#player-con',//“#”代表容器的ID，“.”或“”代表容器的class
        variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
        flashplayer:false,//如果强制使用flashplayer则设置成true
//        video:'rtmp://play.boser1u.top/lt/hj'//视频地址
//  推流地址：rtmp://push.boser1u.top/luze/ming?auth_key=1548065759-0-0-42d808b6a1d348a06b35a759486e41c8
        video:'{{'/uploads/3707942018-12-05-08-30-03.mp4'}}'//视频地址
    };
    var player=new ckplayer(videoObject);

    function loadedHandler() { //播放器加载后会调用该函数
        playerLoad = true;
    }

    function newAnimate() {
        if(!playerLoad) {
            alert('播放器还没有加载，不能添加缓动');
            return;
        }
        alpha = 1;
        nowI += 30;

        switch(attribute) {
            case 'x':
                animatePosition = [2, 0, 0, nowI];
                break;
            case 'y':
                animatePosition = [0, 2, nowI, 0];
                break;
            case 'alpha':
                animatePosition = [0, 0, nowI, nowI];
                alpha = 0;
                break;
        }
        var obj = {
            list: [ //list=定义元素列表
                {
                    type: 'text', //定义元素类型：只有二种类型，image=使用图片，text=文本
                    file: 'pic/logo.png', //图片地址
                    radius: 30, //图片圆角弧度
                    width: 30, //定义图片宽，必需要定义
                    height: 30, //定义图片高，必需要定义
                    alpha: 0.9, //图片透明度(0-1)
                    marginLeft: 10, //图片离左边的距离
                    marginRight: 10, //图片离右边的距离
                    marginTop: 10, //图片离上边的距离
                    marginBottom: 10, //图片离下边的距离
                    clickEvent: "link->http://www.ckplayer.com"
                }, {
                    type: 'text', //说明是文本
                    text: text, //文本内容
                    color: '0xFFDD00', //文本颜色
                    size: 14, //文本字体大小，单位：px
                    font: '"Microsoft YaHei", YaHei, "微软雅黑", SimHei,"\5FAE\8F6F\96C5\9ED1", "黑体",Arial', //文本字体
                    leading: 30, //文字行距
                    alpha: 1, //文本透明度(0-1)
                    paddingLeft: 10, //文本内左边距离
                    paddingRight: 10, //文本内右边距离
                    paddingTop: 0, //文本内上边的距离
                    paddingBottom: 0, //文本内下边的距离
                    marginLeft: 0, //文本离左边的距离
                    marginRight: 10, //文本离右边的距离
                    marginTop: 10, //文本离上边的距离
                    marginBottom: 0, //文本离下边的距离
                    backgroundColor: '0x000000', //文本的背景颜色
                    backAlpha: 0.1, //文本的背景透明度(0-1)
                    backRadius: 30, //文本的背景圆角弧度
                    clickEvent: "actionScript->videoPlay"
                }
            ],
            //x: 10, //元件x轴坐标，注意，如果定义了position就没有必要定义x,y的值了，x,y支持数字和百分比，使用百分比时请使用单引号，比如'50%'
            //y: 50, //元件y轴坐标
            //position:[1,1],//位置[x轴对齐方式（0=左，1=中，2=右），y轴对齐方式（0=上，1=中，2=下），x轴偏移量（不填写或null则自动判断，第一个值为0=紧贴左边，1=中间对齐，2=贴合右边），y轴偏移量（不填写或null则自动判断，0=紧贴上方，1=中间对齐，2=紧贴下方）]
            position: animatePosition,
            alpha: alpha, //元件的透明度
            //backgroundColor: '0xFFDD00', //元件的背景色
            backAlpha: 0.5, //元件的背景透明度(0-1)
            backRadius: 60, //元件的背景圆角弧度
            clickEvent: "actionScript->videoPlay"
        }
        var ele = player.addElement(obj);
        var eleObj = player.getElement(ele);
        switch(attribute) {
            case 'x':
                start = null;
                end = 0 - eleObj['width'];
                break;
            case 'y':
                start = '85%';
                end = 0 - eleObj['height'];
                break;
            case 'alpha':
                start = 0;
                end = 1;
                alpha = 0;
                break;
        }
        if(nowI > 160) {
            nowI = 5;
        }
        var obj = {
            element: ele,
            parameter: attribute,
            static: true, //是否禁止其它属性，true=是，即当x(y)(alpha)变化时，y(x)(x,y)在播放器尺寸变化时不允许变化
            effect: effectName + '.' + typeName,
            start: start,
            end: end,
            speed: speed,
            overStop: true,
            pauseStop: true,
            callBack: 'deleteChild'
        };
        var animate = player.animate(obj);
    }

    function deleteChild(ele) {
        if(player) {
            window.setTimeout(function() {
                player.deleteElement(ele);
            }, 1000);

        }
    }
    function open_danmu() {
        newAnimate();
    }

</script>
</body>
</html>
