<?php

use Azuriom\Plugin\GoogleAuth\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your plugin. These
| routes are loaded by the RouteServiceProvider of your plugin within
| a group which contains the "web" middleware group and your plugin name
| as prefix. Now create something great!
|
*/

Route::middleware('can:google-auth.admin')->group(function () {
    Route::get('/settings', [AdminController::class, 'show'])->name('settings');
    Route::post('/settings', [AdminController::class, 'save'])->name('settings.save');
});
