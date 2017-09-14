<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class RegistroLogin extends Model
{

	/* este modelo está hecho para guardar en entrada la hora de login y en 
	salida la hora de la última acción registrada, pero por cuestiones de optimar 
	el código, ahora los campos created_at será la hora de entrada y updated_at la 
	hora de la última acción registrada
	*/
    protected $table = 'RegistroEntradaSalida';

    protected $fillable = [
        'idUsuario', 'salida',
    ];

    public function Usuario(){
      return $this->belongsTo('PocketByR\User', 'idUsuario', 'id');
    }
}
