{{-- error提示框 --}}
@if (count($errors) > 0)
<div class="am-alert am-alert-danger" data-am-alert>
    <button type="button" class="am-close">&times;</button>
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif
