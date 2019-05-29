<div class="header">
    <div class="header__middle clearfix">
        <div class="header__middle--left">
            <div class="logo"><img src="{{asset('assets/picture/e_logo.png')}}" alt="" /></div>
        </div>
        <div class="header__middle--nav">
            <ul class="header__nav clearfix" >
                <li>
                    <a href="/" >首页</a>
                </li>
                <li>
                    <a href="/video/cat/0" >全部</a>
                </li>
                <li>
                    <a href="/live" >直播</a>
                </li>
                <li>
                    <a  href="/me"  >我的</a>
                </li>
                <li>
                    <a href="" class="e_down department " >分类</a>
                    <ul class="hos_department department_nav">
                        @foreach($category as $key => $val)
                            <li><a class="" href="/video/cat/{{$val->id}}">{{$val->catname}}</a></li>
                        @endforeach
                        @foreach($user_doc as $ke => $va)
                            <li><a class="" href="/video/doc/{{$va->doc_id}}">{{$va->doc_name}}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>

        </div>
        <div class="header__middle--right clearfix">
            <div class="header__search clearfix">
                <input type="text" placeholder="搜索"  value="" id="search" />
                <button class="btn search" onclick="search()"></button>
            </div>
            <div class="header__login">
                @if(Session()->exists('user'))
                <a href="/mail"><img src="{{asset('assets/picture/mail.png')}}" >邮件</a>
                @endif
            </div>
            <div class="header__login">
                @if(!Session()->exists('user'))
                    <a   href="/login"><img  src="{{asset('assets/picture/e_user.png')}}"alt="" />登录</a>
                @else
                <a   href="{{ url('home/logout') }}"  ><img  src="{{asset('assets/picture/e_user.png')}}"alt="" />登出</a>
                @endif
            </div>

        </div>
    </div>
</div>



<form action="/search" method="get" hidden id="search_form">
    <input type="hidden" name="search" id="content" value="">
</form>




<div class="event" id="login_box" style="display: none;">
    <div class="login" style="height: 400px">
        <div class="title1">
            <span class="t_txt">登录</span>
            <span class="del" onClick="deleteLogin()">&times;</span>
        </div>
        <form action="" method="post"  role="form">
            <input type="text" name="email" id="email" value="" placeholder="请输入用户名"/>
            <input type="password" name="password" id="password" value="" placeholder="请输入密码"/>
            <input type="button" onclick="login()" name="" id="" value="登录" class="btn" />
            <a href="#" class="wapper" ></a>
        </form>
    </div>
</div>

<div class="bg_color" id="bg_filter" style="display: none;"></div>

<div class="event" id="reg_box" style="display: none;">
    <div class="reg" style="height: 550px">
        <div class="title1">
            <span class="t_txt">注册</span>
            <span class="del" onClick="deletereg()">&times;</span>
        </div>
        <form action="" method="post"  role="form">
            <input type="text" name="name" id="re_name" value="" placeholder="请输入用户名"/>
            <input type="text" name="email" id="re_email" value="" placeholder="请输入邮箱"/>
            <input type="password" name="password" id="re_password" value="" placeholder="请输入密码"/>
            <input type="password" name="password-confirm" id="re_password-confirm" value="" placeholder="请再次输入密码"/>
            <input type="button" onclick="reg()" name=""  value="注册" class="btn" />
            <a href="#" class="wapper" ></a>
        </form>
    </div>
</div>

<div class="bg_color" id="bg_filter1" style="display: none;"></div>

<script>
    {{--function login() {--}}
         {{--var email = $("#email").val();--}}
         {{--var password =  $("#password").val();--}}
         {{--if(email == "" || password == ""){--}}
             {{--$(".wapper").html("邮箱或密码不能为空");--}}
             {{--return false;--}}
         {{--}--}}
        {{--$.post(--}}
            {{--'/home/login',--}}
            {{--{--}}
                {{--'_token':"{{csrf_token()}}",--}}
                {{--'email':email,--}}
                {{--'password':password--}}
            {{--},--}}
            {{--function (data) {--}}
                {{--if(data.success){--}}
                    {{--window.location.reload();--}}
                {{--}--}}
                {{--if(data.fail){--}}
                    {{--$(".wapper").html(data.msg);--}}
                {{--}--}}
            {{--},--}}
            {{--'json'--}}
        {{--);--}}
    {{--}--}}
    {{--function reg() {--}}
        {{--var name = $("#re_name").val();--}}
        {{--var email = $("#re_email").val();--}}
        {{--var password =  $("#re_password").val();--}}
        {{--var password_confirmation =  $("#re_password-confirm").val();--}}

        {{--$.post(--}}
            {{--'/home/register',--}}
            {{--{--}}
                {{--'_token':"{{csrf_token()}}",--}}
                {{--'name':name,--}}
                {{--'email':email,--}}
                {{--'password':password,--}}
                {{--'password_confirmation':password_confirmation--}}
            {{--},--}}
            {{--function (data) {--}}
                {{--if(data.fail){--}}
                    {{--$(".wapper").html(data.msg);--}}
                    {{--return false;--}}
                {{--}--}}
                {{--if(data.success){--}}
                    {{--$(".wapper").html('注册成功请登录');--}}
                    {{--deletereg();--}}
                    {{--showBox();--}}
                    {{--return false;--}}
                {{--}--}}
            {{--},--}}
            {{--'json'--}}
        {{--);--}}

    {{--}--}}
    {{--function deleteLogin(){--}}
        {{--var del=document.getElementById("login_box");--}}
        {{--var bg_filter=document.getElementById("bg_filter");--}}
        {{--bg_filter.style.display="none";--}}
        {{--del.style.display="none";--}}
    {{--}--}}
    {{--function showBox(){--}}
        {{--var show=document.getElementById("login_box");--}}
        {{--var bg_filter=document.getElementById("bg_filter");--}}
        {{--show.style.display="block";--}}
        {{--bg_filter.style.display="block";--}}

    {{--}--}}

    {{--function showreg(){--}}
        {{--var show=document.getElementById("reg_box");--}}
        {{--var bg_filter=document.getElementById("bg_filter1");--}}
        {{--show.style.display="block";--}}
        {{--bg_filter.style.display="block";--}}

    {{--}--}}
    {{--function deletereg(){--}}
        {{--var del=document.getElementById("reg_box");--}}
        {{--var bg_filter=document.getElementById("bg_filter1");--}}
        {{--bg_filter.style.display="none";--}}
        {{--del.style.display="none";--}}
    {{--}--}}
    function search(){
        var search = $("#search").val();
        $("#content").val(search);
        if(search == null || search == ""){
            swal("请输入要搜索的内容!");
        }else {
            $("#search_form").submit();
        }
    }
    $(function () {
        //科室菜单
        $('.department').hover(function () {
            $('.project_nav').hide();
            $('.department_nav').show();
        },function () {
            $('.department_nav').hover(function () {
                $(this).show();
                $('.department').addClass("active");
            },function () {
                $(this).hide();
                $('.department').removeClass("active");
            });
        })

    });
</script>
