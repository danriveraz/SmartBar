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
    	return $query->where('idProducto',"$idInsumo");
    }
}
