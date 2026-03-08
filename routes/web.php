<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::get('/', function () {
    $profile = \App\Models\CompanyProfile::latest()->first();
    $creeds = \App\Models\Creed::where('is_active', true)->orderBy('order')->get();
    $products = \App\Models\Product::where('is_featured', true)->latest()->take(4)->get();
    $newsItems = \App\Models\News::where('is_published', true)->latest()->take(6)->get();
    $menus = \App\Models\Menu::with('allChildren')
        ->whereNull('parent_id')
        ->where('is_actived', 1)
        ->orderBy('id', 'asc')
        ->get();
    $sustainabilityPoints = \App\Models\Sustainability::with('images')
        ->where('is_active', 1)
        ->orderBy('order')
        ->get();

    return view('welcome', compact('profile', 'creeds', 'products', 'newsItems', 'menus', 'sustainabilityPoints'));
});

Route::get('/sustainability/{slug}', [\App\Http\Controllers\Admin\SustainabilityController::class, 'show'])->name('sustainability.show');

// Admin Authentication
Route::get('admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
Route::post('admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('company', \App\Http\Controllers\Admin\CompanyProfileController::class);
        Route::resource('creeds', \App\Http\Controllers\Admin\CreedController::class);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
        Route::resource('menus', \App\Http\Controllers\Admin\MenuController::class);
        Route::resource('sustainabilities', \App\Http\Controllers\Admin\SustainabilityController::class);
        Route::get('sustainabilities/image/{image}', [\App\Http\Controllers\Admin\SustainabilityController::class, 'deleteImage'])->name('sustainabilities.delete-image');
    });
});

Route::get('/news', [NewsController::class, 'index']);