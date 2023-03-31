<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'add'
], function () {
    Route::post('/addBook', [ProductController::class, 'add']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'main'
], function () {
    Route::get('/books', [ProductController::class, 'books']);
    Route::get('/searchBooks', [ProductController::class, 'searchBooks']);
    Route::get('/detail/{id}', [ProductController::class, 'getDetailBook']);
    Route::post('/pinjam/{id}', [ProductController::class, 'pinjam']);
    Route::get('/pinjam/{id}', [ProductController::class, 'getPinjamBuku']);
    Route::post('/confirm/{id}', [ProductController::class, 'confirm']);
});
