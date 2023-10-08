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

Route::prefix('user')->name('user.')->middleware(['auth','user-access:user'])->group(function () {

    Route::get('/', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::get('/notification', [App\Http\Controllers\UserController::class, 'notification'])->name('notification');
    Route::get('/chat', [App\Http\Controllers\UserController::class, 'chat'])->name('chat');
    Route::post('/send/message', [App\Http\Controllers\UserController::class, 'sendMessage'])->name('send.message');
    Route::get('/books', [App\Http\Controllers\UserController::class, 'books'])->name('books');
    Route::get('/books/delete/{id}', [App\Http\Controllers\UserController::class, 'bookDelete'])->name('book.delete');
    Route::get('/account/delete', [App\Http\Controllers\UserController::class, 'accountDelete'])->name('account.delete');
    Route::get('/account/delete/action', [App\Http\Controllers\UserController::class, 'accountDeleteAction'])->name('account.delete.action');
    Route::get('/upfate/info', [App\Http\Controllers\UserController::class, 'upfateInfo'])->name('upfate.info');
    Route::post('/upfate/info/action', [App\Http\Controllers\UserController::class, 'upfateInfoAction'])->name('upfate.info.action');
    Route::get('/endpoint/{id}', [App\Http\Controllers\UserController::class, 'endpoint'])->name('endpoint');
    Route::get('/invoice/{id}', [App\Http\Controllers\UserController::class, 'invoice'])->name('invoice');

    Route::get('/updatebook/{id}', [App\Http\Controllers\UserController::class, 'updatebook'])->name('updatebook');
    Route::post('/updatebook/action', [App\Http\Controllers\UserController::class, 'updatebookAction'])->name('updatebook.action');
});
