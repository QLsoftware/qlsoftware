<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//zjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjt
Route::auth();

Route::get('/', 'HomeController_user@index');
Route::get('/zjt/look_info', 'test_ZJT@fun_test1_zjt');
//搜索导航
Route::get('/search', 'HomeController_user@search');
//空文件
Route::get('/home', function (){
    return view("home");
});
//抢课
Route::get('/zjt/getc', 'Getcourses@index');//返回
Route::post('/zjt/getc/request', 'Getcourses@getnew');
Route::post('/zjt/getc/cancel', 'Getcourses@del');
Route::post('/zjt/getc/pause', 'Getcourses@pause');
Route::post('/zjt/getc/restart', 'Getcourses@restart');
//绑定学号
Route::get('/link', 'HomeController_user@link');
Route::post('/link/request', 'HomeController_user@link_request');
Route::post('/link/cancel', 'HomeController_user@link_cancel');
Route::get('/e', 'test_ZJT@index');
//个人设置
Route::get('/profile', 'HomeController_user@profile');
Route::post('/profile', 'HomeController_user@update_avatar');
Route::post('/profile/sdu_notify_unaccept', 'HomeController_user@sdu_notify_unaccept');
Route::post('/profile/sdu_notify_accept', 'HomeController_user@sdu_notify_accept');

//zjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjt

//fcq
//Route::get('/search', 'SearchController@search');
Route::get('/search/course', 'SearchController@search_course');
//Route::post('/search/room', 'SearchController@search_room');
//Route::post('/search/car', 'SearchController@search_car');
Route::get('/search/grade', 'SearchController@search_grade');
Route::get('/evaluate', 'Evaluate@evaluate');
Route::post('/evaluate/jump', 'Evaluate@jump');
Route::post('/evaluate/yijian', 'Evaluate@yijian');
Route::post('/evaluate/tijiao', 'Evaluate@tijiao');
//fcq
//wc
Route::get('/fee', 'FeeController@fee');
Route::post('/fee/card', 'FeeController@fee_card');
Route::post('/fee/room', 'FeeController@fee_room');
Route::post('/fee/room/water', 'FeeController@fee_room_water');
Route::post('/fee/room/net', 'FeeController@fee_room_net');
Route::post('/fee/card/pay', 'FeeController@fee_card_pay');
//wc


//qy
Route::group(['prefix'=>'/repairman'],function(){
    // Route::get('/','RepairmanController@getRepairList');
    Route::get('/index','RepairmanController@index');
    Route::get('/update/{id}','RepairmanController@updateState');
    Route::get('/delete/{id}','RepairmanController@delete');
});
//qy


//wc fix
Route::get('/fix', 'FixController@fix');
Route::post('/fix/text', 'FixController@text');
Route::get('/fix/history', 'FixController@fix_history'); //这里用post不行
Route::post('/fix/evaluate', 'FixController@fix_evaluate'); //提交评价
//Route::post('/fix/avatar', 'FixController@fix_avatar');
//Route::post('/fee/card/pay', 'FeeController@fee_card_pay');
//wc fix



