<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;

    protected $table = 'postulaciones';

    protected $fillable = [
        'nombre',
        'curriculum_vitae',
        'correo_electronico',
        'llamado_id',
        'usuario_id',
    ];


    public function llamado(){
        return $this->belongsTo(Llamado::class, 'llamado_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

}
