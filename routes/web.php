<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/register', [RegisterController::class, 'register'])->middleware('restrictothers');
// Страница создания токена
Route::get('/dashboard', function () {
    if(Auth::check() && Auth::user()->role === 1){
        return auth()
            ->user()
            ->createToken('auth_token', ['admin'])
            ->plainTextToken;
    }
    return redirect("/");
})->middleware('auth');
//возможность удаления токена
Route::get('clear/token', function() {
    if (Auth::check() && Auth::user()->role === 1){
        Auth::user()->tokens()->delete();
    }
        return 'Токен удалён';
})->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
