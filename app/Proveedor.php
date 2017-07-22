<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';

    public function scopeSearch($query, $nombre){
    	return $query->where('nombre','LIKE',"%$nombre%");
    }
}
