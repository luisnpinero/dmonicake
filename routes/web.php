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

//como usar resources si tengo funciones adicionales a las standard?

Route::group(['middleware' => 'admin'], function () {
    //vista dashboard
    Route::get('dashboard/index', 'DashboardController@index')->name('dashboard.index');

    //vista dashboard productos
    Route::get('dashboard/products', 'ProductController@index')->name('dashboard.products.index');
    Route::get('dashboard/products/create', 'ProductController@create')->name('dashboard.products.create');
    Route::get('dashboard/products/{product}', 'ProductController@show')->name('dashboard.products.show');
    Route::get('dashboard/products/{product}/edit', 'ProductController@edit')->name('dashboard.products.edit');
    Route::post('dashboard/products/create', 'ProductController@store')->name('dashboard.products.store');
    Route::put('dashboard/products/{product}', 'ProductController@update')->name('dashboard.products.update');
    Route::put('dashboard/products/{product}/status', 'ProductController@status_update')->name('dashboard.products.update.status');
    Route::put('dashboard/products/{product}/delete', 'ProductController@soft_delete')->name('dashboard.products.delete');

    //vista dashboard ordenes
    Route::get('dashboard/orders', 'OrderController@index')->name('dashboard.orders.index');
    Route::get('dashboard/orders/{order}', 'OrderController@show')->name('dashboard.orders.show');
    Route::put('dashboard/orders/{order}/status', 'OrderController@status_update')->name('dashboard.orders.update.status');
    Route::put('dashboard/orders/{order}/delete', 'OrderController@soft_delete')->name('dashboard.orders.delete');

    //vista dashboard contacto
    Route::get('dashboard/contact', 'ContactController@index')->name('dashboard.contact.index');
    Route::get('dashboard/contact/{contact}', 'ContactController@show')->name('dashboard.contact.show');
    Route::put('dashboard/contact/{contact}/status', 'ContactController@status_update')->name('dashboard.contact.update.status');


    //vista dashboard usuarios
    Route::get('dashboard/users', 'UserController@index')->name('dashboard.users.index');
    Route::get('dashboard/users/create', 'UserController@create')->name('dashboard.users.create');
    Route::get('dashboard/users/{user}', 'UserController@show')->name('dashboard.users.show');
    Route::get('dashboard/users/{user}/edit', 'UserController@edit')->name('dashboard.users.edit');
    Route::post('dashboard/users/create', 'UserController@store')->name('dashboard.users.store');
    Route::put('dashboard/users/{user}', 'UserController@update')->name('dashboard.users.update');
    Route::put('dashboard/users/{user}/status', 'UserController@status_update')->name('dashboard.users.update.status');
    Route::put('dashboard/users/{user}/delete', 'UserController@soft_delete')->name('dashboard.users.delete');

    //vista dashboard roles
    Route::get('dashboard/roles', 'RoleController@index')->name('dashboard.roles.index');
    Route::get('dashboard/roles/create', 'RoleController@create')->name('dashboard.roles.create');
    Route::get('dashboard/roles/{role}', 'RoleController@show')->name('dashboard.roles.show');
    Route::get('dashboard/roles/{role}/edit', 'RoleController@edit')->name('dashboard.roles.edit');
    Route::post('dashboard/roles/create', 'RoleController@store')->name('dashboard.roles.store');
    Route::put('dashboard/roles/{role}', 'RoleController@update')->name('dashboard.roles.update');
    Route::put('dashboard/roles/{role}/status', 'RoleController@status_update')->name('dashboard.roles.update.status');
    Route::put('dashboard/roles/{role}/delete', 'RoleController@soft_delete')->name('dashboard.roles.delete');

    //vista dashboard currencies 
    Route::get('dashboard/currencies', 'CurrencyController@index')->name('dashboard.currencies.index');
    Route::get('dashboard/currencies/create', 'CurrencyController@create')->name('dashboard.currencies.create');
    Route::get('dashboard/currencies/{currency}', 'CurrencyController@show')->name('dashboard.currencies.show');
    Route::get('dashboard/currencies/{currency}/edit', 'CurrencyController@edit')->name('dashboard.currencies.edit');
    Route::post('dashboard/currencies/create', 'CurrencyController@store')->name('dashboard.currencies.store');
    Route::put('dashboard/currencies/{currency}', 'CurrencyController@update')->name('dashboard.currencies.update');
    Route::put('dashboard/currencies/{currency}/status', 'CurrencyController@status_update')->name('dashboard.currencies.update.status');
    Route::put('dashboard/currencies/{currency}/delete', 'CurrencyController@soft_delete')->name('dashboard.currencies.delete');

    //vista dashboard paymentmethods 
    Route::get('dashboard/paymentmethods', 'PaymentMethodController@index')->name('dashboard.paymentmethods.index');
    Route::get('dashboard/paymentmethods/create', 'PaymentMethodController@create')->name('dashboard.paymentmethods.create');
    Route::get('dashboard/paymentmethods/{paymentmethod}', 'PaymentMethodController@show')->name('dashboard.paymentmethods.show');
    Route::get('dashboard/paymentmethods/{paymentmethod}/edit', 'PaymentMethodController@edit')->name('dashboard.paymentmethods.edit');
    Route::post('dashboard/paymentmethods/create', 'PaymentMethodController@store')->name('dashboard.paymentmethods.store');
    Route::put('dashboard/paymentmethods/{paymentmethod}', 'PaymentMethodController@update')->name('dashboard.paymentmethods.update');
    Route::put('dashboard/paymentmethods/{paymentmethod}/status', 'PaymentMethodController@status_update')->name('dashboard.paymentmethods.update.status');
    Route::put('dashboard/paymentmethods/{paymentmethod}/delete', 'PaymentMethodController@soft_delete')->name('dashboard.paymentmethods.delete');

    //vista dashboard categories 
    Route::get('dashboard/categories', 'CategoryController@index')->name('dashboard.categories.index');
    Route::get('dashboard/categories/create', 'CategoryController@create')->name('dashboard.categories.create');
    Route::get('dashboard/categories/{category}', 'CategoryController@show')->name('dashboard.categories.show');
    Route::get('dashboard/categories/{category}/edit', 'CategoryController@edit')->name('dashboard.categories.edit');
    Route::post('dashboard/categories/create', 'CategoryController@store')->name('dashboard.categories.store');
    Route::put('dashboard/categories/{category}', 'CategoryController@update')->name('dashboard.categories.update');
    Route::put('dashboard/categories/{category}/status', 'CategoryController@status_update')->name('dashboard.categories.update.status');
    Route::put('dashboard/categories/{category}/delete', 'CategoryController@soft_delete')->name('dashboard.categories.delete');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'main'])->name('root');
Route::get('/aboutus', 'HomeController@aboutus')->name('aboutus');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'ContactController@store')->name('contact.store');

//Rutas Vistas Store
Route::get('store', 'StoreController@index')->name('store.index');
Route::get('store/{category:name}', 'StoreController@categories')->name('store.categories.show');
Route::get('store/product/{product:name}', 'StoreController@show')->name('store.product.show');

