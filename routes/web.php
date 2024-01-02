<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware("auth")->group(function() {
    // Route Home
    Route::get('/',HomeController::class);

    // Route Profile
    Route::get('/profile', [UserController::class, 'profile']);
    
    // Route Products
    Route::controller(ProductController::class)->group(function() {
        // product route resource
        Route::resource('/products', ProductController::class);
        
        // search product route
        Route::get('/search', 'searchProduct')->name('products.search');
        Route::get('/product/search', 'showProduct')->name('product.show');

        // logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware("guest")->group(function() {
Route::controller(AuthController::class)->group(function() {
        // Route Login
        Route::get('/login', 'showLoginForm')->name('showLogin');
        Route::post('/login', 'login')->name('login');

        // Route Register
        Route::get('/register', 'showRegistrationForm')->name('showRegistration');
        Route::post('/register', 'register')->name('register');
    });
});
