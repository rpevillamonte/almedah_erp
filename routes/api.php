<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('manufacturing/categorization', ManufacturingCategorizationApiController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('manufacturing/products-typology', ManufacturingProductsTypologyApiController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('manufacturing/products', ManufacturingProductsApiController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);
