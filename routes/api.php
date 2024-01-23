<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\VendorController;
use \App\Http\Controllers\PaymentController;

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

Route::group(['prefix' => '/v1'], function () {

    Route::group(['prefix' => '/products'], function () {
        Route::post('/create', [ProductController::class, 'store']);
        Route::get('/{id}', [ProductController::class, 'findProductById']);
        Route::get('/{id}/vendor', [ProductController::class, 'findVendorProducts']);
    });

    Route::group(['prefix' => '/vendors'], function () {
        Route::get('/{lat}/{long}/geo', [VendorController::class, 'findNearVendorsByGeoLocation']);
        Route::get('/{id}/group', [VendorController::class, 'findVendorGroupProducts']);
    });

    Route::get('/payment/{productId}/product', [PaymentController::class, 'purchase']);

});
