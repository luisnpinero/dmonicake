<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas Vistas Store
Route::get('store', 'StoreController@index')->name('store.index');
Route::get('store/{category}', 'StoreController@categories')->name('store.categories.show');
Route::get('store/product/{product}', 'StoreController@show_product')->name('store.product.show');

//vista dashboard productos
Route::get('dashboard/products', 'ProductController@index')->name('dashboard.products');
Route::get('dashboard/products/create', 'ProductController@create')->name('dashboard.products.create');
Route::get('dashboard/products/{products}', 'ProductController@show')->name('dashboard.products.show');
Route::get('dashboard/products/{products}/edit', 'ProductController@edit')->name('dashboard.products.edit');
Route::post('dashboard/products', 'ProductController@store')->name('dashboard.products.store');
Route::match(['put', 'patch'], 'ProductController@update')->name('dashboard.products.update');
Route::delete('dashboard/products/{products}', 'ProductController@destroy')->name('dashboard.products.delete');
