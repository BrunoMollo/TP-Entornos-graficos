<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostulacionMeritos extends Pivot
{
    protected $fillable = [
        'puntaje',
    ];

}
