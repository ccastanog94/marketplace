<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::apiResource('products', ProductController::class);
Route::post('/products', [ProductController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
});

Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando 🎉']);
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
