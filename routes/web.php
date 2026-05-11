<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| API ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/api/users', [UserController::class, 'index']);

/*
|--------------------------------------------------------------------------
| TOKEN (SANCTUM)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/token', function (Request $request) {
    return $request->user()->createToken('api-token')->plainTextToken;
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function (Request $request) {
        if ($request->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return app(DashboardController::class)->index($request);
    })->name('dashboard');

    // ✅ FIXED (IMPORTANT)
    Route::get('/admin-dashboard', function (Request $request) {
        if ($request->user()->role !== 'admin') {
            return redirect()->route('dashboard');
        }

        return view('admin');
    })->name('admin.dashboard');

    Route::get('/recipes/create', [RecipeController::class, 'create'])
        ->name('recipes.create');

    Route::post('/recipes/store', [RecipeController::class, 'store'])
        ->name('recipes.store');

    Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])
        ->name('recipes.delete');
});

require __DIR__.'/auth.php';
