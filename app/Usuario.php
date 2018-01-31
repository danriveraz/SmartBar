<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
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
      'idEmpresa','esAdmin','esMesero','esBartender','esCajero','provider','provider_id','imagenPerfil','obsequio','imagenNegocio', 'esProveedor'];

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

  public function AgendaTrabajadores(){
    return $this->hasmany('PocketByR\AgendaTrabajadores', 'idUsuario', 'id');
  }

  public function inicioSesion(){// función para crear un registro en la tabla de registroEntadaSalida, para administrar las entradas y salidas del usuario
      $Inicio = new RegistroLogin;
      $Inicio->idUsuario =  $this->id;
      $Inicio->ingreso =  Carbon::now();
      $Inicio->salida =  Carbon::now();
      $Inicio->save();
  }

  public function registros(){
      return $this->hasmany('PocketByR\RegistroLogin','idUsuario');
  }
   //protected $table = 'usuario';
}
