<?php

namespace App\Http\Middleware;
use App\Services\ComService;
use Closure;
use Illuminate\Support\Facades\Session;

class WeChat
{

    public function handle($request, Closure $next)
    {
        if(ComService::is_weixin())
        {
            $app = app('wechat.official_account');
            if (!(Session()->exists('wechat_user'))) {
                $response = $app->oauth->scopes(['snsapi_userinfo'])->redirect();
                $target_url =  $_SERVER['REQUEST_URI'];
                Session::put('target_url',$target_url);
                return $response;
            }
        }
        return $next($request);
    }
}
