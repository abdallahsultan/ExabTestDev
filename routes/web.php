<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitHubController;

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
    return view('welcome');
});

Route::get('/', [GitHubController::class, 'index'])->name('repositories.index');
Route::get('/repositories/fetch', [GitHubController::class, 'fetchData'])->name('repositories.fetch');
Route::post('/repositories/export', [GitHubController::class, 'export'])->name('repositories.export');
