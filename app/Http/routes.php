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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/zjt/look_info', 'test_ZJT@fun_test1_zjt');
//搜索导航
Route::get('/search', 'HomeController@search');
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
Route::get('/link', 'HomeController@link');
Route::post('/link/request', 'HomeController@link_request');
Route::post('/link/cancel', 'HomeController@link_cancel');
Route::get('/e', 'test_ZJT@index');
//个人设置
Route::get('/profile', 'HomeController@profile');
Route::post('/profile', 'HomeController@update_avatar');
Route::post('/profile/sdu_notify_unaccept', 'HomeController@sdu_notify_unaccept');
Route::post('/profile/sdu_notify_accept', 'HomeController@sdu_notify_accept');

//zjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjtzjt

//fcq
Route::get('/search', 'SearchController@search');
Route::post('/search/course', 'SearchController@search_course');
Route::post('/search/room', 'SearchController@search_room');
Route::post('/search/car', 'SearchController@search_car');
Route::post('/search/grade', 'SearchController@search_grade');
//fcq

//wc
Route::get('/fee', 'FeeController@fee');
Route::post('/fee/card', 'FeeController@fee_card');
Route::post('/fee/room', 'FeeController@fee_room');
Route::post('/fee/room/water', 'FeeController@fee_room_water');Route::post('/fee/room/net', 'FeeController@fee_room_net');
Route::post('/fee/card/pay', 'FeeController@fee_card_pay');
//wc

