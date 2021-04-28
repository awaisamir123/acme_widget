<?php
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['namespace' => 'Auth', 'middleware' => 'AuthMiddleware'], function (){

  Route::get('/','LoginController@showLoginForm')->name('adminlogin');
    //system routes
    Route::get('admin/login','LoginController@showLoginForm')->name('login.form');
    Route::post('admin/login','LoginController@login')->name('login');
    Route::get('logout','LoginController@logout')->name('logout');

});



Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'middleware' => 'AdminMiddleware'], function(){
    Route::get('dashboard','DashboardController@dashboard')->name('dashboard');

    //roles routes

    // Product
    Route::get('product-list','ProductController@productList')->name('product.list');
    Route::get('product-add','ProductController@productAdd')->name('product.add');
    Route::post('product-add','ProductController@productStore')->name('product.store');
    Route::get('product-edit/{id}','ProductController@productEdit')->name('product.edit');
    Route::get('product-delete/{id}','ProductController@productDelete')->name('product.delete');
    Route::post('product-update','ProductController@productUpdate')->name('product.update');
    Route::get('product-offer-list','ProductController@productOfferlist')->name('product.offer.list');
    Route::get('product-add-offer','ProductController@productOfferadd')->name('product.add.offer');
    Route::post('product-store-offer','ProductController@productStoreOffer')->name('product.store.offer');
    Route::get('product-basket','ProductController@productbasket')->name('product.basket');
    Route::post('productDetail','ProductController@productDetail')->name('productDetail');
    Route::get('product-checkout','ProductController@productcheckout')->name('product.checkout');
    Route::get('product-remove-cart/{id}','ProductController@productRemoveCart')->name('product.remove.cart');
    Route::get('product-update-cart/{id}','ProductController@productUpdateCart')->name('product.update.cart');
    Route::post('product-update-Insert-cart','ProductController@productUpdateInsertCart')->name('product.update.Insert.cart');



});
