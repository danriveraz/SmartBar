<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'categoria';

    public function productos(){
      return $this->hasMany('PocketByR\Producto', 'idCategoria', 'id');
    }

    public function scopeCategoriasEmpresa($query, $idEmpresa){
        return $query->where('categoria.idEmpresa', $idEmpresa);
    }

}
