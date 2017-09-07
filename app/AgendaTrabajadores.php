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
}
