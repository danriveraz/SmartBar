<?php

namespace PocketByR;

use PocketByR\RegistroLogin; // modelo de regitro de entreda y salida
use Carbon\Carbon; // clase para obtener la Hora del registro, función Now()
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
        'idEmpresa','esAdmin','esMesero','esBartender','esCajero','provider','provider_id','imagenPerfil','obsequio','imagenNegocio', 'esProveedor','salario','direccion'];

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

    public function EmpresaActual(){
      return $this->belongsTo('PocketByR\Empresa', 'empresaActual', 'id');
    }

    public function empresas(){
      return $this->hasmany('PocketByR\Empresa', 'usuario_id', 'id');
    }

    public function AgendaTrabajadores(){
      return $this->hasmany('PocketByR\AgendaTrabajadores', 'idUsuario', 'id');
    }
 //Mensajes
    public function mensajes(){     
      return $this->hasmany('PocketByR\Mensaje','id_receptor', 'id');
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

    public function scopeSearch($query, $email){
      return $query->where('email','LIKE',"%$email%");
    }

    public function scopeSearchUsers($query, $empresa){
      return $query->where('empresaActual','LIKE',"%$empresa%");
    }
	
    public function scopeUsuariosEmpresa($query, $idEmpresa){
      return $query->where('idEmpresa',$idEmpresa)
                    ->where('esAdmin',0);
    }
}
