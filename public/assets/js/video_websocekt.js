ws.onopen = function (evt) {
    var data = {
        video_id: video_id,
        userid: userid,
        username: username,
        user_agent: 'pc',
        // type: 'connect',
    };
    ws.send(JSON.stringify(data));
    is_discon();
};
ws.onmessage=function(evt){
    var obj = JSON.parse(evt.data);
    console.log(obj);
};
ws.onclose = function () {
    var data = {
        video_id: video_id,
        userid: userid,
        username: username,
        type: 'close_video',
        user_agent: user_agent
    };
    ws.send(JSON.stringify(data));
};
ws.onerror = function () {
    console.log("出现错误");
};
function is_discon() {
    interval = window.setInterval("heart()",2000);//两秒加载
}
function heart() {
    var data = {
        video_id: video_id,
        userid: userid,
        username: username,
        user_agent: 'pc',
        type: 'heart'
    };
    ws.send(JSON.stringify(data));
}

