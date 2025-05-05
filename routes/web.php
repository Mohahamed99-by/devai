<?php

use App\Http\Controllers\ClientResponseController;
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

Route::get('/', [ClientResponseController::class, 'showForm']);
Route::post('/client-response', [ClientResponseController::class, 'store']);
Route::get('/client-response/{clientResponse}', [ClientResponseController::class, 'show']);

// Route pour la génération de PDF
Route::get('/pdf/generate/{clientResponse}', [App\Http\Controllers\PdfController::class, 'generatePdf']);
