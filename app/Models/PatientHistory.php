<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    //
    protected $table = 'patients_history';

    protected $fillable = [
        'user_id',
        'user_name',
        'action',
        'patient_id',
        'ip_address',
        'user_agent',
        'country',
        'region',
        'city',
        'latitude',
        'longitude',
        'isp',
        'raw_geo',
        'notes',
    ];
}
