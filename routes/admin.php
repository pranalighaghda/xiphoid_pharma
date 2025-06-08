<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\EntryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\HomepageBannerController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

Route::middleware('guest')->group(function () {});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['web', 'auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

        Route::delete('media/{id}', [MediaController::class, 'destroy']);


        Route::prefix('pages')->name('pages.')->controller(PageController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/edit/{page_id}', 'edit')->name('edit');
            Route::post('/update/{page_id}', 'update')->name('update');

            Route::prefix('{page_id}/sections')->name('sections.')->controller(SectionController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit/{section_id}', 'edit')->name('edit');
                Route::post('/update/{section_id}', 'update')->name('update');

                Route::prefix('{section_id}/entries')->name('entries.')->controller(EntryController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{entry_id}', 'edit')->name('edit');
                    Route::post('/update/{entry_id}', 'update')->name('update');
                    Route::delete('/delete/{entry_id}', 'destroy')->name('delete');
                    Route::get('/reorder', 'reorder')->name('reorder');
                    Route::post('/update-order', 'updateOrder')->name('update-order');
                });
            });
        });

    Route::prefix('homepage-banner')->name('homepage-banner.')->controller(HomepageBannerController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{banner_id}', 'edit')->name('edit');
        Route::post('/update/{banner_id}', 'update')->name('update');
        Route::delete('/delete/{banner_id}', 'destroy')->name('delete');
        Route::get('/reorder', 'reorder')->name('reorder');
        Route::post('/update-order', 'updateOrder')->name('update-order');
    });
    });
