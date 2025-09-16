<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layer extends Model
{
    //
    protected $table = 'layers';
    protected $fillable = ['name', 'geojson'];
    protected $casts = ['geojson' => 'array'];
}
