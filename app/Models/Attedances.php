<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attedances extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'status', 'attended_at'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
