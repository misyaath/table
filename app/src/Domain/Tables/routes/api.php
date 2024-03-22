<?php

use App\src\Domain\Tables\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('tables')->group(function () {
        Route::post('/', [TableController::class, 'store']);
    });
});