<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/hello', function () {
    return view('home');
});
Route::get('/', [InvoiceController::class, 'create']);
Route::post('/invoice/download', [InvoiceController::class, 'download']);