<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Contiene extends Model
{
    protected $table = 'contiene';

    public function scopeSearch($query, $idProducto){
    	return $query->where('idProducto',"$idProducto");
    }
}
