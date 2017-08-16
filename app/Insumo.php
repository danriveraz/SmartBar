<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumo';
    
    public function proveedor(){
    return $this->belongsTo('PocketByR\Proveedor', 'idProveedor', 'id');
  }

    public function scopeSearch($query, $nombre){
        
    	$query->where('nombre','LIKE',"%$nombre%")
    				->orWhere('marca', 'LIKE', "%$nombre%");

        return $query;
    				
    }

    public function scopeType($query, $type){
    	if($type != ""){
    		return $query->where('tipo',"$type");
    	}
    }
}
