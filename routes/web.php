<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\PublicController;

// Public routes
Route::get('/', [PublicController::class, 'index']);
Route::get('/catalogue', [PublicController::class, 'catalogue']);
Route::get('/gallery', [PublicController::class, 'gallery']);
Route::get('/about', [PublicController::class, 'about']);
Route::get('/contact', [PublicController::class, 'contact']);
Route::get('/product-detail', [PublicController::class, 'productDetail']);
Route::post('/send-message', [PublicController::class, 'sendMessage'])->name('contact.send');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Auth Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        Route::delete('products/image/{id}', [ProductController::class, 'destroyImage'])->name('products.destroyImage');
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('flower_types', App\Http\Controllers\Admin\FlowerTypeController::class);
        Route::resource('gallery', GalleryController::class);
        Route::resource('messages', MessageController::class);
        Route::resource('settings', SettingController::class);
    });
});
