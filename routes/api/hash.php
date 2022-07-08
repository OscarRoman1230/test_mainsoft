<?php

use App\Http\Controllers\HashController;
use Illuminate\Support\Facades\Route;

Route::post('/encrypt', [HashController::class, 'encrypt']);
Route::post('/decrypt', [HashController::class, 'decrypt']);
