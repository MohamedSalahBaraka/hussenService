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

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/', [App\Http\Controllers\AdminController::class, 'profile'])->name('profile');
    Route::get('/books', [App\Http\Controllers\AdminController::class, 'books'])->name('books');
    Route::get('/services', [App\Http\Controllers\AdminController::class, 'services'])->name('services');
    Route::get('/services/delete/{id}', [App\Http\Controllers\ProviderController::class, 'servicesDelete'])->name('services.delete');
    Route::get('/user', [App\Http\Controllers\AdminController::class, 'user'])->name('user');
    Route::get('/user/create', [App\Http\Controllers\AdminController::class, 'userCreate'])->name('user.create');
    Route::post('/user/create/action', [App\Http\Controllers\AdminController::class, 'userCreateAction'])->name('user.create.action');
    Route::get('/user/update/{id}', [App\Http\Controllers\AdminController::class, 'userUpdate'])->name('user.update');
    Route::post('/user/update/action', [App\Http\Controllers\AdminController::class, 'userUpdateAction'])->name('user.update.action');
    Route::get('/user/delete/{id}', [App\Http\Controllers\AdminController::class, 'userDelete'])->name('user.delete');
    Route::get('/provider', [App\Http\Controllers\AdminController::class, 'provider'])->name('provider');
    Route::get('/provider/create', [App\Http\Controllers\AdminController::class, 'providerCreate'])->name('provider.create');
    Route::post('/provider/create/action', [App\Http\Controllers\AdminController::class, 'providerCreateAction'])->name('provider.create.action');
    Route::get('/provider/update/{id}', [App\Http\Controllers\AdminController::class, 'providerUpdate'])->name('provider.update');
    Route::post('/provider/update/action', [App\Http\Controllers\AdminController::class, 'providerUpdateAction'])->name('provider.update.action');
    Route::get('/provider/delete/{id}', [App\Http\Controllers\AdminController::class, 'providerDelete'])->name('provider.delete');
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');
    Route::get('/admin/create', [App\Http\Controllers\AdminController::class, 'adminCreate'])->name('admin.create');
    Route::post('/admin/create/action', [App\Http\Controllers\AdminController::class, 'adminCreateAction'])->name('admin.create.action');
    Route::get('/admin/update/{id}', [App\Http\Controllers\AdminController::class, 'adminUpdate'])->name('admin.update');
    Route::post('/admin/update/password', [App\Http\Controllers\AdminController::class, 'adminUpdatepassword'])->name('admin.update.password');
    Route::post('/admin/update/action', [App\Http\Controllers\AdminController::class, 'adminUpdateAction'])->name('admin.update.action');
    Route::get('/admin/delete/{id}', [App\Http\Controllers\AdminController::class, 'adminDelete'])->name('admin.delete');


    Route::get('/category', [App\Http\Controllers\AdminController::class, 'category'])->name('category');
    Route::get('/category/create', [App\Http\Controllers\AdminController::class, 'categoryCreate'])->name('category.create');
    Route::post('/category/create/action', [App\Http\Controllers\AdminController::class, 'categoryCreateAction'])->name('category.create.action');
    Route::get('/category/update/{id}', [App\Http\Controllers\AdminController::class, 'categoryUpdate'])->name('category.update');
    Route::post('/category/update/action', [App\Http\Controllers\AdminController::class, 'categoryUpdateAction'])->name('category.update.action');
    Route::get('/category/delete/{id}', [App\Http\Controllers\AdminController::class, 'categoryDelete'])->name('category.delete');


    Route::get('/bank', [App\Http\Controllers\AdminController::class, 'bank'])->name('bank');
    Route::get('/bank/create', [App\Http\Controllers\AdminController::class, 'bankCreate'])->name('bank.create');
    Route::post('/bank/create/action', [App\Http\Controllers\AdminController::class, 'bankCreateAction'])->name('bank.create.action');
    Route::get('/bank/update/{id}', [App\Http\Controllers\AdminController::class, 'bankUpdate'])->name('bank.update');
    Route::post('/bank/update/action', [App\Http\Controllers\AdminController::class, 'bankUpdateAction'])->name('bank.update.action');
    Route::get('/bank/delete/{id}', [App\Http\Controllers\AdminController::class, 'bankDelete'])->name('bank.delete');




    Route::get('/perpose', [App\Http\Controllers\AdminController::class, 'perpose'])->name('perpose');
    Route::get('/perpose/create', [App\Http\Controllers\AdminController::class, 'perposeCreate'])->name('perpose.create');
    Route::post('/perpose/create/action', [App\Http\Controllers\AdminController::class, 'perposeCreateAction'])->name('perpose.create.action');
    Route::get('/perpose/update/{id}', [App\Http\Controllers\AdminController::class, 'perposeUpdate'])->name('perpose.update');
    Route::post('/perpose/update/action', [App\Http\Controllers\AdminController::class, 'perposeUpdateAction'])->name('perpose.update.action');
    Route::get('/perpose/delete/{id}', [App\Http\Controllers\AdminController::class, 'perposeDelete'])->name('perpose.delete');

    Route::get('/chat/user/{id}', [App\Http\Controllers\AdminController::class, 'chatUserSingle'])->name('chat.user.single');
    Route::get('/chat/user', [App\Http\Controllers\AdminController::class, 'chatUser'])->name('chat.user');
    Route::post('/send/user/message', [App\Http\Controllers\AdminController::class, 'sendUserMessage'])->name('send.user.message');

    Route::get('/chat/provider/{id}', [App\Http\Controllers\AdminController::class, 'chatProviderSingle'])->name('chat.provider.single');
    Route::get('/chat/provider', [App\Http\Controllers\AdminController::class, 'chatProvider'])->name('chat.provider');
    Route::post('/send/provider/message', [App\Http\Controllers\AdminController::class, 'sendProviderMessage'])->name('send.provider.message');
});
