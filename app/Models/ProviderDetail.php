<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderDetail extends Model
{
    //
    protected $table = 'provider_details';
    protected $casts = [
        'setup_options' => 'array',
    ];
}
