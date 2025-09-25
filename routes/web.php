<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Middleware\CheckAdmin;


Route::get('/', [PortfolioController::class, 'index']);
Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
Route::post('/authorize', [AdminController::class, 'login'])->name('auth');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

//Admin Routes
Route::middleware(CheckAdmin::class)->prefix('admin')->group(function(){

    Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
    Route::get('/galleries', [AdminController::class, 'gallery'])->name('gallery');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //post routes
    Route::post('/createblog', [BlogController::class, 'store'])->name('createBlogpost');
    Route::post('/creategallery', [GalleryController::class, 'store'])->name('creategallery');


});
