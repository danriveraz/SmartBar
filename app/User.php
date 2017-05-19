<?php

namespace PocketByR;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //Nombre de la tabla
    protected $table = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombreEstablecimiento', 'nombrePersona', 'pais', 'departamento', 'ciudad', 'fechaNacimiento', 'cedula',  'sexo', 'tipoRegimen', 'telefono', 'email', 'estado', 'confirmoEmail', 'baroRestaurante', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
