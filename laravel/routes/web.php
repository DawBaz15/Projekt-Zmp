<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::post('/api/user/login', [UserController::class, 'login']);
Route::put('/api/user/reset', [UserController::class, 'resetPassword']);
Route::get('/api/user/index', [UserController::class, 'index']);
Route::post('/api/user/create', [UserController::class, 'create']);
Route::put('/api/user/modify', [UserController::class, 'modify']);

Route::post('/api/admin/login', [AdminController::class, 'login']);
Route::post('/api/admin/create', [AdminController::class, 'create']);
Route::put('/api/admin/reset', [AdminController::class, 'resetPassword']);
Route::get('/api/admin/notification', [AdminController::class, 'notification']);

Route::post('/api/item/create', [ItemController::class, 'create']);
Route::put('/api/item/modify', [ItemController::class, 'modify']);
Route::get('/api/item/index', [ItemController::class, 'index']);

Route::post('/api/stock/add', [StockController::class, 'add']);
Route::get('/api/stock/locate', [StockController::class, 'locate']);
Route::get('/api/stock/index', [StockController::class, 'index']);
Route::put('/api/stock/modify', [StockController::class, 'modify']);
