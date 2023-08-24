<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MetricController;
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


// Autenticação
Route::post('/login', [AuthController::class, 'login']);
Route::post('/sign-up', [AuthController::class, 'signUp']);

// Check Slug
Route::post('/links/slug', [LinkController::class, 'checkSlug']);

Route::middleware('auth:sanctum')->group(function () {

    // Links
    Route::resource('links', LinkController::class);

    // Metricas
    Route::get('/metrics', [MetricController::class, 'metrics']);
});

// Redireciona
Route::post('/{slug}', [LinkController::class, 'redirect'])->name('links.redirect');
