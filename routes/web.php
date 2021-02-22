<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/newbom', function () {
    return view('modules.newbom');
});

// Route::get('/inventory', function () {
//     return view('modules.inventory');
// });


/*PRODUCTS TABLE ROUTE*/
Route::patch('/create-product', 'ProductsController@store');
Route::patch('/update-product/{id}', 'ProductsController@update');
Route::post('/delete-product/{id}', 'ProductsController@delete');
Route::post('/create-item-group', 'ProductsController@add_item_group');
Route::post('/create-product-unit', 'ProductsController@add_product_unit');
Route::post('/create-attribute', 'ProductsController@add_attribute');
Route::get('/get-attribute/{id}', 'ProductsController@get_attribute');

/*RAW MATERIALS TABLE ROUTE*/
Route::get('/inventory', 'MaterialsController@index')->name('inventory');
Route::post('/create-material', 'MaterialsController@store');
Route::get('/inventory/{id}', 'MaterialsController@get')->name('inventory.specific');
Route::post('/delete-material/{id}', 'MaterialsController@delete');
Route::patch('/update-material/{id}', 'MaterialsController@update')->name('material.update');
Route::patch('/update-product/{id}', 'ProductsController@update');

/*BOM TABLE ROUTE*/
Route::post('/createBOM', 'BOMController@store');
Route::get('/search-product/{product_code}', 'BOMController@search_product');
Route::get('/bom', 'BOMController@index');

Route::resource('manufacturing/categorization', ManufacturingCategorizationController::class)->only([
    'index', 'create', 'show', 'edit'
]);
