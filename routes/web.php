<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogStatusController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExportProductController;
use App\Http\Controllers\ExportVariantController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShareBlogController;
use App\Http\Controllers\VariantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(BlogController::class)->group(function () {
        Route::get('/blogs','index')->name('blogs');
        Route::get('/blogs/create', 'create')->name('blogs.create');
        Route::post('/blogs/store', 'store')->name('blogs.store');
        Route::get('/blogs/{blog:slug}/view', 'view')->name('blogs.view');
        Route::get('/blogs/{blog:slug}/edit', 'edit')->name('blogs.edit');
        Route::post('/blogs/{blog}/update', 'update')->name('blogs.update');
        Route::delete('/blogs/{blog}/delete', 'destroy')->name('blogs.destroy');
    });

    //** Update Users Status */
    Route::post('/blogs/{blog:slug}/status', [BlogStatusController::class, 'update'])->name('blogs.status');

    Route::post('/comments/{blog}', [CommentController::class, 'store'])->name('comments.store');
    Route::post('comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');

    Route::get('blogs/{blog:slug}/share', [ShareBlogController::class, 'shareUserDetail'])->name('blogs.share');
    Route::post('blogs/{blog}/send', [ShareBlogController::class, 'send'])->name('blogs.send');
});

require __DIR__.'/auth.php';
