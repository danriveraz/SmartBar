<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table = 'notificaciones';

    public function scopeEmpresa($query, $empresa){
        return $query->where('idEmpresa',"$empresa");
    }

    public function scopeUsuario($query, $usuario){
        return $query->where('idUsuario',"$usuario")->orderBy('fecha','DESC');
    }
}
