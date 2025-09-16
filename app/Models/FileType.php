<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileType extends Model
{


    protected $table = 'file_types';

    protected $fillable = [
        'name',
        'description',

    ];
}
