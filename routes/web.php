<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TableAdminController;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 
 use App\Models\Utilisateur;
 
Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/gemini', [GeminiController::class, 'index'])->name('gemini.index');
    Route::post('/gemini/analyze', [GeminiController::class, 'analyze'])->name('gemini.analyze');
});
Route::get('/loginform',[LoginController::class,'LoginForm'])->name('loginform');
Route::get('/registerform',[LoginController::class,'registerForm'])->name('registerform');
Route::post('/register',[LoginController::class,'register'])->name('register');
Route::post('/login',[LoginController::class,'Login'])->name('login');
Route::middleware('auth')->get('/user/dashboard', function () {
$user = Auth::user();
    $images = $user->images()->get();
    $imageCount = $user->images()->count();
    return view('user.dashboard', compact('images', 'imageCount'));
})->name('user.dashboard');
Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/tables', [TableAdminController::class, 'index'])->name('tables');
    Route::put('/users/{id}', [TableAdminController::class, 'update'])->name('update');
    Route::delete('/users/{id}', [TableAdminController::class, 'destroy'])->name('destroy');
});


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/tables', [TableAdminController::class, 'index'])->name('admin.tables');
