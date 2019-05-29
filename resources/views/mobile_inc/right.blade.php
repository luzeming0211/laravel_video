<div class="menu_box">
    <div class="user_infor">
        <div class="user_pic">
            @if(!empty($username))
                {{$username}}
            @endif
        </div>
        <div class="">
        </div>
    </div>
    <div class="menu_cont">
        <a class="icon2"
           href="/mobile/sign">签到</a>
        <a class="icon3"
           href="/mobile/collect">我的收藏</a>
        <a class="icon4"
           href="/mobile/me">个人信息</a>
        @if(!$weixin_flag)
            @if(!Session()->exists('user'))
                <a class="icon5"
                   href="/mobile/login">登录</a>
            @else
                <a class="icon5"
                   href="{{ url('home/logout') }}">登出</a>
            @endif
        @endif
    </div>
</div>