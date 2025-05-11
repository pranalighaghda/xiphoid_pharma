<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\EntryController;
use App\Http\Controllers\Admin\BannerController;

Route::post('admin/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {

    Route::prefix('pages')->controller(PageController::class)->group(function () {
        Route::get('/', 'index');                // List all pages
        Route::get('{id}', 'show');              // Get single page
        Route::post('{id}', 'update');            // Update page
    });

    Route::prefix('pages/{page_id}/sections')->controller(SectionController::class)->group(function () {
        Route::get('/', 'index');                // List all sections in a page
        Route::get('{id}', 'show');              // Get single section
        Route::post('{id}', 'update');            // Update section
    });

    Route::prefix('pages/{page_id}/sections/{section_id}/entries')->controller(EntryController::class)->group(function () {
        Route::get('/', 'index');                // List all entries
        Route::post('/', 'store');               // Create new entry
        Route::get('{id}', 'show');              // Get single entry
        Route::post('reorder', 'reorder'); // Reorder entries
        Route::post('{id}', 'update');            // Update entry
        Route::delete('{id}', 'destroy');        // Delete entry
    });

    Route::prefix('banners')->controller(BannerController::class)->group(function () {
        Route::get('/', 'index');           // List all banners
        Route::get('{id}', 'show');         // Get single banner
        Route::post('/', 'store');          // Create new banner
        Route::delete('{id}', 'destroy');  // Delete banner
        Route::post('reorder', 'reorder'); // Reorder banners
        Route::post('{id}', 'update');      // Update banner
    });
});
