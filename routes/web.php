<?php

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

Route::get('/send-application', [UserApplicationController::class, 'show']);
Route::post('/send-application', [UserApplicationController::class, 'send']);
Route::post('/upload-curriculum', [UserApplicationController::class, 'upload']);

require __DIR__.'/auth.php';
