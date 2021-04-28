<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', function (Request $request) {
  $response = Http::get('https://ffm.ismart.link/api/location_teamview.html', [
      'username' => '03041228820',
      'password' => 'uil@123',
      'is_json_true' => 'y'
  ]);
  return $response;
});
Route::get('get-all-assets','Backend\ApiController@getAllAssets')->name('get.all.assets');
Route::get('get-all-fabrics','Backend\ApiController@getAllFabrics')->name('get.all.fabrics');
Route::get('get-all-setting','Backend\ApiController@getAllSetting')->name('get.all.setting');
