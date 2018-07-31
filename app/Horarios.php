<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    //
    protected $table = 'horarios';

    public function scopeHorariosEmpresa($query, $idEmpresa){
      $query->where('idEmpresa', $idEmpresa);
      return $query;
    }
}
