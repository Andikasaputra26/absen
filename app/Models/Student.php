<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Attedances;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'barcode'];

    public function attendances()
    {
        return $this->hasMany(Attedances::class);
    }
}
