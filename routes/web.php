<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\VendeurController;



Route::get('/', [HomeController::class, 'index']);



Route::get('/login',  [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{id}',    [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart',              [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/checkout',         [CartController::class, 'checkout'])->name('checkout');
});



Route::middleware('auth')->group(function () {
    Route::get('/product/create',       [ProductController::class, 'create']);
    Route::post('/product/store',       [ProductController::class, 'store']);
    Route::get('/product/edit/{id}',    [ProductController::class, 'edit']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::post('/product/delete/{id}', [ProductController::class, 'delete']);
    Route::post('/product/{id}/review', [ProductController::class, 'addReview'])->name('product.review');
});



Route::middleware('auth')->group(function () {
    Route::get('/orders',      [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});


Route::get('/confirmation', fn () => view('confirmation'));


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',             [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users',                 [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}',         [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/products',              [AdminController::class, 'products'])->name('products');
    Route::get('/products/{id}/edit',    [AdminController::class, 'editProduct'])->name('products.edit');
    Route::post('/products/{id}/update', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}',      [AdminController::class, 'deleteProduct'])->name('products.delete');
    Route::get('/orders',                [AdminController::class, 'orders'])->name('orders');
    Route::post('/orders/{id}/status',   [AdminController::class, 'updateOrderStatus'])->name('orders.status');
});



require __DIR__.'/auth.php';



Route::middleware('auth')->prefix('chat')->name('chat.')->group(function () {
    Route::get('/',                 [ChatController::class, 'index'])->name('index');
    Route::get('/unread/count',     [ChatController::class, 'unreadCount'])->name('unread');  // ← avant /{user}
    Route::get('/{user}',           [ChatController::class, 'show'])->name('show');
    Route::post('/{user}/send',     [ChatController::class, 'send'])->name('send');
    Route::get('/{user}/poll',      [ChatController::class, 'poll'])->name('poll');
});



Route::get('/vendeur/{id}',  [VendeurController::class, 'show'])->name('vendeur.show');
Route::middleware('auth')->get('/mon-shop', [VendeurController::class, 'dashboard'])->name('vendeur.dashboard');