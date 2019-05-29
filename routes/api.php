<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('sucess', 'Front\AliPayController@pay_sucess');
//Route::any('wechat', 'WeChat\WeChatController@get_access'); //验签用
Route::any('wechat', 'WeChat\WeChatController@serve');
Route::any('oauth_callback', 'WeChat\WeChatController@oauth_callback');