<?php

namespace PocketByR;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //Nombre de la tabla
    protected $table = 'usuario';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombrePersona', 'pais', 'departamento', 'ciudad', 'fechaNacimiento', 'cedula',  'sexo', 'telefono', 'email', 'estado', 'confirmoEmail', 'password',
        'idEmpresa','esAdmin','esMesero','esBartender','esCajero','provider','provider_id','imagenPerfil','obsequio','imagenNegocio'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Empresa(){
      return $this->belongsTo('PocketByR\Empresa', 'idEmpresa', 'id');
    }
}
