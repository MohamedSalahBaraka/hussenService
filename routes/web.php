<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin']);

Route::get('/do', [App\Http\Controllers\HomeController::class, 'do']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::post('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/service/{id}', [App\Http\Controllers\HomeController::class, 'service'])->name('service');
Route::get('/invoice/{id}', [App\Http\Controllers\HomeController::class, 'invoice'])->name('invoice');
Route::post('/book', [App\Http\Controllers\HomeController::class, 'book'])->name('book')->middleware('auth');
Route::post('/payment', [App\Http\Controllers\HomeController::class, 'payment'])->name('payment')->middleware('auth');

Route::get('/register/user', [App\Http\Controllers\HomeController::class, 'registerUserShow'])->name('register.User.show');
Route::post('/register/user', [App\Http\Controllers\HomeController::class, 'registerUser'])->name('register.User');