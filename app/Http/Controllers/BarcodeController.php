<?php

namespace App\Http\Controllers;
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
        // Mencari siswa berdasarkan barcode yang dipindai
        $student = Student::where('barcode', $request->barcode)->first();

        if ($student) {
            return response()->json([
                'status' => 'success',
                'student' => $student,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Siswa tidak ditemukan!',
            ]);
        }
    }
}
