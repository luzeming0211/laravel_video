<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>充值界面</title>
    <link rel="stylesheet"  href="{{asset('assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/main.css')}}" />
</head>

<body>
<div class="pay">
    <!--主内容开始编辑-->
    <div class="tr_recharge">
        <div class="tr_rechtext">
            <p class="te_retit"><img src="{{asset('assets/images/coin.png')}}" alt="" />充值中心</p>
            {{--<p>1.招兵币是51招兵买马退出的虚拟货币，你可以使用招兵币购买站内的简历。</p>--}}
            {{--<p>2.招兵币与人民币换算为1：1，即1元=1招兵币，你可以选择支付宝或者是微信的付款方式来进行充值，招兵币每次10个起充。</p>--}}
        </div>
            <div class="tr_rechbox">
                <div class="tr_rechhead">
                    <img src="{{asset('assets/images/ys_head2.jpg')}}" />
                    <p>{{$userid}}：
                        <a>{{$username}}</a>
                    </p>
                    {{--<div class="tr_rechheadcion">--}}
                    {{--<img src="{{asset('assets/images/coin.png')}}" alt="" />--}}
                    {{--<span>当前余额：<span>1000招兵币</span></span>--}}
                    {{--</div>--}}
                </div>
                <div class="tr_rechli am-form-group">
                    <ul class="ui-choose am-form-group" id="uc_01">
                        <li>
                            <label class="am-radio-inline">
                                <input type="radio"  value="" name="docVlGender" required data-validation-message="请选择一项充值额度"> 1个月
                            </label>
                        </li>
                        <li>
                            <label class="am-radio-inline">
                                <input type="radio" name="docVlGender" data-validation-message="请选择一项充值额度"> 2个月
                            </label>
                        </li>

                        <li>
                            <label class="am-radio-inline">
                                <input type="radio" name="docVlGender" data-validation-message="请选择一项充值额度"> 5个月
                            </label>
                        </li>
                        {{--<li>--}}
                            {{--<label class="am-radio-inline">--}}
                                {{--<input type="radio" name="docVlGender" data-validation-message="请选择一项充值额度"> 其他金额--}}
                            {{--</label>--}}
                        {{--</li>--}}
                    </ul>
                </div>
                {{--<div class="tr_rechoth am-form-group">--}}
                    {{--<span>其他金额：</span>--}}
                    {{--<input type="number" min="10" max="10000" value="10.00元" class="othbox" data-validation-message="充值金额范围：10-10000元" />--}}
                {{--</div>--}}
                <br>
                <div class="tr_rechcho am-form-group" style="float: left">
                    <span>充值方式：</span>
                    <label class="am-radio" style="margin-right:30px;">
                        <input type="radio" name="radio1" checked value="" data-am-ucheck data-validation-message="请选择一种充值方式"><img src="{{asset('assets/images/zfbpay.png')}}"/>
                    </label>
                </div>
                <div class="tr_rechnum">
                    <span>应付金额：</span>
                    <p class="rechnum" id="pay">0.00</p>
                    <p class="rechnum" >元</p>
                </div>
            </div>
            <div class="tr_paybox">
                <input type="button" value="确认支付" class="tr_pay am-btn" onclick="sub_form()" />
                <span><a href="">点我联系客服</a></span>
            </div>
    </div>
</div>
<form method="post" action="/pay" id="form">
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
    <input type="hidden" id="userid" name="userid" value="{{$userid}}">
    <input type="hidden" id="username" name="username" value="{{$username}}">
    <input type="hidden" id="pay_money" name="pay_money" value="">
</form>
@include('admin_inc.script')
<script>
    function sub_form() {
        var money = $("#pay").html();
        if (money == "0.00"){
            alert("请选择充值月份");
            return false;
        }
        $("#pay_money").val(money);
        $("#form").submit();
    }
</script>
<script type="text/javascript">
    // 将所有.ui-choose实例化
    $('.ui-choose').ui_choose();
    // uc_01 ul 单选
    var uc_01 = $('#uc_01').data('ui-choose'); // 取回已实例化的对象
    uc_01.click = function(index, item) {
        console.log('click', index, item.text())
    }
    uc_01.change = function(index, item) {
        console.log('change', index, item.text())
    }
    $(function() {
        $('#uc_01 li:eq(3)').click(function() {
            $('.tr_rechoth').show();
            $('.tr_rechoth').find("input").attr('required', 'true')
            $('#pay').text('10.00');
        })
        $('#uc_01 li:eq(0)').click(function() {
            $('.tr_rechoth').hide();
            $('#pay').text('10.00');
            $('.othbox').val('');
        })
        $('#uc_01 li:eq(1)').click(function() {
            $('.tr_rechoth').hide();
            $('#pay').text('20.00');
            $('.othbox').val('');
        })
        $('#uc_01 li:eq(2)').click(function() {
            $('.tr_rechoth').hide();
            $('#pay').text('50.00');
            $('.othbox').val('');
        })
        $(document).ready(function() {
            $('.othbox').on('input propertychange', function() {
                var num = $(this).val();
                $('#pay').html(num + ".00");
            });
        });
    })

    $(function() {
        $('#doc-vld-msg').validator({
            onValid: function(validity) {
                $(validity.field).closest('.am-form-group').find('.am-alert').hide();
            },
            onInValid: function(validity) {
                var $field = $(validity.field);
                var $group = $field.closest('.am-form-group');
                var $alert = $group.find('.am-alert');
                // 使用自定义的提示信息 或 插件内置的提示信息
                var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

                if(!$alert.length) {
                    $alert = $('<div class="am-alert am-alert-danger"></div>').hide().
                    appendTo($group);
                }
                $alert.html(msg).show();
            }
        });
    });
</script>
</body>

</html>