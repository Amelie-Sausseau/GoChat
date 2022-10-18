<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

Route::resource('posts', App\Http\Controllers\PostController::class)->middleware('auth');
Route::resource('comments', App\Http\Controllers\CommentController::class);
Route::resource('roles', App\Http\Controllers\RoleController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'isConnected'])->name('home');

Route::get('/modify', [App\Http\Controllers\UserController::class, 'editUser'])->name('auth.modify');
Route::post('/modify', [App\Http\Controllers\UserController::class, 'update'])->name('post.modify');

Route::get('/file-upload', [ App\Http\Controllers\FileUploadController::class, 'getFileUploadForm' ])->name('get.fileupload');
Route::post('/file-upload', [ App\Http\Controllers\FileUploadController::class, 'store' ])->name('store.file');

Route::get('/password/reset/', [ App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.update');
Route::post('/password/reset/', [ App\Http\Controllers\Auth\ResetPasswordController::class, 'submitResetPasswordForm'])->name('password.request');
