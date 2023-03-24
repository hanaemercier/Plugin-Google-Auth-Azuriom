<?php

use Azuriom\Plugin\GoogleAuth\Controllers\GoogleAuthHomeController;
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

Route::get('/', [GoogleAuthHomeController::class, 'redirectToProvider'])->name('login');
Route::get('/callback', [GoogleAuthHomeController::class, 'handleProviderCallback'])->name('callback');;
Route::post('/register-username', [GoogleAuthHomeController::class, 'registerUsername'])->name('register-username');
Route::get('/username', [GoogleAuthHomeController::class, 'username'])->name('username');
