<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\LoginController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/gemini', [GeminiController::class, 'index'])->name('gemini.index');
Route::post('/gemini/analyze', [GeminiController::class, 'analyze'])->name('gemini.analyze');
Route::get('/loginform',[LoginController::class,'LoginForm'])->name('loginform');
Route::get('/registerform',[LoginController::class,'registerForm'])->name('registerform');
Route::post('/register',[LoginController::class,'register'])->name('register');
Route::post('/login',[LoginController::class,'Login'])->name('login');
Route::get('/user/dashboard',function(){
    return view('user.dashboard');
})->name('user.dashboard');
Route::get('/admin/dashboard',function(){
    return view('admin.dashboard');
})->name('admin.dashboard');

