<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumo';

    public function scopeSearch($query, $nombre){
    	return $query->where('nombre','LIKE',"%$nombre%");
    }

    public function scopeType($query, $type){
    	if($type != ""){
    		return $query->where('tipo',"$type");
    	}
    }
}
