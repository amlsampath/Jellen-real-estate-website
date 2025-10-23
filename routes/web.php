<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SellingPropertiesController;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Properties
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

// Selling Properties
Route::get('/selling-properties', [SellingPropertiesController::class, 'index'])->name('selling-properties.index');

// Contact
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
