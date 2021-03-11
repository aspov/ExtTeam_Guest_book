<?php

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

//user
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/guest_book', '/guest_book/messages')->name('guest_book');
Route::resource('/guest_book/messages', 'App\Http\Controllers\Guest_book\MessageController')->only(['index', 'store']);
Route::get('/guest_book/messages/reload-captcha', [App\Http\Controllers\Guest_book\MessageController::class, 'reloadCaptcha'])->name('reload-captcha');

//admin
Route::name('admin.')->prefix('admin_panel')->middleware(['auth','role:admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::redirect('/guest_book', '/guest_book/messages')->name('guest_book');
    Route::resource('/guest_book/messages', 'App\Http\Controllers\Admin\Guest_book\MessageController')->only(['index', 'update', 'destroy']);
});
