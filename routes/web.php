<?php

use GuzzleHttp\Middleware;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::prefix('/administracion')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.home');
        });
        Route::get('/home', function() { return view('adminHome'); })->name('admin.home');
        Route::get('productos/listado-edicion', [App\Http\Controllers\Admin\ProductsController::class, 'showProducts']);
        Route::get('productos/creacion', [App\Http\Controllers\Admin\ProductsController::class, 'createProduct']);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
