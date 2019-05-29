// ws = new WebSocket("ws://47.95.12.100:9589");
ws.onopen = function (evt) {
    var data = {
        live_id: live_id,
        userid: userid,
        username: username,
        type: 'connect',
        user_agent: user_agent
    };
    ws.send(JSON.stringify(data));
    is_discon();
};
ws.onmessage=function(evt){
    var obj = JSON.parse(evt.data);
    if(obj.type == "dis_con"){
        text = obj.message;
        send_username = obj.username;
        var str='<span style="color:blue">'+send_username+'</span><span style="color:blue">：</span>'+text+'<br>';
        $("#talk").append(str);
        $('.dialogue_box').scrollTop( $('.dialogue_box')[0].scrollHeight );
        alert(text);
        window.history.back(-1);
    }
    if(obj.type == "open"){
        text = obj.message;
        send_username = obj.username;
        var str='<span style="color:blue">'+send_username+'</span><span style="color:blue">：</span>'+text+'<br>';
        $(".dialogue_box").append(str);
        $('.dialogue_box').scrollTop( $('.dialogue_box')[0].scrollHeight );
    }
    if(obj.type != "is_conn" && obj.type != "open"){
        text = obj.message;
        send_username = obj.username;
        if(is_mobile != 1){
            open_danmu();
        }
        var str='<span style="color:blue">'+send_username+'('+userid+')</span><span style="color:blue">：</span>'+text+'<br>';
        $(".dialogue_box").append(str);
        $('.dialogue_box').scrollTop( $('.dialogue_box')[0].scrollHeight );
    }
    // console.log(obj);
};
ws.onclose = function () {
    //    发送房间号相关信息，以识别connect id
    var data = {
        live_id: live_id,
        userid: userid,
        username: username,
        type: 'close',
        user_agent: user_agent
    };
    ws.send(JSON.stringify(data));
};
ws.onerror = function () {
    console.log("出现错误");
};
$('.btn_icon1').click(function(){
    $(".cover").show();
    $(".erweima_box").show();
});
function is_discon() {
    interval = window.setInterval("heart()",2000);//两秒加载
}
function heart() {
    var data = {
        live_id: live_id,
        userid: userid,
        username: username,
        user_agent: user_agent,
        type: 'heart'
    };
    ws.send(JSON.stringify(data));
}
function send_dammu() {
    // if($('#send').prop("disabled") == true){
    //     alert("请不要发送太频繁"); return false;
    // }
    var dammu = $("#send").val();
    if(dammu == ""){
        return false;
    }
    if(dammu != ""){
        text = dammu;
    }
    var data = {
        danmu: text,
        userid: userid,
        username:username,
        live_id: live_id,
        type: 'message',
        user_agent: user_agent
    };
    $('#send').val('');
    ws.send(JSON.stringify(data));
    // send_close();
}
function send_close() {
    var btn = $('#send_btn');
    btn.attr('disabled', true);
    setTimeout(function(){
        btn.removeAttr('disabled');
    }, 10);
}