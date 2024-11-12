<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarcodeController;

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


Route::get('/students/{student}/generate-barcode', [BarcodeController::class, 'generateBarcode'])->name('filament.resources.students.generate-barcode');
Route::post('/validate-barcode', [BarcodeController::class, 'validateBarcode']);
Route::get('/scan-barcode', function () {
    return view('scan-barcode');
});
