function initSelect(obj, info) {
	var selectObj = $("#" + obj).get(0);
    for(var i = 0; i < selectObj.options.length; i++) {
        if(selectObj.options[i].value == info) {
        	selectObj.selectedIndex = i;
			break;
        }
    }
}

//城市
function cityInc(val) {
	var cityval = $("#city").val();
	
	if(cityval == "") {
		$("#city2").hide();
		$("#city3").hide();
	}else{
		var obj = [];
		$("#city2").empty();
		$("#city2").show();
		$("#city3").hide();
		switch($("#area").val()) {
			case "国内":
				for (var i in arrCity) {
					if(cityval == arrCity[i].name) {
						obj = arrCity[i].sub;
						break;
					}
				}
				break;
			case "国外":
				for (var i in arrCity2) {
					if(cityval == arrCity2[i].name) {
						obj = arrCity2[i].sub;
						break;
					}
				}
				break;
			default:
				break;
		}
		cityDisplay('city2', obj, val);
	}
}

function cityInc2(val) {
	var city2val = $("#city2").val();
	if(city2val == "") {
		$("#city3").hide();
	}else{
		var obj2 = [];
		$("#city3").empty();
		$("#city3").show();
		switch($("#area").val()) {
			case "国内":
				theall :
				for (var i in arrCity) {
					var obj = arrCity[i].sub;
					for(var i in obj) {
						if(city2val == obj[i].name) {
							obj2 = obj[i].sub;
							if(typeof obj2 == "undefined") {
								$("#city3").hide();
								$("#city3").empty();
							}
							break theall;
						}
					}
				}
				break;
			case "国外":
				theall :
				for (var i in arrCity2) {
					var obj = arrCity2[i].sub;
					for(var i in obj) {
						if(city2val == obj[i].name) {
							obj2 = obj[i].sub;
							if(typeof obj2 == "undefined") {
								$("#city3").hide();
								$("#city3").empty();
							}
							break theall;
						}
					}
				}
				break;
			default:
				break;
		}
		cityDisplay('city3', obj2, val);
	}
}

function city(info, info2, info3) { 
	$("#city2").hide();
	$("#city3").hide();
	
	var arrTmp = new Array("大洋洲", "非洲", "美洲", "欧洲", "亚洲");
	var aDisplayCity = arrCity;
	
	for(var i in arrTmp) {
		if(arrTmp[i] == info) {
			initSelect("area", "国外");
			aDisplayCity = arrCity2;
			break;
		}
	}

	cityDisplay('city', aDisplayCity, info);
		
	$("#area").change(function() {
		$("#city2").hide();
		$("#city3").hide();
		$("#city").empty();
		
		var aDisplayCity;
		if($(this).val() == "国外") {
			aDisplayCity = arrCity2;
		} else if($(this).val() == "国内") {
			aDisplayCity = arrCity;
		}
		cityDisplay('city', aDisplayCity);
	});
	
	$("#city").change(function() {
		cityInc();
	})
	if($("#city").val() != "") {
		cityInc(info2);
	}

	$("#city2").change(function() {
		cityInc2();
	})
	if($("#city2").val() != null) {
		cityInc2(info3);
	}
}

function cityDisplay(pId, data, val){
	$("#"+pId).append("<option value=\"\">请选择</option>");
	for (var i in data) {
		var cityName = data[i].name;
		$("#"+pId).append("<option value=\"" + cityName + "\" "+((cityName==val)?"selected":"")+">" + cityName + "</option>");
	}
}

//专业背景
function professionInc(val, firstname) {
	$("#profession2").show();
	$("#profession3").hide();
	$("#profession2").empty();
	var n = firstname == undefined ? '请选择' : firstname;
	$("#profession2").append("<option value=\"\">"+n+"</option>");
	
	for (var i in arrProf) {
		if($("#profession").val() == arrProf[i].code) {
			var obj = arrProf[i].sub;
			for(var i in obj) {
				var prof2Name = obj[i].name;
				var prof2Code = obj[i].code;
				$("#profession2").append("<option value=\"" + prof2Code + "\" "+((val==prof2Code)?"selected":"")+">" + prof2Name + "</option>");
			}
		} else if($("#profession").val() == "") {
			$("#profession2").hide();
			$("#profession3").hide();
		}
	}
}

function professionInc2(val, firstname) {
	$("#profession3").show();
	$("#profession3").empty();
	var n = firstname == undefined ? '请选择' : firstname;
	$("#profession3").append("<option value=\"\">"+n+"</option>");

	for (var i in arrProf) {
		var obj = arrProf[i].sub;
		for(var i in obj) {
			var obj2 = obj[i].sub;
			if($("#profession2").val() == obj[i].code) {
				if(typeof obj2 != "undefined") {
					for(var i in obj2) {
						var prof3Name = obj2[i].name;
						var prof3Code = obj2[i].code;
						$("#profession3").append("<option value=\"" + prof3Code + "\" "+((val==prof3Code)?"selected":"")+">" + prof3Name + "</option>");
					}
				} else {//隐藏、去除默认项
					$("#profession3").hide();
					$("#profession3").empty();
				}
			} else if($("#profession2").val() == "") {
				$("#profession3").hide();
			}
		}
	}
}

function profession(info, info2, info3, firstname) {
	initSelect("profession", info);
	$("#profession3").hide();
	$("#profession2").hide();
	$("#profession").change(function() {
		professionInc('', firstname);
	})
	
	if($("#profession").val() != "") {
		professionInc(info2, firstname);
	}
		
	$("#profession2").change(function() {
		professionInc2('', firstname);
	})
	if($("#profession2").val() != null) {
		professionInc2(info3, firstname);
	}
}

//职称
function titleInc(firstname) {
	$("#title2").show();
	$("#title2").empty();
	var n = firstname == undefined ? '请选择' : firstname;
	$("#title2").append("<option value=\"\">"+n+"</option>");
	
	for (var i in arrTitle) {
		if($("#title").val() == arrTitle[i].name) {
			var obj = arrTitle[i].sub;
			for(var i in obj) {
				var title2Name = obj[i].name;
				$("#title2").append("<option value=\"" + title2Name + "\">" + title2Name + "</option>");
			}
		} else if($("#title").val() == "") {
			$("#title2").hide();
		}
	}
}

function title(info, info2, firstname) {
	initSelect("title", info);
	$("#title2").hide();
	$("#title").change(function() {
		titleInc(firstname);
	})
	if($("#title").val() != "") {
		titleInc(firstname);
		initSelect("title2", info2);
	}
}

//动态获取医院各级
function company_change(level){
	var code = $("#company" + level).val();
	var next = level+1;
	var i = next;
	while( i < 5 ){
		$("#company" + i).hide();
		$("#company" + i).html('');
		i++;
	}
	if(code != 0){
		$.post("/webres_action/plugin/user/get_company.ajax.php", {"code" : code}, function(data){
			if(data){
				var bShow = false;
				var html = '<option value="0">请选择</option>';
				for(var elem in data.child){
					bShow = true;
					html += '<option value="' + data.child[elem]['code'] + '">' + data.child[elem]['name'] + '</option>';
				}
				if(bShow){
					$("#company" + next).show();
					$("#company" + next).html(html);
				}
			}
		}, "json");
	}
}