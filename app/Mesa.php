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

    public function scopeMesasReservadas($query, $idEmpresa){
      return $query->where([
                  ['estado','LIKE',"Reservada"],
                  ['idEmpresa', $idEmpresa]]);
    }

    public function scopeMesasAdmin($query, $idEmpresa){
        return $query->where('mesa.idEmpresa', $idEmpresa);
    }
    
    public function scopecalculaCantidad($query, $idEmpresa){
        return $query->where('mesa.idEmpresa', $idEmpresa)
        			->max('idMesa');
    }
    public function scopeEditarMesa($query, $arreglo){
        $id = $arreglo[0];
        $nombre = $arreglo[1];
         $query->where('id', "$id")
            ->update(['nombreMesa' => "$nombre"]);
    }
    public function scopeBuscarMesas($query, $arreglo){
      $id = $arreglo[0];
      $nombre = $arreglo[1];
        $query->where([
                  ['nombreMesa','LIKE',"%$nombre%"],
                  ['idEmpresa', $id]
              ]);
    }

    public function scopeMasVende(){
      return $query->where('idUsuario',"$usuario")->orderBy('fecha','DESC');
    }
}
