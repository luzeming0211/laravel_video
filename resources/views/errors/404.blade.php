<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">
                    @if(!empty($error))
                        {{$error}}
                    @endif
                    @if(empty($error))
                       找不到页面
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
<script language="JavaScript" src="{{asset('assets/js/jquery-1.8.2.min.js')}}"></script>
{{--<script>--}}
    {{--$(document).ready(function(){--}}
        {{--if(window.history.length > 0){--}}
            {{--setTimeout(function () {--}}
                {{--history.go(-1);--}}
            {{--}, 2000);--}}
        {{--}--}}
    {{--});--}}
{{--</script>--}}