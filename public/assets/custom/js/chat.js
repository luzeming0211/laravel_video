/*发送消息*/
function send(str){
	var html="<div class='send'><div class='msg'>"+
	"<p><i class='msg_input'></i>"+str+"</p></div></div>";
	upView(html);
}
// /*接受消息*/
function show(str){
	var html="<div class='show'><div class='msg'>"+
	"<p><i class='msg_input'></i>"+str+"</p></div></div>";
	upView(html);
}
// /*更新视图*/
function upView(html){
	$('.message').append(html);
	$('body').animate({scrollTop:$('.message').outerHeight()-window.innerHeight},200)
}
function sj(){
	return parseInt(Math.random()*10)
}
$(function(){
	$('.footer').on('keyup','input',function(){
		if($(this).val().length>0){
			$(this).next().css('background','#114F8E').prop('disabled',true);
		
		}else{
			$(this).next().css('background','#ddd').prop('disabled',false);
		}
	})
	$('.footer p').click(function(){
		show($("#content").val());
		send("dawd");
		// test();
	})
})

// /*测试数据*/
// var arr=['我是小Q','好久没联系了！','你在想我么','怎么不和我说话','跟我聊会天吧'];
// test()
// function test(){
// 	$(arr).each(function(i){
// 		setTimeout(function(){
// 			send(arr[i])
// 		},sj()*500)
// 	})
// }
