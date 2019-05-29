


<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>
        视频短剧_搞笑视频 -第1页 -百思不得姐手机官网

    </title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="email=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet"  href="{{asset('assets/short/budejie/css/ui.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/short/budejie/css/index.css')}}" />
</head>
<body data-clipboard-text="">
<div id="header">
    <header class="bar bar-header bar-budejie">
        <button class="button button-icon ">
            <i class="ui-icon-logo"></i>
        </button>
    </header>
</div>



<div class="articles ui-container t-item" id="content">

    <ul class="ui-list ui-list-pure  ">

        @foreach($video as $key => $val)
        <li class="ui-border-b">
            <div class="item-list-c">
                <article>
                    <section class="ui-row-flex">
                        <p>
                            爱你三千遍
                        </p>
                    </section>
                    <section class="j-v-c">
                        <div class="x-video-container j-video">
                            <div class="x-video-p" style="padding-top:100%">
                                <video id="vjs_29441821_html5_api"
                                       data-id="29441821"
                                       class="topic-xx-video x-video j-player"
                                       data-tag="2019-05-02|无|爱你三千遍|29441821|无"
                                       width="100%"
                                       poster="http://wimg.spriteapp.cn/picture/2019/0501/9e11b74e-6bbc-11e9-8b81-1866daeb0df1_wpd.jpg"
                                       webkit-playsinline
                                       playsinline
                                       x-webkit-airplay="true"
                                       webkit-playsinline="true"
                                       controls preload="none">
                                    <source src="'{{env('PLAY_URL').$val->id}}'" type="video/mp4">
                                </video>

                                <div class="loading">
                                    <div style="position: relative; width: 100%; height: 100%;">
                                        <i class="x-icon-loading" style="color: #fff;position: absolute; top: 50%; left: 50%;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
            </div>
        </li>
        @endforeach
        {{--<li class="ui-border-b">--}}
            {{--<div class="item-list-c">--}}
                {{--<article>--}}






                    {{--<section class="ui-row-flex">--}}
                        {{--<p>--}}
                            {{--自制三毛钱的特效--}}
                        {{--</p>--}}
                    {{--</section>--}}
                    {{--<section class="j-v-c">--}}
                        {{--<div class="x-video-container j-video">--}}
                            {{--<div class="x-video-p" style="padding-top:100%">--}}
                                {{--<video id="vjs_29441678_html5_api"--}}
                                       {{--data-id="29441678"--}}
                                       {{--class="topic-xx-video x-video j-player"--}}
                                       {{--data-tag="2019-05-02|无|自制三毛钱的特效|29441678|无"--}}
                                       {{--width="100%"--}}
                                       {{--poster="http://wimg.spriteapp.cn/picture/2019/0501/5cc8f0a51691d_wpd.jpg"--}}
                                       {{--webkit-playsinline--}}
                                       {{--playsinline--}}
                                       {{--x-webkit-airplay="true"--}}
                                       {{--webkit-playsinline="true"--}}
                                       {{--controls preload="none">--}}
                                    {{--<source src="http://mvideo.spriteapp.cn/video/2019/0501/5cc8f0a51691d_wpc.mp4" type="video/mp4">--}}
                                {{--</video>--}}

                                {{--<div class="loading">--}}
                                    {{--<div style="position: relative; width: 100%; height: 100%;">--}}
                                        {{--<i class="x-icon-loading" style="color: #fff;position: absolute; top: 50%; left: 50%;"></i>--}}
                                    {{--</div>--}}
                                {{--</div>--}}


                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</section>--}}




                {{--</article>--}}
            {{--</div>--}}
        {{--</li>--}}










    </ul>


    <footer class="ui-row">
    </footer>
    <div class=" ui-btn-wrap" style="padding:5px 10px;">
        <a class="ui-btn-lg " style="border-radius:5px;color: #fff; background: #e50440;"
           href="">
            下一页 》
        </a>
    </div>




</div>
</body>
</html>
