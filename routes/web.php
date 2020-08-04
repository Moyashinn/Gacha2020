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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/uuid', 'Auth@uuid');

Route::post('/register','Auth@register');
Route::post('/session/get', 'Auth@get_session');

//XXXここから先 要認証
Route::middleware(['gacha.auth'])->group(function(){
Route::get('/list','LootBox@list');
Route::get('/drow/{id}/{cnt}', 'LootBox@drow');
});