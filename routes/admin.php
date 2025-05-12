<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return 'admin';
    })->name('dashboard');
});

// Route::middleware(['web', 'auth']) // Add 'is_admin' if needed
//     ->prefix('admin')
//     ->name('admin.')
//     ->group(function () {
//         Route::get('/', function () {
//             return view('admin.dashboard');
//         })->name('dashboard');
//     });