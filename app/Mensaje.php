<?php

namespace PocketByR;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensaje';

    protected $fillable = ['id_emisor', 'id_receptor', 'asunto', 'descripcion'];

}
