<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UpdateApplicationController;
use App\Http\Controllers\UserApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/{id}', [DashboardController::class, 'show']);
    Route::get('/dashboard/{id}/download', [DashboardController::class, 'download']);

    Route::get('/send-application', [UserApplicationController::class, 'show']);
    Route::post('/send-application', [UserApplicationController::class, 'send']);

    Route::post('/upload-curriculum', [UserApplicationController::class, 'upload']);

    Route::get('/update-application/{id}', [UpdateApplicationController::class, 'show']);
    Route::put('/update-application/{id}', [UpdateApplicationController::class, 'update'])->name('update.application');
});

require __DIR__.'/auth.php';
