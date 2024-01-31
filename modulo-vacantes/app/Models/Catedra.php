<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catedra extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    // Relación con los llamados
    public function llamados()
    {
        return $this->hasMany(Llamado::class);
    }
}
