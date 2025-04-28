<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\IndexController;
use App\Http\Controllers\Api\MarcaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('products',ProductsController::class);
Route::resource('index',IndexController::class);
Route::resource('marca',MarcaController::class);
