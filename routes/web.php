<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GenericDataTableController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

// show a particular shop website
Route::domain('{shop_name}.localhost')->group(function () {
    Route::get('/home', [StoreController::class, 'shopShow'])->name('shop.show');
});

// Routes for login and register pages
Route::middleware('guest')->get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::middleware('guest')->post('/login', [AuthController::class, 'login']);
Route::middleware('guest')->get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::middleware('guest')->post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Dashboard Routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Tenants
        Route::resource('tenants', TenantController::class);
        // Users
        Route::resource('users', UserController::class);

        // Stores
        Route::resource('stores', StoreController::class);
        // Categories
        Route::resource('categories', CategoryController::class);
        // Products
        Route::resource('products', ProductController::class);
    });


// Merchant Dashboard Routes
Route::middleware(['auth', 'role:merchant'])
    ->prefix('merchant')
    ->name('merchant.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Stores
        Route::resource('stores', StoreController::class);
        // Categories
        Route::resource('categories', CategoryController::class);
        // Products
        Route::resource('products', ProductController::class);
    });





