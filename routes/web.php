<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MediaController;

// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Autenticación
Auth::routes(['register' => false]);

// Blog público
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/buscar', [BlogController::class, 'search'])->name('search');
    Route::get('/categoria/{category:slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{tag:slug}', [BlogController::class, 'tag'])->name('tag');
    Route::get('/{post:slug}', [BlogController::class, 'show'])->name('post');
});

// Rutas de administración
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard principal
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Gestión de servicios
    Route::resource('services', ServiceController::class);
    
    // Gestión del blog
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    
    // Acciones especiales para posts
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::post('{post}/publish', [PostController::class, 'publish'])->name('publish');
        Route::post('{post}/unpublish', [PostController::class, 'unpublish'])->name('unpublish');
        Route::post('{post}/duplicate', [PostController::class, 'duplicate'])->name('duplicate');
        Route::get('{post}/preview', [PostController::class, 'preview'])->name('preview');
    });
    
    // Gestión de archivos multimedia
    Route::prefix('media')->name('media.')->group(function () {
        Route::post('upload', [MediaController::class, 'upload'])->name('upload');
        Route::delete('delete', [MediaController::class, 'delete'])->name('delete');
    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
