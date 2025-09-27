<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosisCode extends Model
{
    use HasFactory;

    protected $table = 'diagnosis_code';

    protected $fillable = [
        'ICD10Code',
        'description',
        'category',
        'created_by',
        'updated_by',
        'status',
        'is_deleted',
    ];
}
