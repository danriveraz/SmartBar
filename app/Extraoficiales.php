<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Extraoficiales extends Model
{
    protected $table = 'extraoficiales';

    public function scopeEmpresa($query, $empresa){
        return $query->where('idEmpresa', $empresa);
    }
}
