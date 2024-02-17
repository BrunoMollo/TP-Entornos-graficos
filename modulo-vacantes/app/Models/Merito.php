<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merito extends Model
{
    use HasFactory;

    protected $table = 'meritos';
    protected $fillable = [
        'nombre',
    ];

    public function postulaciones(){
        return $this -> belongsToMany(Postulacion::class, 'postulacion_meritos_puntaje')->withPivot('puntaje')->withTimestamps();
    }
}
