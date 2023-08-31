<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IncreasePostViewsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\PhoneAuthController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::get('/phone-auth', [PhoneAuthController::class, 'index']);
    Route::get('/increase-views', [IncreasePostViewsController::class, 'index']);
    Route::get('/posts/{postId}', [PostController::class, 'view']);
    Route::post('/deposit', [DepositController::class,'deposit'])->name('deposit');
    Route::get('/mark-as-read', [DepositController::class,'markAsRead'])->name('mark-as-read');
});

Route::get('/admin',[\App\Http\Controllers\Auth\LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[\App\Http\Controllers\Auth\LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/admin/register',[\App\Http\Controllers\Auth\RegisterController::class,'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register',[\App\Http\Controllers\Auth\RegisterController::class,'createAdmin'])->name('admin.register');

Route::get('/admin/dashboard',function(){
    return view('admin');
})->middleware('auth:admin');


