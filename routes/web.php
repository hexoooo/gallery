<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;

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
Route::resource('/album', 'App\Http\Controllers\AlbumController'::class);
Route::post('/album/{album}', [App\Http\Controllers\AlbumController::class, 'move'])->name('album.move');
Route::post('/album-delete-photo/{album}', [App\Http\Controllers\AlbumController::class, 'photoDestroy'])->name('album.photo.destroy');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



