<?php

use App\src\Domain\Files\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('files')->group(function () {
        Route::post('/', [FileController::class, 'uploadFile']);
    });
});