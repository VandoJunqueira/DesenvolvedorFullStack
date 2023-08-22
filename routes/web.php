<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/{any}', AppController::class)->where('any', '.*')->name('app');
Route::get('/{slug}', [LinkController::class, 'redirect'])->name('links.redirect');
