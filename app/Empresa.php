<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';

    protected $fillable = [
        'nombreEstablecimiento','pais', 'departamento', 'ciudad', 'tipoRegimen', 'telefono', 'metodoPago', 'estado','baroRestaurante','usuario_id',
    ];

    public function AdminTotal(){
      return $this->belongsTo('PocketByR\User', 'usuario_id', 'id');
    }
}
