<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NovaPostController;

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
    return redirect()->route('novapost.index');
});

Route::get('/novapost', [NovaPostController::class, 'index'])->name('novapost.index');
Route::post('/novapost/calculate', [NovaPostController::class, 'calculate'])->name('novapost.calculate');

