<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('test',[Controller::class,'TestFunction']);



Route::post('addProduct', [Controller::class,'AddProductData']);
Route::get('getAllProducts', [Controller::class,'GetAllProductsData']);
Route::get('searchProduct', [Controller::class,'SearchProductData']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
