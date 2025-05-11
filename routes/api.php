<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\EntryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;

Route::post('admin/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {

    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::post('/change-password', [ProfileController::class, 'changePassword']);
    Route::post('/users', [ProfileController::class, 'store']); // Create user

    Route::delete('media/{id}', [MediaController::class, 'destroy']);        // Delete media

    Route::get('settings', [SettingController::class, 'index']);
    Route::post('settings', [SettingController::class, 'update']);

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

    Route::prefix('enquiries')->controller(EnquiryController::class)->group(function () {
        Route::get('/', 'index');              // Paginated + searchable
        Route::post('{id}/reply', 'reply');   // Reply to enquiry
    });

    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index');           // List all categories
        Route::get('{id}', 'show');         // Get single category
        Route::post('/', 'store');          // Create new category
        Route::delete('{id}', 'destroy');  // Delete category
        Route::post('reorder', 'reorder'); // Reorder categories
        Route::post('{id}', 'update');      // Update category
    });

    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index');           // List all products
        Route::get('{id}', 'show');         // Get single product
        Route::post('/', 'store');          // Create new product
        Route::delete('{id}', 'destroy');  // Delete product
        Route::post('reorder', 'reorder'); // Reorder products
        Route::post('{id}', 'update');      // Update product
    });
});
