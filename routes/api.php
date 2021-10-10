<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ThumbnailController;
use App\Http\Controllers\Admin\CategoryController;

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
Route::post('uploads',[ThumbnailController::class,'uploads']);

//location route
Route::get('/location/provinces', [LocationController::class, 'getProvinces'])->name('getProvinces');
Route::get('/location/province/{province}/districts', [LocationController::class, 'getDistricts'])->name('getDistricts');
Route::get('/location/province/district/{district}/wards', [LocationController::class, 'getWards'])->name('getWards');

Route::get('/get_hot_categories',[CategoryController::class,'getHotCategories']);
Route::get('/get_hot_books',[BookController::class, 'getHeaderBooks']);

Route::get('suppliers',[InfoController::class,'getSuppliers']);
Route::get('/select_categories', [InfoController::class, 'getSelectCategories']);

Route::get('/info/transporters',[InfoController::class, 'getInfoTransporter']);
