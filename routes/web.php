<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [OrderController::class, 'index'])->name('home');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::patch('/admin/order/{id}', [AdminController::class, 'updateStatus'])->name('admin.order.update');

Route::get('/admin/menu', [AdminController::class, 'menu'])->name('admin.menu');
Route::post('/admin/menu', [AdminController::class, 'storeMenu'])->name('admin.menu.store');
Route::put('/admin/menu/{id}', [AdminController::class, 'updateMenu'])->name('admin.menu.update');
Route::delete('/admin/menu/{id}', [AdminController::class, 'destroyMenu'])->name('admin.menu.destroy');
Route::patch('/admin/menu/{id}/toggle', [AdminController::class, 'toggleMenuStatus'])->name('admin.menu.toggle');
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');