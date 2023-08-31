<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ControllerExample;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//взаимодейтсвие с курсами
Route::prefix('v1')
->name('v1')
->group(function(){
    Route::apiResource('products', ProductController::class);

    Route::apiResource('categories', CategoryController::class);
   
    Route::apiResource('todos', ProductController::class);
    //связь один ко многим
    Route::get('category/{category}/products', [CategoryProductController::class, 'index']);
    Route::post('categories/{category}/products', [CategoryProductController::class, 'store']);
    //взаимодейтсвие с курсами
    Route::get('/products', [ProductsController::class, 'index']);
    Route::get('/products/{product}', [ProductsController::class, 'show']);
    Route::post('/products',[ProductsController::class, 'store']);
    Route::put('/products/{product}',[ProductsController::class, 'update']);
    Route::delete('/products/{product}', [ProductsController::class, 'delete']);
})->middleware('auth:sanctum');
//регистрация, авторизация и выход
    Route::group(['namespace' => 'api'], function () {
        Route::post('/auth/register', [AuthController::class, 'register']);
        Route::post('/auth/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});