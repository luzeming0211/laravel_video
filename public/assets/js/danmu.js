var nowI = 5;
var effectName = 'None',
    typeName = 'easeIn';
var speed = 8;
var attribute = 'x';
var start = 0,
    end = 0;
var animatePosition = [];
var alpha = 1;
var playerLoad = false;
var player = new ckplayer(videoObject);

function loadedHandler() { //播放器加载后会调用该函数
    playerLoad = true;
    player.addListener('error', errorHandler); //监听元数据
}
function errorHandler() {
    // alert('老师还没有准备好，请稍等哦');
    window.location.reload(true);
}
function newAnimate() {
    if(!playerLoad) {
        // alert('播放器还没有加载，不能添加缓动');
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
            // {
            //     type: 'text', //定义元素类型：只有二种类型，image=使用图片，text=文本
            //     file: 'pic/logo.png', //图片地址
            //     radius: 30, //图片圆角弧度
            //     width: 30, //定义图片宽，必需要定义
            //     height: 30, //定义图片高，必需要定义
            //     alpha: 0.9, //图片透明度(0-1)
            //     marginLeft: 10, //图片离左边的距离
            //     marginRight: 10, //图片离右边的距离
            //     marginTop: 10, //图片离上边的距离
            //     marginBottom: 10, //图片离下边的距离
            //     clickEvent: "link->http://www.ckplayer.com"
            // },
            {
                type: 'text', //说明是文本
                text: text,//文本内容
                color: '#080808', //文本颜色
                size: 18, //文本字体大小，单位：px
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
function open_danmu() {
    newAnimate();
}
function deleteChild(ele) {
    if(player) {
        window.setTimeout(function() {
            player.deleteElement(ele);
        }, 1000);

    }
}