<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
     protected $table = 'cliente';

      public function scopeListarTodas($query, $idEmpresa){
        $query->where('idEmpresa', $idEmpresa);
        return $query;
    }
}
