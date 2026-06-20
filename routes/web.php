<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\RegisteredUserController;

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard Kasir
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD produk admin
    Route::resource('produk', ProductController::class)->except(['show']);
});

// Register khusus kasir
Route::get('/register/kasir', [RegisteredUserController::class, 'create'])->name('register.kasir');
Route::post('/register/kasir', [RegisteredUserController::class, 'store']);

// Buyer / customer routes (tidak perlu login)
Route::get('/menu', [ProductController::class, 'menu'])->name('menu');
Route::get('/user/pembayaran', [OrderController::class, 'pembayaranView'])->name('user.pembayaran');
Route::post('/user/order', [OrderController::class, 'store'])->name('user.order.store');

// CRUD pesanan admin
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/orders', [OrderController::class, 'latestOrders'])->name('order.orders');
    Route::post('/orders/{order}/accept', [OrderController::class, 'acceptOrder'])->name('orders.accept');
    Route::post('/orders/{order}/complete', [OrderController::class, 'completeOrder'])->name('orders.complete');
    Route::delete('/orders/{order}', [OrderController::class, 'deleteOrder'])->name('orders.delete');
});

// CRUD laporan admin
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
Route::get('/laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');

// CRUD transaksi kasir
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::middleware('auth')->get('/api/transaksi/terbaru', [TransaksiController::class, 'getTerbaru']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';