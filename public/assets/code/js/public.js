var _html;
var countdown=60;
$(".register-main").css("min-height",$(window).height()-233)
$(function () {
    if($(window).width()<=750){
        htmlsize();
    }
    $(window).resize(function(){
        if($(window).width()<=750){
            htmlsize();
        }
    });
    $(".mask").on('touchmove', function (event) {
        event.preventDefault();
    });
    // $(".get-code").off().on("click",function () {
    //
    // });
    // $(".js-input").focus(function () {
    //     $(this).next(".placeHolder").hide();
    // });
    $(".js-input").on("input",function () {
        if($(this).val().length==0){
            $(this).next(".placeHolder").show();
        }else{
            $(this).next(".placeHolder").hide();
        }
    });
    $(".js-input").blur(function () {
        if($(this).val().length==0){
            $(this).next(".placeHolder").show();
        }else {
            $(this).next(".placeHolder").hide();
        }
    });
    $(".login-rightTab").off().on("click",function () {
        if(!$(this).hasClass("qr-goTab")){
            $(this).addClass("qr-goTab").find(".rightTab-L").html("电脑登录");
            $(".login-type-box").hide();
            $(".qr-login-box").show();
        }else{
            $(this).removeClass("qr-goTab").find(".rightTab-L").html("扫码快捷登录");
            $(".login-type-box").show();
            $(".qr-login-box").hide();
        }
    });
    $(".bottom-tabBtn").off().on("click",function () {
        if(!$(this).hasClass("jsGo-code")){
            $(this).html("账号密码登录");
            $(this).addClass("jsGo-code");
            $(".type-password").hide();
            $(".type-code").show();

        }else{
            $(this).html("手机验证码登录");
            $(this).removeClass("jsGo-code");
            $(".type-password").show();
            $(".type-code").hide();
        }
    });
    $(".wx-icon").off().on("click",function () {
        $(".qr-mask").show();
    });
    $(".mask-close").off().on("click",function () {
        console.log("fvgtg")
        $(this).parents(".mask-box").hide();
    });
    $(".get-tab-li").off().on("click",function () {
        var _index=$(this).index();
        $(this).addClass("get-tab-active").siblings().removeClass("get-tab-active");
        $(".getPassword-main-li").eq(_index).addClass("getPassword-main-active").siblings().removeClass("getPassword-main-active");
    });
    $(".post-select-li").off().on("click",function () {
        if(!$(this).parent().hasClass("post-selectAct")){
            $(this).parent().addClass("post-selectAct")
        }else{
            $(this).parent().removeClass("post-selectAct")
        }
    });
    $(".option-li").off().on("click",function () {
        var _length=$(this).parents(".select-list-box").find(".select-list-li").length;
        var _index=$(this).parent().index();
        var _thisVal=$(this).html();
        console.log(_length)
        $(this).addClass("active-option-li").siblings().removeClass("active-option-li");
        $(this).parents(".post-li").find(".placeHolder").hide();
        if(_length==_index+1){
            $(this).parents(".post-li").find(".select-div").children("span").eq(_index).text(_thisVal)
        }else{
            $(this).parents(".post-li").find(".select-div").children("span").eq(_index).text(_thisVal+",")
        }
    });
    $(".group-li").off().on("click",function () {
        $(this).addClass("group-li-active").siblings().removeClass("group-li-active");
    });
    $(".hospital-lis").off().on("click",function () {
        $(".hospital-lis").removeClass("hospital-lis-active");
        $(this).addClass("hospital-lis-active")
    })
    $(".js-form-maskBtn").off().on("click",function () {
       $(".form-mask").show();
    });
    $(".no-hospital-btn").off().on("click",function () {
        $(".addHospital-mask").show();
    });
    // $(".opt-lable").off().on("click",function () {
    //     var _this = $(this);
    //     if(!$(this).hasClass("checkbox-lable")){
    //         if(!_this.find(".opt").is(':checked')){
    //             _this.find(".opt").attr("checked",true);
    //             _this.siblings().find(".opt").removeAttr("checked");
    //         }
    //     }else{
    //         if(_this.find(".opt").is(':checked')){
    //             _this.find(".opt").attr("checked",true);
    //         }else{
    //             _this.find(".opt").removeAttr("checked");
    //         }
    //     }
    // });
    $('.alert').show()
});

function displayResult(item, val, text) {
    console.log(item);
    $('.alert').show().html('You selected <strong>' + val + '</strong>: <strong>' + text + '</strong>');
}
function sendemail(){
    var obj = $("#get-btn");
    settime(obj);
};
function setTime(obj) { //发送验证码倒计时
    if (countdown == 0) {
        obj.attr('disabled',false);
        obj.html("重新获取").css("background","#43A0FF");
        obj.css("color","#ffffff");
        countdown = 60;
        return;
    } else {
        obj.attr('disabled',true);
        obj.html(countdown + "秒").css("background","#E3E7EE");
        obj.css("color","#666666");
        countdown--;
    }
    setTimeout(function() {
            setTime(obj) }
        ,1000)
}
function imgSize(classname,num) {//计算图片高度，classname为元素类名，num为比率（宽/高）
    var _width=$("."+classname).width();
    $("."+classname).height(_width/num);
};
function SetSS(key,val) {
    var _key=key;
    return window.sessionStorage .setItem(_key,JSON.stringify(val))
};
function GetSS(key){
    var _key=key;
    return JSON.parse(window.sessionStorage .getItem(_key)||'[]');
};
function htmlsize(){
    $("html").css("min-height",$(window).height())
}
/*
function previewImage(file)
{
    /!*var   = "100%";
    va "100%";*!/
    var div = document.getElementById('preview');
    if (file.files && file.files[0])
    {
        div.innerHTML ='<img id=imghead onclick=$("#previewImg").click()>';
        var img = document.getElementById('imghead');
        img.onload = function(){
            var rect = clacImgZoomParam(img.offsetWidth, img.offsetHeight);
            /!* img.width  =  rect.width;
             img.height =  rect.height;*!/
//                 img.style.marginLeft = rect.left+'px';
            img.style.marginTop = rect.top+'px';
        }
        var reader = new FileReader();
        reader.onload = function(evt){img.src = evt.target.result;}
        reader.readAsDataURL(file.files[0]);
    }
    else //兼容IE
    {
        var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text;
        div.innerHTML = '<img id=imghead>';
        var img = document.getElementById('imghead');
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        var rect = clacImgZoomParam(img.offsetWidth, img.offsetHeight);
        status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
        div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
    }
}
function clacImgZoomParam( maxWidth, maxHeight, width, height ){
    var param = {top:0, left:0, width:width, height:height};
    if( width>maxWidth || height>maxHeight ){
        rateWidth = width / maxWidth;
        rateHeight = height / maxHeight;

        if( rateWidth > rateHeight ){
            param.width =  maxWidth;
            param.height = Math.round(height / rateWidth);
        }else{
            param.width = Math.round(width / rateHeight);
            param.height = maxHeight;
        }
    }
    param.left = Math.round((maxWidth - param.width) / 2);
    param.top = Math.round((maxHeight - param.height) / 2);
    return param;
}*/
