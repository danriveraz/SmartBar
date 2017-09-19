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
}
