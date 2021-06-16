<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdminController;

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

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('lang/{locale}', LanguageController::class);

Route::get('/', [ItemController::class, 'showMain'])->name('main');
Route::get('product/{id}', [ItemController::class, 'showProduct'])->name('product');

Route::post('cart', [OrderController::class, 'addOrRemoveFromCart']);
Route::get('cart', [OrderController::class, 'showCart'])->name('cart');

Route::post('cart/qty', [OrderController::class, 'changeQuantity']);

Route::get('order/create', [OrderController::class, 'showOrder'])->middleware(['auth']);
Route::post('order/create', [OrderController::class, 'addOrder'])->middleware(['auth']);

Route::get('profile', [UserController::class, 'showProfile'])->name('profile')->middleware(['auth']);

Route::get('profile/update', [UserController::class, 'showProfileUpdate'])->name('profile.update')->middleware(['auth']);
Route::post('profile/update', [UserController::class, 'profileInfoUpdate'])->middleware(['auth']);

Route::get('profile/address', [UserController::class, 'showAddAddress'])->name('address.add')->middleware(['auth']);
Route::post('profile/address', [UserController::class, 'addAddress'])->middleware(['auth']);
Route::delete('profile/address', [UserController::class, 'deleteAddress'])->middleware(['auth']);

Route::get('profile/address/update', [UserController::class, 'showAddressUpdate'])->middleware(['auth']);
Route::post('profile/address/update', [UserController::class, 'updateAddress'])->middleware(['auth']);

Route::get('profile/card', [UserController::class, 'showAddCard'])->name('card.add')->middleware(['auth']);
Route::post('profile/card', [UserController::class, 'addCard'])->middleware(['auth']);
Route::delete('profile/card', [UserController::class, 'deleteCard'])->middleware(['auth']);

Route::get('profile/card/update', [UserController::class, 'showCardUpdate'])->middleware(['auth']);
Route::post('profile/card/update', [UserController::class, 'updateCard'])->middleware(['auth']);

Route::get('orders', [UserController::class, 'showOrders'])->name('orders')->middleware(['auth']);
Route::get('order/{id}', [UserController::class, 'showOrderItems'])->middleware(['auth']);

Route::get('admin', [AdminController::class, 'showAdminPanel'])->name('admin.show');
Route::get('admin/orders', [AdminController::class, 'showOrders'])->name('admin.orders');

require __DIR__.'/auth.php';