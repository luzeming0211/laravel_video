<?php
Route::get('ff', function () {

});
Route::get('test', function () {
    return view('front.editor');
});
Route::post('editor_do','Controller@editor');  //ba百度编辑器测试
//前台主页面
Route::get('php', function () {
    return view('phpinfo');
});
//后台认证
Route::group(['middleware' => 'web'], function () {
    Route::any('admin/login', 'Ident\Admin\AuthController@login');
    Route::any('admin/logout', 'Ident\Admin\AuthController@logout');
//    Route::any('admin/register', 'Ident\Admin\AuthController@register');
});

Route::group(['middleware' => 'weChat'], function () {
    Route::get('mobile/short', 'Mobile\ShortController@index');
    Route::get('mobile/sign', 'Mobile\PlayController@sign');
    Route::get('mobile/collect', 'Mobile\PlayController@collect');
    Route::get('mobile/me', 'Mobile\PlayController@me');
    Route::get('mobile/live', 'Mobile\LiveController@getLive');
    Route::get('mobile/cat', 'Mobile\PlayController@cat');
    Route::get('mobile/video/{id}', 'Mobile\PlayController@show');
    Route::get('mobile/live/{id}', 'Mobile\LiveController@getLiveId');
    Route::get('mobile/index', 'Mobile\IndexController@index');
    Route::get('mobile/search', 'Mobile\IndexController@search');
    Route::get('mobile/detail/{id}', 'Mobile\IndexController@detail');
    Route::post('mobile/cat', 'Mobile\CatController@getCat');
    Route::post('mobile/cat/more', 'Mobile\CatController@getMore');
    Route::any('mobile/login', 'Mobile\LoginController@login');
    Route::any('mobile/reg', 'Mobile\LoginController@register');
    Route::any('mobile/code', 'Mobile\LoginController@code');
    Route::any('mobile/bind_reg', 'Mobile\LoginController@bind_reg');
    Route::any('mobile/bind', 'Mobile\LoginController@bind');
});
Route::get('ffm', 'Front\IndexController@ffm');
//前台认证
Route::post('login_do', 'Ident\Front\AuthController@login_do');
Route::get('home/logout', 'Ident\Front\AuthController@logout');
Route::post('reg_do', 'Ident\Front\AuthController@reg_do');
Route::post('edit_pwd', 'Ident\Front\AuthController@editPwd');
Route::get('login','Ident\Front\AuthController@login_new');
Route::any('forget','Ident\Front\AuthController@forget');
Route::post('f_code','Ident\Front\AuthController@getForgetCode');
Route::get('reg','Ident\Front\AuthController@reg_new');
Route::any('code','Ident\Front\AuthController@code');
//前台扫码登录请求
Route::post('wechat/login', 'Ident\Front\AuthController@is_login');
Route::get('pay-finish', 'Front\IndexController@pay_finish');
Route::get('custom', 'Front\CustomController@index');
Route::any('pay', 'Front\AliPayController@index');
Route::get('mail', 'Front\IndexController@getMail');
Route::get('collect', 'Front\IndexController@collect');
Route::get('me', 'Front\IndexController@me');
Route::post('me/score', 'Front\IndexController@addScore'); //积分兑换
Route::get('sign', 'Front\IndexController@getSign');
Route::get('search', 'Front\IndexController@getSearch');
Route::get('auth', 'Front\IndexController@getAuth');
Route::post('upload-auth', 'Front\IndexController@postUploadAuth');
Route::post('auth-do', 'Front\IndexController@postAuthDo');
Route::get('/', 'Front\IndexController@index');
Route::post('mail/del', 'Front\IndexController@postMailDel');
Route::post('mail/read', 'Front\IndexController@postMailIsRead');
Route::post('mail/no_read', 'Front\IndexController@postMailNoRead');
//视频播放
Route::any('play/{id}', 'Front\PlayController@intercept');
Route::get('short/{id}', 'Mobile\ShortController@play');
Route::get('video/cat/{id}', 'Front\PlayController@getCat');
Route::get('video/doc/{id}', 'Front\PlayController@getDocVideo');
Route::post('video/add-comment', 'Front\PlayController@postAddComment');
Route::get('video/{id}', 'Front\PlayController@show');
//视频观看
Route::post('video/video_time', 'Front\PlayController@addVideoTime');
//赞、收藏
Route::post('video/zan-or-collect', 'Front\PlayController@postLikeOrCollect');
//直播播放
Route::get('live', 'Front\LiveController@getLive');
Route::get('live/{id}', 'Front\LiveController@getLiveId');
//后台
Route::group(['middleware' => 'admin'], function () {
    //后台首页
    Route::get('admin', 'Admin\AdminController@index');


    Route::get('admin/log/login', 'Admin\LogController@index');
    Route::get('admin/log/pay', 'Admin\LogController@getPayLog');
    Route::post('admin/log/clear', 'Admin\LogController@clear');
    Route::post('admin/log/del', 'Admin\LogController@delLoginLog');

    Route::resource('admin/ad', 'Admin\AdController'); //广告

    Route::get('admin/vad', 'Admin\AdController@getVideoAd'); //视频前置广告
    Route::post('admin/vad/do', 'Admin\AdController@VideoAdDo');

    //视频
    Route::resource('admin/video', 'Admin\VideoController');
    Route::resource('admin/short', 'Admin\ShortController');
    Route::post('admin/short/del', 'Admin\ShortController@del');
    Route::post('admin/short/top', 'Admin\ShortController@top');
    Route::post('admin/short/upload-video', 'Admin\ShortController@postUploadVideo');
    Route::get('admin/video/cat/{catid}', 'Admin\VideoController@getCatVideo');
    Route::post('admin/video/upload-thumb', 'Admin\VideoController@postUploadThumb');
    Route::post('admin/video/upload-video', 'Admin\VideoController@postUploadVideo');
    //评论
    Route::get('admin/video/comment/list', 'Admin\CommentController@getIndex');
    Route::get('admin/video/comment/sens', 'Admin\CommentController@getSens');
    Route::post('admin/video/comment/destroy', 'Admin\CommentController@destroy');
    Route::post('admin/video/comment/search', 'Admin\CommentController@search');
    //评论黑名单
    Route::resource('admin/video/comment/black', 'Admin\CommentBlackController');
    Route::post('admin/video/comment/black/del', 'Admin\CommentBlackController@del');
    //敏感词
    Route::get('admin/sens/list', 'Admin\SensController@getSens');
    Route::post('admin/sens/del', 'Admin\SensController@del');
    Route::post('admin/sens/upload_sens', 'Admin\SensController@upload_sens');
    //直播
    Route::get('admin/live/list', 'Admin\LiveController@getIndex');
    Route::get('admin/live/create', 'Admin\LiveController@getCreate');
    Route::post('admin/live/store', 'Admin\LiveController@postStore');
    Route::get('admin/live/edit/{id}', 'Admin\LiveController@getEdit');
    Route::post('admin/live/edit-do', 'Admin\LiveController@postEditDo');
    Route::post('admin/live/destroy', 'Admin\LiveController@postDestroy');
    Route::post('admin/live/url', 'Ali\ALiveController@getUrl'); //直播信息获取
    //直播用户发言黑名单
    Route::resource('admin/live/black', 'Admin\BlackController');
    Route::post('admin/live/black/del', 'Admin\BlackController@del');
    //用户
    Route::post('admin/auth/action', 'Admin\ApplyController@action'); //驳回还是通过
    Route::get('admin/auth/apply', 'Admin\ApplyController@getApply');
    Route::get('admin/auth/user/export','Admin\UserController@export');
    Route::resource('admin/auth/user', 'Admin\UserController');
    Route::post('admin/auth/user/userDestroy', 'Admin\UserController@userDestroy'); //多选删除
    //管理员
    Route::resource('admin/auth/ma', 'Admin\ManagerController');
    Route::post('admin/auth/ma/del', 'Admin\ManagerController@del'); //多选删除
    //vip
    Route::resource('admin/auth/vip', 'Admin\VipController');
    //站内信
    Route::get('admin/mail/list', 'Admin\MailController@getmail');
    Route::post('admin/mail/del', 'Admin\MailController@delMail');
});
