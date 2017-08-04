<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
   protected $table = 'mesa';

   public function scopeActualizarEstado($query, $id){
        $query->where('mesa.id', "$id")
          ->update(['mesa.estado' => "Desocupada"]);
    }

    public function scopeMesasAdmin($query, $idEmpresa){
        return $query->where('mesa.idEmpresa', $idEmpresa);
    }
    public function scopecalculaCantidad($query, $idEmpresa){
        return $query->where('mesa.idEmpresa', $idEmpresa)
        			->max('idMesa');
    }
}
