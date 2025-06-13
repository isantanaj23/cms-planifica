<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Auth\LoginController;
// Cambio: Usar alias para evitar conflicto
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;

// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación manuales
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Redirección
Route::get('/home', function () {
    return redirect('/admin');
})->middleware('auth');

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
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Servicios - usando el controlador Admin
    Route::resource('services', AdminServiceController::class);
    Route::post('services/{service}/toggle-status', [AdminServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    
    // Posts
    Route::resource('posts', PostController::class);
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::post('{post}/publish', [PostController::class, 'publish'])->name('publish');
        Route::post('{post}/unpublish', [PostController::class, 'unpublish'])->name('unpublish');
        Route::post('{post}/duplicate', [PostController::class, 'duplicate'])->name('duplicate');
        Route::get('{post}/preview', [PostController::class, 'preview'])->name('preview');
    });
    
    // Categorías
    Route::resource('categories', CategoryController::class);
    
    // Media
    Route::prefix('media')->name('media.')->group(function () {
        Route::post('upload', [MediaController::class, 'upload'])->name('upload');
        Route::delete('delete', [MediaController::class, 'delete'])->name('delete');
    });
});