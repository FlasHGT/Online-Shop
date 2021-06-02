<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;

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

Route::get('/', [ItemController::class, 'showMain'])->name('main');
Route::get('product/{id}', [ItemController::class, 'showProduct'])->name('product.show');

Route::get('cart', [OrderController::class, 'showCart'])->name('cart');

Route::get('profile', [UserController::class, 'showProfile'])->name('profile');
Route::get('orders', [UserController::class, 'showOrders'])->name('orders');

require __DIR__.'/auth.php';
