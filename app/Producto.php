<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
   	protected $table = 'producto';

   	public function scopeSearch($query, $nombre){
    	return $query->where('nombre','LIKE',"%$nombre%");
    }

public function scopeNombre($query, $nombre){
        return $query->where('nombre',"$nombre");
    }    

    public function scopeCategory($query, $category){
    	if($category != ""){
    		return $query->where('idCategoria',"$category");
    	}
    }

    public function categoria(){
      return $this->hasOne('PocketByR\Categoria', 'id', 'idCategoria');
    }

    public function contienen(){
    return $this->hasMany('PocketByR\Contiene', 'idProducto', 'id');
    }
}
