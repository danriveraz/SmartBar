<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class AgendaTrabajadores extends Model
{
    //
    protected $table = 'agendatrabajadores';

    protected $fillable = [
        'idUsuario','fechaTrabajo', 
    ];

    public function user(){
    	return $this->belongsTo('PocketByR\User', 'idUsuario', 'id');
    }

    public function scopeTurnos($query, $idUsuario){
      $query->where('idUsuario', $idUsuario);
      //->select('lun','mar','mie','jue','vie','sab','dom','idUsuario');
      return $query;
  	}
}
