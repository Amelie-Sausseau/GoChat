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

Route::resource('posts', App\Http\Controllers\PostController::class);
Route::resource('comments', App\Http\Controllers\CommentController::class);
Route::resource('roles', App\Http\Controllers\RoleController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'isConnected'])->name('dashboard');

Route::get('/modify', [App\Http\Controllers\UserController::class, 'editUser'])->name('auth.modify');
Route::post('/modify', [App\Http\Controllers\UserController::class, 'update'])->name('post.modify');

Route::get('/file-upload', [ App\Http\Controllers\FileUploadController::class, 'getFileUploadForm' ])->name('get.fileupload');
Route::post('/file-upload', [ App\Http\Controllers\FileUploadController::class, 'store' ])->name('store.file');

Route::get('/password/reset/', [ App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.update');
Route::post('/password/reset/', [ App\Http\Controllers\Auth\ResetPasswordController::class, 'submitResetPasswordForm'])->name('password.request');

Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
Route::post('/post/create', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::delete('/post/delete/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::put('/post/update/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');

Route::get('/comment/add/{id}', [App\Http\Controllers\CommentController::class, 'create'])->name('comments.add');
Route::post('/comment/add/{id}', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
Route::delete('/comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/comment/edit/{id}', [App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comment/update/{id}', [App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');