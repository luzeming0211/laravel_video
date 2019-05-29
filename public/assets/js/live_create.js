function myTrim(x) {
    return x.replace(/^\s+|\s+$/gm,'');
}
function checkPost(){
    //校验姓名
    var expert_name = $("input[name='expert_name']").val();
    if(myTrim(expert_name) == ""){
        alert('请填写您的姓名');
        return false;
    }
    //校验医院
    var company4 = $("#company4 option:selected").val();
    var company_other = $("input[name='company_other']").val();
    if(company4==0 && myTrim(company_other)==""){
        alert('请填写您的医院');
        return false;
    }
    //科室
    var profession = $("#profession option:selected").val();
    var profession2 = $("#profession2 option:selected").val();
    var profession3 = $("#profession3 option:selected").val();
    if(myTrim(profession) == "" || myTrim(profession2) == "" || myTrim(profession3) == ""){
        alert('请选择您的科室');
        return false;
    }
    
    //校验职称
    /*var title2  = $("#title2 option:selected").val();
    if(myTrim(title2) == ""){
        alert('请选择您的职称');
        return false;
    }*/
    //校验头像
    var expert_photo  = $("input[name='expert_photo']").val();
    if(myTrim(expert_photo) == 0 || myTrim(expert_photo) == ""){
        alert('请上传您的头像');
        return false;
    }
    //校验讲师介绍
    var selfinfo = $("#selfinfo").val();
    if(myTrim(selfinfo) == ""){
        alert('请填写讲师介绍');
        return false;
    }

    //校验直播标题
    var class_title = $("input[name='class_title']").val();
    if(myTrim(class_title) == ""){
        alert('请填写直播标题');
        return false;
    }
    //校验直播时间
    var open_date = $("input[name='open_date']").val();
    var start_time = $("input[name='start_time']").val();
    var end_time = $("input[name='end_time']").val();
    if(myTrim(open_date)=="" || myTrim(start_time)=="" || myTrim(end_time)==""){
        alert('请填写直播时间');
        return false;
    }
    //校验直播内容介绍
    var summary = $("#summary").val();
    if(myTrim(summary) == ""){
        alert('请填写直播内容介绍');
        return false;
    }
    //校验直播展示图片
    var wap_new_pic_detail  = $("input[name='wap_new_pic_detail']").val();
    if(myTrim(wap_new_pic_detail) == 0 || myTrim(wap_new_pic_detail) == ""){
        alert('请上传直播展示图片');
        return false;
    }

    document.getElementById("myForm").submit()
    return true;
}
(
	function(){
		var img_uploader=function(key){
			var t = this;
			t._key = key;
			
			t._file = $('#'+key+'_file');
			t._hint = $('#'+key+'_hint');
			t._img = $('#'+key+'_img');
			t._pic = $('#'+key);
			t.init();
			return this;
		};
		img_uploader.prototype = {
			_key:null,
			_file:null,
			_hint:null,
			_img:null,
			_pic:null,
			init:function(){
				var t = this;
				t._file.bind('change', function(){
					t.do_uplaod();
				});
			},
			do_uplaod:function (){
				var t=this;
				var key = t._key;
				var file = t._file;
				var hint = t._hint;
				var img = t._img;
				var pic =t._pic;
				hint.html('上传全文中，请耐心等候...');
				img.attr('src', '');
				if(!file.val()){return}
				var s = {
				        url : '/ajaxfileupload_image_do.ajax.php?f_id='+key+'_file',
				        secureuri : false,
				        fileElementId : key+'_file',
				        dataType : 'json',
				        success : function(data, status) {
							t._success(data, status);
                            $('.IMG_UPLOADER').each(function(k, v){
                                $(v).data('ed', new img_uploader($(v).attr('name')));
                            });
				        },
				        error : function(data, status, e) {
				        	t._error(data, status, e);
							
				        }
				     };
				var tmp = $.ajaxFileUpload(s);
				if(!tmp){
		          	hint.html('');
				}
			},
			_success:function(data, status) {
				var t=this;
				var key = t._key;
				var file = t._file;
				var hint = t._hint;
				var img = t._img;
				var pic =t._pic;
				if (data.msg||data.error){
					hint.html(data.msg || data.error);
	            }else{
	            	pic.val(data.id);
					hint.html('');
					img.attr('src', data.org_url);
					img.show();
	            }
			},
	        _error:function(data, status, e) {
	        	var t=this;
				var key = t._key;
				var file = t._file;
				var hint = t._hint;
				var img = t._img;
				var pic =t._pic;
	          	hint.html('请确认上传附件的大小和类型');
	        }
		};
		$(document).ready(function(){
				$('.IMG_UPLOADER').each(function(k, v){
					$(v).data('ed', new img_uploader($(v).attr('name')));
				});
			});
	}
)();