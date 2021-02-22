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
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MaterialsController;
use Illuminate\Http\Request;

Route::get('/', function () {
    if (Auth::check())
        return View::make('welcome');
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/products/{id}', [App\Http\Controllers\ProductsController::class, 'test']);

Route::get('/dashboard', function () { return view('modules.dashboard'); })->name('dashboard');
Route::get('/manufacturing', function () { return view('modules.manufacturing'); });
Route::get('/item', function () { return view('modules.item'); });
Route::get('/inventory', function () { return view('modules.inventory'); });

//*PRODUCT POST METHOD*/
Route::post('/create-product', 'ProductsController@store');
Route::post('/create-material', 'MaterialsController@store');
Route::patch('/update-product/{id}', 'ProductsController@update');
Route::post('/delete-product/{id}', 'ProductsController@delete');
Route::post('/delete-material/{id}', 'MaterialsController@delete');


// added get routes for customer module
Route::get('/customer', function () { return view('modules.customer'); });
Route::get('/customertable', function () { return view('modules.customertable'); });


// added post & update routes for customer module
Route::post('/create-customer', 'CustomerController@store')->name('customer');
Route::put('/update-customer/{id}', 'CustomerController@update');

/*PRODUCTS TABLE ROUTE*/
Route::get('/item','ProductsController@index');
Route::get('/get-attribute/{id}', 'ProductsController@get_attribute');
Route::patch('/create-product', 'ProductsController@store');
Route::patch('/update-product/{id}', 'ProductsController@update');
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
Route::post('/create-item-group', 'ProductsController@add_item_group');
Route::post('/create-product-unit', 'ProductsController@add_product_unit');
Route::post('/create-attribute', 'ProductsController@add_attribute');

/*RAW MATERIALS TABLE ROUTE*/
Route::get('/inventory', 'MaterialsController@index')->name('inventory');
Route::get('/inventory/{id}', 'MaterialsController@get')->name('inventory.specific');
Route::post('/create-material', 'MaterialsController@store');
Route::post('/delete-material/{id}', 'MaterialsController@delete');
Route::patch('/update-material/{id}', 'MaterialsController@update')->name('material.update');
Route::patch('/update-product/{id}', 'ProductsController@update');

Route::get('/test', 'DebugController@index');
Route::post('/test', 'DebugController@debug');

// added get routes for employee module
Route::get('/profile', function () { return view('modules.profile'); })->name('profile');
Route::get('/hr', function () { return view('modules.hr'); });
Route::get('/employee', 'EmployeeController@index');
Route::get('/employeetable', function () { return view('modules.employeetable'); });

// added post & update routes for employee module
Route::post('/create-employee', 'EmployeeController@store')->name('employee');
Route::post('/update-employee-image/{id}', 'EmployeeController@updateimage');
Route::put('/update-employee/{id}', 'EmployeeController@update');
Route::put('/update-employee-status/{id}/{stat}', 'EmployeeController@toggle');

// google login
Route::get('/sign-in/google', 'Auth\LoginController@google');
Route::get('/sign-in/google/redirect', 'Auth\LoginController@googleRedirect');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
