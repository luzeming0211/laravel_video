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
                </div>
                <a href="javascript:history.go(-1);">[ 2秒后自动返回上一页，如果没有返回，请点这里 ]</a>
            </div>
        </div>
    </body>
<script>
    @if(empty($url))
    $(document).ready(function(){
        if(window.history.length > 1){
            setTimeout(function () {
                history.go(-1);
            }, 2000);
        }
    });
    // setTimeout(function () {
    //     if(window.history.length > 1){
    //         history.go(-1);
    //     }
    // }, 2000);
    @else
    var domain = window.location.hostname
    var url = 'http://'+domain+"{{$url}}";
    setTimeout(function () {
        window.location.href = url
    }, 2000);
    @endif
</script>
</html>
