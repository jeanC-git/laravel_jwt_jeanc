<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    protected $table = 'modulos';

    protected $fillable = [
        'nombreModulo0', 'ruta', 'icono', 'text', 'align' ,'start', 'sortable', 'value'
    ];

    public function getOperaciones()
    {
        return $this->hasMany('App\Operaciones', 'modulo_id');
    }
}
