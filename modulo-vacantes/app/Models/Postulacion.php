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
        'correo_electronico',
        'llamado_id',
        'usuario_id',
    ];

    public function llamado(){
        return $this->belongsTo(Llamado::class, 'llamado_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }

}