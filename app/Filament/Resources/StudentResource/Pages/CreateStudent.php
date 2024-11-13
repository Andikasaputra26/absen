<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\Student;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Membuat nilai barcode otomatis jika tidak ada barcode yang diinput
        $data['barcode'] = $this->generateUniqueBarcode();

        return $data;
    }

    // Fungsi untuk menghasilkan barcode unik
    private function generateUniqueBarcode(): string
    {
        // Menghasilkan barcode 10 digit random
        do {
            $barcode = mt_rand(1000000000, 9999999999); // Barcode 10 digit
        } while (Student::where('barcode', $barcode)->exists());

        return (string) $barcode;
    }
}
