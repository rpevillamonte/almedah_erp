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
use App\Http\Controllers\MaterialsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::get('/inventory', 'MaterialsController@index')->name('inventory');
Route::get('/inventory/{id}', 'MaterialsController@get')->name('inventory.specific');


/*PRODUCT POST METHOD*/
Route::post('/create-product', 'ProductsController@store');
/*MATERIAL POST METHOD*/
Route::post('/create-material', 'MaterialsController@store');
/*MATERIAL CATEGORY POST METHOD*/
Route::post('/create-categories' , 'MaterialsController@storeCategory');

/*DEBUGGING*/
// Route::post('/create-product', function(Request $request){
//     echo json_encode($request->all());
// });

Route::patch('/update-material/{id}', 'MaterialsController@update')->name('material.update');
Route::patch('/update-product/{id}', 'ProductsController@update');

/*DEBUGGING*/
// Route::patch('/update-product/{id}', function(Request $request){
//     echo json_encode($request->all());
// });

Route::post('/delete-product/{id}', 'ProductsController@delete');
Route::post('/delete-material/{id}', 'MaterialsController@delete');
