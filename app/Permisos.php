<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    protected $table = 'permisos';
    protected $fillable = [
        'rol_id', 'operacion_id', 'value'
    ];
}
