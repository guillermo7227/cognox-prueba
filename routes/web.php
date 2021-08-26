<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransferenceController;
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

Route::redirect('/', '/home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix'     => 'accounts',
    'as'         => 'accounts.',
    'middleware' => 'auth'
], function() {
    Route::get('/', [AccountController::class, 'index'])->name('index');
});

Route::group([
    'prefix'     => 'transferences',
    'as'         => 'transferences.',
    'middleware' => 'auth'
], function() {
    Route::get('/', [TransferenceController::class, 'index'])->name('index');

    Route::get('to-own-account', [TransferenceController::class, 'toOwnAccount'])->name('to-own-account');

    Route::get('to-external-account', [TransferenceController::class, 'toExternalAccount'])->name('to-external-account');

    Route::get('list', [TransferenceController::class, 'list'])->name('list');

    Route::get('get-list', [TransferenceController::class, 'getList'])->name('get-list');

    Route::post('store', [TransferenceController::class, 'store'])->name('store');
});
