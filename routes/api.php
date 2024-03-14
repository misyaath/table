<?php

use App\Http\Controllers\ExcelUploadController;
use App\Http\Controllers\SectorFinancialDataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('upload')->group(function () {
        Route::post('/', [ExcelUploadController::class, 'index']);
        Route::get('/', [ExcelUploadController::class, 'statuses']);
    });

    Route::prefix('sectors-financial-data')->group(function () {
        Route::get('/', [SectorFinancialDataController::class, 'index']);
    });

});
