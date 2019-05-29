<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="这是一个 index 页面">
    <meta name="keywords" content="index">
    <title>后台首页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon"  type="image/png" href="{{asset('assets/i/favicon.png')}}" />
    <link rel="apple-touch-icon-precomposed"  href="{{asset('assets/i/app-icon72x72@2x.png')}}" />
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet"  href="{{asset('assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/admin.css')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/app.css')}}" />
    <script language="JavaScript" src="{{asset('assets/js/echarts.min.js')}}"></script>
</head>

<body data-type="index">


@include('admin_inc.header')







    <div class="tpl-page-container tpl-page-header-fixed">


        @include('admin_inc.leftbar')





        <div class="tpl-content-wrapper">




            <div class="row">
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="am-icon-comments-o"></i>
                        </div>
                        <div class="details">
                            <div class="number"> {{$pc_num}} </div>
                            <div class="desc"> 电脑设备 </div>
                        </div>
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
                    </div>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                    <div class="dashboard-stat red">
                        <div class="visual">
                            <i class="am-icon-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number"> {{count($vip_info)}}</div>
                            <div class="desc"> 会员数量 </div>
                        </div>
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
                    </div>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="am-icon-apple"></i>
                        </div>
                        <div class="details">
                            <div class="number">  {{$ios_num}} </div>
                            <div class="desc"> 苹果设备 </div>
                        </div>
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
                    </div>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                    <div class="dashboard-stat purple">
                        <div class="visual">
                            <i class="am-icon-android"></i>
                        </div>
                        <div class="details">
                            <div class="number"> {{$android_num}} </div>
                            <div class="desc"> 安卓设备 </div>
                        </div>
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
                    </div>
                </div>



            </div>

            <div class="row">
                <div class="am-u-md-6 am-u-sm-12 row-mb">
                    <div class="tpl-portlet">
                        <div class="tpl-portlet-title">
                            <div class="tpl-caption font-green ">
                                <i class="am-icon-cloud-download"></i>
                                <span> 播放统计</span>
                            </div>
                            <div class="actions">
                                <ul class="actions-btn">
                                    <li class="red-on">最近七天观看时间统计</li>
                                </ul>
                            </div>
                        </div>

                        <!--此部分数据请在 js文件夹下中的 app.js 中的 “百度图表A” 处修改数据 插件使用的是 百度echarts-->
                        <div class="tpl-echarts" id="tpl-echarts-A">

                        </div>
                    </div>
                </div>
                <div class="am-u-md-6 am-u-sm-12 row-mb">
                    <div class="tpl-portlet">
                        <div class="tpl-portlet-title">
                            <div class="tpl-caption font-red ">
                                <i class="am-icon-bar-chart"></i>
                                <span> VIP用户</span>
                            </div>
                            <div class="actions">
                                <ul class="actions-btn">
                                </ul>
                            </div>
                        </div>
                        <div class="tpl-scrollable">


                            <table class="am-table tpl-table">
                                <thead>
                                    <tr class="tpl-table-uppercase">
                                        <th>会员用户</th>
                                        <th>开始时间</th>
                                        <th>结束时间</th>
                                        <th>积分</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($vip_info as $key=>$val)
                                    <tr>
                                        <td>{{$val->userid}}</td>
                                        <td>{{$val->s_time}}</td>
                                        <td>{{$val->e_time}}</td>
                                        <td class="font-green bold">{{$val->score}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            {{--<div class="row">--}}
                {{--<div class="am-u-md-6 am-u-sm-12 row-mb">--}}

                    {{--<div class="tpl-portlet">--}}
                        {{--<div class="tpl-portlet-title">--}}
                            {{--<div class="tpl-caption font-green ">--}}
                                {{--<span>最新评论</span>--}}
                                {{--<span class="caption-helper"></span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div id="wrapper" class="wrapper">--}}
                            {{--<div id="scroller" class="scroller">--}}
                                {{--<ul class="tpl-task-list">--}}
                                    {{--<li>--}}
                                        {{--<div class="task-checkbox">--}}
                                            {{--<input type="hidden" value="1" name="test">--}}
                                            {{--<input type="checkbox" class="liChild" value="2" name="test"> </div>--}}
                                        {{--<div class="task-title">--}}
                                            {{--<span class="task-title-sp"> 按照示例组织好 HTML 结构（不加 data-am-dropdown 属性），然后通过 JS 来调用。 </span>--}}
                                            {{--<span class="label label-sm label-success">技术部</span>--}}
                                            {{--<span class="task-bell">--}}
                                        {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="am-u-md-6 am-u-sm-12 row-mb">--}}
                    {{--<div class="tpl-portlet">--}}
                        {{--<div class="tpl-portlet-title">--}}
                            {{--<div class="tpl-caption font-green ">--}}
                                {{--<span>审核视频</span>--}}
                            {{--</div>--}}

                        {{--</div>--}}

                        {{--<div class="am-tabs tpl-index-tabs" data-am-tabs>--}}
                            {{--<ul class="am-tabs-nav am-nav am-nav-tabs">--}}
                                {{--<li class="am-active"><a href="#tab1">待审核</a></li>--}}
                                {{--<li><a href="#tab2">已完成</a></li>--}}
                            {{--</ul>--}}

                            {{--<div class="am-tabs-bd">--}}
                                {{--<div class="am-tab-panel am-fade am-in am-active" id="tab1">--}}
                                    {{--<div id="wrapperA" class="wrapper">--}}
                                        {{--<div id="scroller" class="scroller">--}}
                                            {{--<ul class="tpl-task-list tpl-task-remind">--}}
                                                {{--<li>--}}
                                                    {{--<div class="cosB">--}}
                                                        {{--2小时前--}}
                                                    {{--</div>--}}
                                                    {{--<div class="cosA">--}}
                                                        {{--<span class="cosIco label-info">--}}
                        {{--<i class="am-icon-bullhorn"></i>--}}
                      {{--</span>--}}

                                                        {{--<span> 使用 flexbox 实现，只兼容 IE 10+ 及其他现代浏览器。</span>--}}
                                                    {{--</div>--}}

                                                {{--</li>--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="am-tab-panel am-fade" id="tab2">--}}
                                    {{--<div id="wrapperB" class="wrapper">--}}
                                        {{--<div id="scroller" class="scroller">--}}
                                            {{--<ul class="tpl-task-list tpl-task-remind">--}}
                                                {{--<li>--}}
                                                    {{--<div class="cosB">--}}
                                                        {{--12分钟前--}}
                                                    {{--</div>--}}
                                                    {{--<div class="cosA">--}}
                                                        {{--<span class="cosIco">--}}
                        {{--<i class="am-icon-bell-o"></i>--}}
                      {{--</span>--}}

                                                        {{--<span> 注意：Chrome 和 Firefox 下， display: inline-block; 或 display: block; 的元素才会应用旋转动画。<span class="tpl-label-info"> 提取文件--}}
                                                            {{--<i class="am-icon-share"></i>--}}
                                                        {{--</span></span>--}}
                                                    {{--</div>--}}

                                                {{--</li>--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}



        </div>

    </div>
<script language="JavaScript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/js/amazeui.min.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/js/iscroll.js')}}"></script>
<script language="JavaScript" src="{{asset('assets/js/app.js')}}"></script>
<script>
    var pageData = {
        'index': function indexData() {


            var echartsA = echarts.init(document.getElementById('tpl-echarts-A'));
            option = {

                tooltip: {
                    trigger: 'axis',
                },
                legend: {
                    data: ['直播']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [{
                    type: 'category',
                    boundaryGap: true,
                    data: ['前6天', '前5天', '前4天', '前3天', '前2天', '前天', '昨天']
                }],

                yAxis: [{
                    type: 'value'
                }],
                series: [
//                    {
//                    name: '视频',
//                    type: 'line',
//                    stack: '总量',
//                    areaStyle: { normal: {} },
//                    data: [120, 132, 101, 134, 90, 230, 200],
//                    itemStyle: {
//                        normal: {
//                            color: '#59aea2'
//                        },
//                        emphasis: {
//
//                        }
//                    }
//                },
                    {
                        name: '直播',
                        type: 'line',
                        stack: '总量',
                        areaStyle: { normal: {} },
                        data: [
                            '{{$last_time_info['last_seven_time']}}',
                            '{{$last_time_info['last_six_time']}}',
                            '{{$last_time_info['last_five_time']}}',
                            '{{$last_time_info['last_four_time']}}',
                            '{{$last_time_info['last_three_time']}}',
                            '{{$last_time_info['last_two_time']}}',
                            '{{$last_time_info['last_one_time']}}',
                        ],
                        itemStyle: {
                            normal: {
                                color: '#e7505a'
                            }
                        }
                    },

                ]
            };
            echartsA.setOption(option);
        },
    }
</script>
</body>

</html>