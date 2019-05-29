<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>站内信</title>
    <link rel="stylesheet"  href="{{asset('assets/css/swiper-3.3.1.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/common.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/mail.css')}}" />

    <script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/swiper-3.3.1.jquery.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.lazyload.min.js')}}"></script>
    <script language="JavaScript" src="{{asset('assets/js/jquery.superslide.2.1.1.js')}}"></script>



</head>
<body>
<!-- 头部-导航栏 -->
@include('front_inc.header')
<!--内容-->
<div class="content pad0">
    <div class="container clearfix">
        <div class="container-left">
            <ul>
                <li>
                    <a href="/sign" >签到</a>
                </li>
                <li>
                    <a href="/me" >个人信息</a>
                </li>
                <li>
                    <a href="/collect" >我的收藏</a>
                </li>
                <li>
                    <a href="/mail" class="active">站内信</a>
                </li>
            </ul>
        </div>
            <div class="container-right">
            <div class="title">
                {{--<p>未读邮件数 <span>5</span></p>--}}
            </div>
                <div >
                        <table id="box-table-a" summary="Employee Pay Sheet" style="width: 90%">
                            <thead>
                            <tr>
                                <th scope="col" width="50%" >内容</th>
                                {{--<th scope="col" width="10%">来源</th>--}}
                                <th scope="col" width="10%">状态</th>
                                <th scope="col" width="15%">时间</th>
                                <th scope="col" width="10%">编辑</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mail as $key=>$val)
                            <tr >
                                <td  @if($val->is_read == 'N')style="color: #131313" @endif>{{$val->title}}</td>
                                {{--<td>--}}
                                    {{--@if($val->send_user == '0' )--}}
                                        {{--站方--}}
                                    {{--@else--}}
                                        {{--{{$val->send_user}}--}}
                                    {{--@endif--}}
                                {{--</td>--}}
                                <td>
                                    @if($val->is_read == 'N' )
                                        未读
                                    @else
                                        已读
                                    @endif
                                </td>
                                <td>{{$val->created_at}}</td>
                                <td>
                                    <a href="#" style="color:#7a7a7a;" onclick="del_mail('{{$val->id}}')">删除</a>
                                    @if($val->is_read == 'N')
                                    <a href="#" style="color:#7a7a7a;" onclick="is_read('{{$val->id}}')">标为已读</a>
                                    @else
                                    <a href="#" style="color:#7a7a7a;" onclick="no_read('{{$val->id}}')">标为未读</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>
                    <div class="flip" style="width: 500px;padding-top: 20px">
                        <ul >
                            {!!$mail->links('vendor.pagination.default')!!}
                        </ul>
                    </div>
                </div>
        </div>
    </div>
    <div class="flip" style="min-height: 80px;">
        <ul>
        </ul>
    </div>
</div>
<!-- 版权 -->
@include('front_inc.footer')
<script>
    var userid = "{{$userid}}";
</script>
<script>
function del_mail(id) {
    var data = {
        '_token': "{!! csrf_token() !!}",
        'userid' : userid,
        'id' : id,
    }
    var url = '/mail/del';
    $.post(url, data, function(msg){
        console.log(msg);
        if(msg.success){
            window.location.reload();
        }else{
            alert(msg.error);
        }
    },'json');
}
function is_read(id) {
    var data = {
        '_token': "{!! csrf_token() !!}",
        'userid' : userid,
        'id' : id,
    }
    var url = '/mail/read';
    $.post(url, data, function(msg){
        console.log(msg);
        if(msg.success){
            window.location.reload();
        }else{
            alert(msg.msg);
        }
    },'json');
}
function no_read(id) {
    var data = {
        '_token': "{!! csrf_token() !!}",
        'userid' : userid,
        'id' : id,
    }
    var url = '/mail/no_read';
    $.post(url, data, function(msg){
        console.log(msg);
        if(msg.success){
            window.location.reload();
        }else{
            alert(msg.msg);
        }
    },'json');
}
</script>
</body>
</html>
