<?php

// use App\Models\Student;
// use App\Models\Attedances;
// use Illuminate\Http\Request;
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
    return view('scan-barcode');
});


Route::get('/students/{student}/generate-barcode', [BarcodeController::class, 'generateBarcode'])->name('filament.resources.students.generate-barcode');
Route::post('/scan-barcode', [BarcodeController::class, 'validateBarcode']);
Route::get('/scan-barcode', function () {
    return view('scan-barcode');
});




// Route::post('/mark-attendance', function (Request $request) {
//     $request->validate([
//         'barcode' => 'required|string',
//     ]);

//     $student = Student::where('barcode', $request->barcode)->first();

//     if ($student) {
//         Attedances::create([
//             'student_id' => $student->id,
//             'barcode' => $request->barcode,
//         ]);

//         return response()->json([
//             'status' => 'success',
//             'student' => $student
//         ]);
//     } else {
//         return response()->json([
//             'status' => 'error',
//             'message' => 'Student not found'
//         ]);
//     }
// });