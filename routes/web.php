<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fileController;
use App\Http\Controllers\storeController;
use Symfony\Component\Finder\Iterator\FilecontentFilterIterator;

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
    return view('auth/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::post('dashboard/file', [fileController::class, 'index'])->name('file.processCSV');

// Ruta para mostrar el formulario de búsqueda (GET)
//  Route::post('/process-selection', [FileController::class, 'colorList'])->name('processSelection');

// Ruta para procesar la búsqueda (POST)
Route::post('/search-article', [FileController::class, 'searchArticle'])->name('searchArticle');



