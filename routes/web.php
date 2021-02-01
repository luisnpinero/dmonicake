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
Route::get('/', [App\Http\Controllers\HomeController::class, 'main'])->name('root');

//Rutas Vistas Store
Route::get('store', 'StoreController@index')->name('store.index');
Route::get('store/{category}', 'StoreController@categories')->name('store.categories.show');
Route::get('store/product/{product}', 'StoreController@show_product')->name('store.product.show');

//vista dashboard
Route::get('dashboard/index', 'DashboardController@index')->name('dashboard.show');

//vista dashboard productos
Route::get('dashboard/products', 'ProductController@index')->name('dashboard.products.index');
Route::get('dashboard/products/create', 'ProductController@create')->name('dashboard.products.create');
Route::get('dashboard/products/{product}', 'ProductController@show')->name('dashboard.products.show');
Route::get('dashboard/products/{products}/edit', 'ProductController@edit')->name('dashboard.products.edit');
Route::post('dashboard/products', 'ProductController@store')->name('dashboard.products.store');
Route::put('dashboard/products/{products}', 'ProductController@update')->name('dashboard.products.update');
Route::put('dashboard/products/{products}/status', 'ProductController@status_update')->name('dashboard.products.update.status');
Route::put('dashboard/products/{products}/delete', 'ProductController@soft_delete')->name('dashboard.products.delete');

//vista dashboard ordenes
Route::get('dashboard/orders', 'OrderController@index')->name('dashboard.orders.index');
Route::get('dashboard/orders/{Orders}', 'OrderController@show')->name('dashboard.Orders.show');
Route::post('dashboard/orders', 'OrderController@store')->name('dashboard.Orders.store');
Route::match(['put', 'patch'], 'OrderController@update')->name('dashboard.Orders.update');
Route::delete('dashboard/orders/{Orders}', 'OrderController@destroy')->name('dashboard.Orders.delete');

//vista dashboard usuarios
Route::get('dashboard/users', 'UserController@index')->name('dashboard.users.index');
Route::get('dashboard/users/create', 'UserController@create')->name('dashboard.users.create');
Route::get('dashboard/users/{user}', 'UserController@show')->name('dashboard.users.show');
Route::get('dashboard/users/{user}/edit', 'UserController@edit')->name('dashboard.users.edit');
Route::post('dashboard/users', 'UserController@store')->name('dashboard.users.store');
Route::match(['put', 'patch'], 'UserController@update')->name('dashboard.users.update');
Route::delete('dashboard/users/{user}', 'UserController@destroy')->name('dashboard.users.delete');

//vista dashboard roles
Route::get('dashboard/roles', 'RoleController@index')->name('dashboard.roles.index');
Route::get('dashboard/roles/create', 'RoleController@create')->name('dashboard.roles.create');
Route::get('dashboard/roles/{role}', 'RoleController@show')->name('dashboard.roles.show');
Route::get('dashboard/roles/{role}/edit', 'RoleController@edit')->name('dashboard.roles.edit');
Route::post('dashboard/roles', 'RoleController@store')->name('dashboard.roles.store');
Route::match(['put', 'patch'], 'RoleController@update')->name('dashboard.roles.update');
Route::delete('dashboard/roles/{role}', 'RoleController@destroy')->name('dashboard.roles.delete');
