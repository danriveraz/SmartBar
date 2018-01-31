<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensaje';

    protected $fillable = ['id_emisor', 'id_receptor', 'asunto', 'descripcion','id', 'created_at', 'updated_at', 'estado'];

    public function Emisor(){
      return $this->belongsTo('PocketByR\Usuario', 'id_emisor', 'id');
    }
    public function Receptor(){
      return $this->belongsTo('PocketByR\Usuario','id_receptor', 'id');
    }

}
