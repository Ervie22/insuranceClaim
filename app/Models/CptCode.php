<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CptCode extends Model
{
    use HasFactory;

    protected $table = 'cpt_code';

    protected $fillable = [
        'cpt',
        'description',
        'Medicare_OH_Fee_DEMO',
        'Medicaid_OH_Fee_DEMO',
        'Triple_Medicare_Fee_DEMO',
        'created_by',
        'updated_by',
        'status',
        'is_deleted',
    ];
}
