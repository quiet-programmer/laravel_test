<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return redirect()->route('admin.authenticate');
});

Route::group(['prefix' => 'v1/admin/auth'], function () {
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/authenticate', 'authenticate')->name('admin.authenticate');
    });
});

Route::group(['prefix' => 'v1/admin'], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('admin.home');
        Route::get('/logout', 'destroy')->name('admin.destroy');
    });
});

require __DIR__ . '/auth.php';
