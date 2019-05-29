<script language="JavaScript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/js/amazeui.min.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/js/app.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/js/ui-choose.js')}}"></script>
<script>
    $(document).ready(function () {
        var url = window.location.pathname;
        var addrLast = url.substring(7,9);
        if(addrLast == "vi"|| addrLast == "sh"){
            $("#video").toggle();
        }
        if(addrLast == "li"){
            $("#live").toggle();
        }
        if(addrLast == "se"){
            $("#sens").toggle();
        }
        if(addrLast == "au"){
            $("#user").toggle();
        }
        if(addrLast == "ma"){
            $("#mail").toggle();
        }
        if(addrLast == "lo"){
            $("#log").toggle();
        }
        if(addrLast == "ad" || addrLast == "va"){
            $("#ad").toggle();
        }
    });

    var current_url = window.location.href;
    function select_all() {
        if($('#all').is(':checked')) {
            $("[type='checkbox']").prop("checked",'true');//全选
        }else{
            $("[type='checkbox']").removeAttr("checked");//取消全选
        }
    }
    function del_select(url) {
        var id_array=new Array();
        $('input[name="item[]"]:checked').each(function(){
            id_array.push($(this).val());//向数组中添加元素
        });
        var choice = confirm("确定删除选中?");
        if (!choice) {
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: url,
            data: {
                id_array: id_array,
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    window.location.reload();
                }
            }
        });
    }
    function delete_id(url,id) {
        var choice = confirm("确定删除当前?");
        if (!choice) {
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'delete',
            url: url,
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(data) {
                if (data.success){
                    location.reload(true);
                }
            }
        });
    }

</script>