<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'categoria';

    public function scopeSearch($query, $arreglo){
        $nombre = $arreglo[0];
        $idEmpresa = $arreglo[1];
    	return $query->where('nombre','LIKE',"%$nombre%")->
    	               where('idEmpresa','LIKE',"%$idEmpresa%")->
    	               orderBy('nombre','ASC');
    }

    public function productos(){
      return $this->hasMany('PocketByR\Producto', 'idCategoria', 'id')->orderBy('nombre', 'ASC');;
    }

    public function scopeCategoriasEmpresa($query, $idEmpresa){
        return $query->where('categoria.idEmpresa', $idEmpresa);
    }

}
