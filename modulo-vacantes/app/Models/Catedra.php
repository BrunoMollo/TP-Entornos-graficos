<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catedra extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'jefe_catedra_id'
    ];

    // Relación con los llamados
    public function llamados()
    {
        return $this->hasMany(Llamado::class);
    }

    // Relacion con el jefe de catedra
    public function jefe_catedra()
    {
        return $this->belongsTo(User::class, 'jefe_catedra_id');
    }
}
