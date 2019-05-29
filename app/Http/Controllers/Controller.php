<?php

namespace App\Http\Controllers;

use App\Model\Login_log;
use App\Model\Wechat_user;
use App\Services\ComService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController

{
    public static function editor(Request $request){
        $data = $request->all();
        $data = $data['content'];
        return view('front.edo',compact('data'));
    }

    public static function get_user(){
        $user['userid'] = '';
        $user['username'] = '';
        if(Session()->exists('user')){
            $user = Session()->get('user');
        }
        return $user;
    }
}
