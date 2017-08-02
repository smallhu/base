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
Route::get('/info', 'Member\UserController@info');
Route::get('/json',function(){
    $rtnList = [];
    $rtnList['code'] = 'A400';
    $rtnList['desc'] = '数据获取成功！';
    return json_encode($rtnList);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/login','Member\LoginController@login');
