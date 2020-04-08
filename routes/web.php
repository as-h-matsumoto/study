<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
		  
//Route::get('/', 'CmnController@redirect_top');
//Route::get('/', 'YoyakuController@getIntroduceOwner');
//Route::get('/helthCheck', 'CmnController@helthCheck');
//Route::get('/', 'CmnController@redirect_top');
Route::get('/', function () { return view('license.chushokigyo.index'); })->middleware('AllPutData');
Route::get('/test1', 'TestController@test1');
Route::get('/test2', 'TestController@test2');
Route::get('/test3', 'TestController@test3');
Route::get('/test4', 'TestController@test4');
Route::get('/test5', 'TestController@test5');
//Route::get('/', function () { return view('renewal'); })->middleware('AllPutData');
//Auth::routes();
Auth::routes(['verify' => true]); 
