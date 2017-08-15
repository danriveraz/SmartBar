<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumo';

    public function scopeSearch($query, $arreglo){
        $nombre = $arreglo[0];
        $marca = $arreglo[1];
        $tipo = $arreglo[2];
        $idEmpresa = $arreglo[3];
        if($tipo !=""){
            return $query->where('nombre','LIKE',"%$nombre%")
                         ->where('idEmpresa','LIKE',"%$idEmpresa%")
                         ->orWhere('marca', 'LIKE', "%$nombre%")
                         ->orwhere('tipo',"$tipo")
                         ->orderBy('nombre','ASC');
        }else{
             return $query->where('nombre','LIKE',"%$nombre%")
                          ->where('idEmpresa','LIKE',"%$idEmpresa%")
                          ->orWhere('marca', 'LIKE', "%$nombre%")
                          ->orderBy('nombre','ASC');
        }
    	
    }
}
