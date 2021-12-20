<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
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




//Auth::routes(['verify' => true]);

//Route::get('/home', 'HomeController@index')->name('home'); 

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');

Auth::routes(['verify' => true]);

//Route::get('/', [PagesController::class, 'index'])->name('index');

Route::get('/blog', [PostController::class, 'index'])->name('posts');

Route::get('/blog/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');

Route::post('/blog', [PostController::class, 'store'])->name('posts.store');

Route::get('/blog/{id}', [PostController::class, 'show' ])->name('posts.show');

Route::get('/blog/{id}/edit', [PostController::class, 'edit',])->name('posts.edit');

Route::put('/blog/{id}', [PostController::class ,'update'])->middleware('auth');

Route::delete('/blog/{id}', [PostController::class, 'destroy'])->middleware('auth');

Route::post('/blog/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');

Route::delete('/blog/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
