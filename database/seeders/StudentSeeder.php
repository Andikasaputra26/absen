<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Membuat data siswa secara manual
          Student::create([
            'name' => 'John Doe',
            'barcode' => '1234567890',
        ]);

        Student::create([
            'name' => 'Jane Smith',
            'barcode' => '0987654321',
        ]);
    }
}
