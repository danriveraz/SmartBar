<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;
use PocketByR\Producto;

class Contiene extends Model
{
    protected $table = 'contiene';

    public function scopeIdProducto($query, $idProducto){
    	return $query->where('idProducto',"$idProducto");
    }

    public function scopeIdInsumo($query, $idInsumo){
    	return $query->where('idInsumo',"$idInsumo");
    }

    public function insumo(){
      return $this->hasOne('PocketByR\Insumo', 'id', 'idInsumo');
    }

    public function contienen(){
      return $this->hasMany('PocketByR\Contiene','idProducto','id');
    }
}
