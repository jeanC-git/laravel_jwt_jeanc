<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operaciones extends Model
{
    protected $table = 'operaciones';
    protected $fillable = [
        'nombreOperacion', 'descripcion', 'modulo_id'
    ];
}
