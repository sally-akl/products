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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['before' => 'auth.basic','prefix'=>'dashboard'],function () {

  Route::get('/',['uses'=>'Dashboard\DashboardController@index']);
  Route::resource('category','Dashboard\CategoryController');
  Route::resource('products','Dashboard\ProductsController');

});

Auth::routes();
