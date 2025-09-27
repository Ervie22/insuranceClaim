<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayerDetail extends Model
{
    use HasFactory;

    protected $table = 'payer_details';

    protected $fillable = [
        'payer_name',
        'plan_type',
        'plan_name',
        'address',
        'phone',
        'edi_payer_id',
        'effective_date',
        'renewal_date',
        'created_by',
        'updated_by',
        'status',
        'is_deleted',
    ];
}
