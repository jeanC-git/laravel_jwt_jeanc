<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recursos extends Model
{
    protected $table = 'recursos';

    protected $fillable = [
        'nombreRecurso', 'recursos', 'ruta', 'icono'
    ];
}
