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

Route::prefix('provider')->name('provider.')->middleware(['auth','user-access:provider'])->group(function () {

    Route::get('/', [App\Http\Controllers\ProviderController::class, 'profile'])->name('profile');
    Route::get('/addbook/{id}', [App\Http\Controllers\ProviderController::class, 'addbook'])->name('addbook');
    Route::post('/addbook/action', [App\Http\Controllers\ProviderController::class, 'addbookAction'])->name('addbook.action');
    Route::get('/books', [App\Http\Controllers\ProviderController::class, 'books'])->name('books');
    Route::get('/account/delete', [App\Http\Controllers\ProviderController::class, 'accountDelete'])->name('account.delete');
    Route::get('/account/delete/action', [App\Http\Controllers\ProviderController::class, 'accountDeleteAction'])->name('account.delete.action');
    Route::get('/upfate/info', [App\Http\Controllers\ProviderController::class, 'upfateInfo'])->name('upfate.info');
    Route::post('/upfate/info/action', [App\Http\Controllers\ProviderController::class, 'upfateInfoAction'])->name('upfate.info.action');
    Route::get('/services', [App\Http\Controllers\ProviderController::class, 'services'])->name('services');
    Route::get('/services/create', [App\Http\Controllers\ProviderController::class, 'servicesCreate'])->name('services.create');
    Route::get('/services/update/{id}', [App\Http\Controllers\ProviderController::class, 'servicesUpdate'])->name('services.update');
    Route::post('/services/create/action', [App\Http\Controllers\ProviderController::class, 'servicesCreateAction'])->name('services.create.action');
    Route::post('/services/update/action', [App\Http\Controllers\ProviderController::class, 'servicesUpdateAction'])->name('services.update.action');
    Route::get('/services/delete/{id}', [App\Http\Controllers\ProviderController::class, 'servicesDelete'])->name('services.delete');
    Route::get('/chat', [App\Http\Controllers\ProviderController::class, 'chat'])->name('chat');
    Route::post('/send/message', [App\Http\Controllers\ProviderController::class, 'sendMessage'])->name('send.message');

    Route::get('/books/new', [App\Http\Controllers\ProviderController::class, 'booksNew'])->name('books.new');
    Route::get('/books/new/accept/{id}', [App\Http\Controllers\ProviderController::class, 'booksAccept'])->name('book.accept');
    Route::get('/books/new/refues/{id}', [App\Http\Controllers\ProviderController::class, 'booksRefues'])->name('book.refues');
    Route::get('/books/delete/{id}', [App\Http\Controllers\ProviderController::class, 'bookDelete'])->name('book.delete');
    Route::get('/updatebook/{id}', [App\Http\Controllers\ProviderController::class, 'updatebook'])->name('updatebook');
    Route::post('/updatebook/action', [App\Http\Controllers\ProviderController::class, 'updatebookAction'])->name('updatebook.action');
});
