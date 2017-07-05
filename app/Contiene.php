<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Contiene extends Model
{
    protected $table = 'contiene';

    public function scopeSearch($query, $id){
    	return $query->where('idProducto',"$id");
    }
}
