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
use App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/products/{id}', [App\Http\Controllers\ProductsController::class, 'test']);

Route::get('/dashboard', function () {
    return view('modules.dashboard');
});

Route::get('/manufacturing', function () {
    return view('modules.manufacturing');
});

Route::get('/item', function () {
    return view('modules.item');
});

Route::get('/inventory', function () {
    return view('modules.inventory');
});


/*PRODUCT POST METHOD*/
Route::post('/create-product', 'ProductsController@store');
Route::post('/create-material', 'MaterialsController@store');

Route::patch('/update-product/{id}', 'ProductsController@update');

Route::post('/delete-product/{id}', 'ProductsController@delete');
Route::post('/delete-material/{id}', 'MaterialsController@delete');
