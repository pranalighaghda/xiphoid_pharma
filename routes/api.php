<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::post('admin/login', 'login');
});

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    // Page
    Route::get('pages', [PageController::class, 'index']);       // List all pages
    Route::get('pages/{id}', [PageController::class, 'show']);   // View single page
    Route::put('pages/{id}', [PageController::class, 'update']); // Update page

    // Section
    Route::get('pages/{page_id}/sections', [SectionController::class, 'index']);       // List all sections
    Route::get('pages/{page_id}/sections/{id}', [SectionController::class, 'show']);   // View single section
    Route::put('pages/{page_id}/sections/{id}', [SectionController::class, 'update']); // Update section

});
