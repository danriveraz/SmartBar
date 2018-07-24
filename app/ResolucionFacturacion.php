<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class ResolucionFacturacion extends Model
{

	protected $table = 'resolucionFacturacion';

    public function scopeInsumosEmpresa($query, $idEmpresa){
        return $query->where('idEmpresa', $idEmpresa);
    }

    public function scopePrefijo($query, $prefijo, $idEmpresa){
        return $query->where('prefijo', $prefijo)
        			->where('idEmpresa',$idEmpresa);
    }
}
