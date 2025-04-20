<?php

use App\Http\Controllers\ContactController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'role:Admin,Moderator'])->group(function () {
    Route::resource('products', ProductController::class)->except(['show']);
});

Route::get('/store', [ProductController::class, 'byCategory'])->name('products.store');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::middleware(['auth', 'role:Admin,Moderator'])->get('/contact/messages', [ContactController::class, 'index'])->name('contact.index');

