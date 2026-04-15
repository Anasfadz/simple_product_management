<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
})->name('home');

Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'my'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('language.switch');
Route::middleware('auth')->group(function () {
    Route::resource('products', \App\Http\Controllers\ProductController::class)->except('show');
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->except('show');
    Route::get('/api/search', [\App\Http\Controllers\ProductController::class, 'quickSearch'])->name('api.search');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    $stats = [
        'total_products' => $user->products()->count(),
        'total_value' => $user->products()->sum(\DB::raw('price * quantity')),
        'low_stock_count' => $user->products()->where('quantity', '<', 5)->count(),
    ];

    $topProducts = $user->products()
        ->select('name', \DB::raw('price * quantity as total_value'))
        ->orderByDesc('total_value')
        ->limit(10)
        ->get();

    return Inertia::render('Dashboard', [
        'stats' => $stats,
        'topProducts' => $topProducts
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
