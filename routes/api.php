<?php

use App\Http\Controllers\IconController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\WidgetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/// API ICONS
Route::prefix('icons')->name('icons.')->group(function () {
    Route::get('/', [IconController::class, 'getAllIcon'])->name('getAllIcon');
    Route::get('/jsons/{category}', [IconController::class, 'getIconsByCategory'])->name('getIconsByCategory');
    Route::get('/{category1}/{category2}/{filename}', [IconController::class, 'getIconFile'])->name('getIconFile');
});

/// API THEMES
Route::prefix('themes')->name('themes.')->group(function () {
    Route::get('/', [ThemeController::class, 'getAllTheme'])->name('getAllTheme');
    Route::get('/{category}', [ThemeController::class, 'getThemesByCategory'])->name('getThemesByCategory');
});

/// API WIDGETS
Route::prefix('widgets')->name('widgets.')->group(function () {
    Route::get('/{category}', [WidgetController::class, 'getFilesByCategory'])->name('getFilesByCategory');
    Route::get('/jsons/{filename}', [WidgetController::class, 'getJsonFiles'])->name('getJsonFiles');
    Route::get('/{category}/{filename}', [WidgetController::class, 'getImageFiles'])->name('getImageFiles');
});

/// API IMAGES
Route::prefix('images')->name('images.')->group(function () {
    Route::get('/{category}', [ImageController::class, 'getImagesByCategory'])->name('getImagesByCategory');
    Route::get('/{category}/{filename}', [ImageController::class, 'viewTheme'])->name('viewTheme');
    Route::get('/screens/{category}/{foldername}', [ImageController::class, 'getThemeByCategoryInScreen'])->name('getThemeByCategoryInScreen');
});

Route::get('screens/{category1}/{category2}/{filename}', [ImageController::class, 'getDetailTheme'])->name('getDetailTheme');