<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dockertest');
});

Route::get('/api/user/login', [UserController::class, 'login']);
Route::get('/api/user/reset', [UserController::class, 'resetPassword']);
Route::get('/api/user/index', [UserController::class, 'index']);
Route::get('/api/user/create', [UserController::class, 'create']);
Route::get('/api/user/modify', [UserController::class, 'modify']);

Route::get('/api/admin/login', [AdminController::class, 'login']);
Route::get('/api/admin/reset', [AdminController::class, 'resetPassword']);
Route::get('/api/admin/notification', [AdminController::class, 'notification']);

Route::get('/api/item/create', [ItemController::class, 'create']);
Route::get('/api/item/modify', [ItemController::class, 'modify']);
Route::get('/api/item/index', [ItemController::class, 'index']);

Route::get('/api/stock/add', [StockController::class, 'add']);
Route::get('/api/stock/locate', [StockController::class, 'locate']);
Route::get('/api/stock/index', [StockController::class, 'index']);
Route::get('/api/stock/modify', [StockController::class, 'modify']);
