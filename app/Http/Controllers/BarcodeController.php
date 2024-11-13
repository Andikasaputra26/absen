<?php

namespace App\Http\Controllers;

use App\Models\Attedances;
use App\Models\Student;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class       BarcodeController extends Controller
{
    public function generateBarcode(Student $student)
    {
        // Generate QR Code untuk barcode siswa
        $barcode = QrCode::size(200)->generate($student->barcode);
        
        // Tampilkan barcode dalam view
        return view('barcodes.show', compact('barcode'));
    }

    public function validateBarcode(Request $request)
{
    $barcode = $request->barcode;
    $student = Student::where('barcode', $barcode)->first();

    if ($student) {
        // Menyimpan data kehadiran
        Attedances::create([
            'student_id' => $student->id,
            'status' => 'present', // Ubah sesuai jika ada status lain
            'attended_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Anda hadir',
            'student' => $student->name
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Pemindaian barcode gagal, coba ulangi'
    ]);
}

}
