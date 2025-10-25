<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SellingPropertiesController;
use App\Http\Controllers\BlogController;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Properties
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

// Selling Properties
Route::get('/selling-properties', [SellingPropertiesController::class, 'index'])->name('selling-properties.index');

// Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{category}', [BlogController::class, 'category'])->name('blog.category');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication routes (no middleware)
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    
    // Protected admin routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        // Property management routes
        Route::resource('properties', App\Http\Controllers\Admin\PropertyController::class);
        Route::get('properties/{property}/view', [App\Http\Controllers\Admin\PropertyController::class, 'view'])->name('properties.view');
        
        // Blog post management routes (temporarily without middleware for testing)
        Route::resource('blog-posts', App\Http\Controllers\Admin\BlogPostController::class);
        Route::get('blog-posts/{blogPost}/view', [App\Http\Controllers\Admin\BlogPostController::class, 'view'])->name('blog-posts.view');
        
        
        // Agent contact management routes
        Route::get('agent-contact', [App\Http\Controllers\Admin\AgentContactController::class, 'index'])->name('agent-contact.index');
        Route::get('agent-contact/edit', [App\Http\Controllers\Admin\AgentContactController::class, 'edit'])->name('agent-contact.edit');
        Route::put('agent-contact', [App\Http\Controllers\Admin\AgentContactController::class, 'update'])->name('agent-contact.update');
        
        // Debug route for file upload testing
        Route::get('debug-upload', function() {
            return view('admin.debug-upload');
        })->name('debug.upload');
        
        // Debug route for blog post testing
        Route::post('debug-blog', function(\Illuminate\Http\Request $request) {
            \Log::info('Debug blog post submission', [
                'request_data' => $request->all(),
                'has_files' => $request->hasFile('featured_image'),
                'method' => $request->method(),
                'url' => $request->url()
            ]);
            return response()->json(['success' => true, 'message' => 'Debug route reached']);
        })->name('debug.blog');
        
        Route::post('debug-upload', function(\Illuminate\Http\Request $request) {
            \Log::info('Debug upload test:', [
                'has_files' => $request->hasFile('test_file'),
                'file_valid' => $request->hasFile('test_file') ? $request->file('test_file')->isValid() : false,
                'file_size' => $request->hasFile('test_file') ? $request->file('test_file')->getSize() : 0,
                'file_name' => $request->hasFile('test_file') ? $request->file('test_file')->getClientOriginalName() : null,
            ]);
            return response()->json(['success' => true]);
        })->name('debug.upload.test');
        // Blog management routes will be added here
        // Media library routes will be added here
        // Inquiry management routes will be added here
    });
});

