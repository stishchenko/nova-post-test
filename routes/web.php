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
    return redirect('/novapost/ua');
});
Route::get('/novapost', function () {
    return redirect('/novapost/ua');
});

Route::get('/novapost/{locale}', [NovaPostController::class, 'index'])->name('novapost.index');
Route::post('/novapost/calculate/{locale}', [NovaPostController::class, 'calculate'])->name('novapost.calculate');

