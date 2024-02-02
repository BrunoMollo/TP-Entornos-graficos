<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llamado extends Model
{
    use HasFactory;

    protected $table = 'llamados';

    protected $fillable = [
        'catedra_id',
        'puesto',
        'descripcion',
        'fecha_apertura',
        'fecha_cierre',
    ];

    // Relación con la catedra
    public function catedra()
    {
        return $this->belongsTo(Catedra::class, 'catedra_id');
    }
    
    public function llamados(){
        return $this->hasMany(Postulacion::class);
    }
}
