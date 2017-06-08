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
    return view('auth.login');
});


Auth::routes();
Route::get('/dashboard','HomeController@index');
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'category','namespace' => 'Admin'], function () {
    Route::get('/','AdminController@categoryIndex');
    Route::post('add-category','AdminController@categoryAdd');
    Route::get('/view-all-category','AdminController@viewCategory');
});


Route::group(['prefix' => 'product','namespace' => 'Admin'], function () {
    Route::get('/add-product','ProductController@productIndex');
    Route::get('/get-category-attr/{id}','ProductController@getCategoryAttribute');
    Route::post('/add-new-product','ProductController@productAdd');
    Route::get('/view-all-product','ProductController@viewProducts');
    Route::get('/add-bucket-product','ProductController@bucketProductIndex');
    Route::post('/add-new-bucket-product','ProductController@bucketProductAdd');

});