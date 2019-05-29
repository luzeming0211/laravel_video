function checkna(){
    var na = form1.name.value;
    if( na.length <1 || na.length >6){
        divname.innerHTML='<font class="tips_false">长度是1~6个字符</font>';
    }else{
        divname.innerHTML='<font class="tips_true">格式正确</font>';
    }
}
function check_doc_card_id(){
    var doc_card_id = form1.doc_card_id.value;
    if( doc_card_id.length != 15){
        div_doc_card_id.innerHTML='<font class="tips_false">必须是15位的数字</font>';
    }else{
        div_doc_card_id.innerHTML='<font class="tips_true">格式正确</font>';
    }
}
function check_idcard(){
    var idcard = form1.idcard.value;
    if( idcard.length != 18){
        div_idcard.innerHTML='<font class="tips_false">必须是18位</font>';
    }else{
        div_idcard.innerHTML='<font class="tips_true">格式正确</font>';
    }
}
function check_info(){
    doc_card_id = $("#doc_card_id").val();
    idcard = $("#idcard").val();
    if( doc_card_id == "" || idcard == ""){
        alert("不能为空啊");
        return false;
    }
    if( idcard.length != 18){
        div_idcard.innerHTML='<font class="tips_false">必须是18位</font>';
        return false;
    }
    if( doc_card_id.length != 15){
        div_doc_card_id.innerHTML='<font class="tips_false">必须是15位的数字</font>';
        return false;
    }
    form1.submit();
}