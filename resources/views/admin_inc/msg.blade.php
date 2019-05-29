<!-- 成功提示框 -->
@if (Session::exists('success'))
{{--<div class="alert alert-success alert-dismissible" role="alert">--}}
    {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--<strong>成功!</strong> {{ Session::get('success') }}--}}
{{--</div>--}}
<div class="am-alert am-alert-success" data-am-alert>
    <button type="button" class="am-close">&times;</button>
    <p>{{ Session::get('success') }}</p>
</div>
@endif

<!-- 失败提示框 -->
@if (Session::exists('error'))
{{--<div class="alert alert-danger alert-dismissible" role="alert">--}}
    {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--<span aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    {{--<strong>失败!</strong> {{ Session::get('error') }}--}}
{{--</div>--}}
<div class="am-alert am-alert-danger" data-am-alert>
    <button type="button" class="am-close">&times;</button>
    <p>{{ Session::get('error') }}</p>
</div>
@endif
