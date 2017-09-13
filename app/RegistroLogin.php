<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class RegistroLogin extends Model
{
    protected $table = 'RegistroEntradaSalida';

    protected $fillable = [
        'idUsuario','ingreso', 'salida',
    ];

    public function Usuario(){
      return $this->belongsTo('PocketByR\User', 'idUsuario', 'id');
    }
}
