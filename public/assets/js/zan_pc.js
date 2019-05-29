function collect(obj,type) {
    var vid = $(obj).attr("data-classid");
    if ((userid == null) ||userid == "") {
        window.location.href=login_url;
    }
    var url = '/video/zan-or-collect';
    if(!$('#collect').hasClass("btn_icon3_sele")) {
        var data = {
            'type':type,
            '_token': $("#_token").val(),
            'userid' : userid,
            'resource':'web',
            'vid' : vid,
            'del_flg' : "N",
        }
        $.post(url, data, function(result){
            if(result.msg == 'OK'){
                $("#collect").addClass("btn_icon3_sele");
            }
            if(result.fail){
                alert('未登录');
            }
        },'json');
    }else{
        var data = {
            'type':type,
            '_token': $("#_token").val(),
            'userid' : userid,
            'resource':'web',
            'vid' : vid,
            'del_flg' : "Y",
        }
        $.post(url, data, function(result){
            if(result.msg == 'OK'){
                $("#collect").removeClass("btn_icon3_sele");
            }
            if(result.fail){
                alert('未登录');
            }
        },'json');
    }

}
function like(obj,type) {
    var vid = $(obj).attr("data-classid");
    if ((userid == null) ||userid == "") {
        window.location.href=login_url;
    }
    var url = '/video/zan-or-collect';
    if(!$('#like').hasClass("btn_icon2_sele")) {
        var data = {
            'type':type,
            '_token': $("#_token").val(),
            'userid' : userid,
            'resource':'web',
            'vid' : vid,
            'del_flg' : "N",
        }
        $.post(url, data, function(result){
            if(result.msg == 'OK'){
                $("#like").addClass("btn_icon2_sele");
            }
            if(result.fail){
                alert('未登录');
            }
        },'json');
    }else{
        var data = {
            'type':type,
            '_token': $("#_token").val(),
            'userid' : userid,
            'resource':'web',
            'vid' : vid,
            'del_flg' : "Y",
        }
        $.post(url, data, function(result){
            if(result.msg == 'OK'){
                $("#like").removeClass("btn_icon2_sele");
            }
            if(result.fail){
                alert('未登录');
            }
        },'json');
    }

}
//防重复点击
function reSubmit(button_id) {
    var btn = $('#'+button_id);
    btn.attr('disabled', 'disabled');
    setTimeout(function(){
        btn.removeAttr('disabled');
    }, 5000);
}