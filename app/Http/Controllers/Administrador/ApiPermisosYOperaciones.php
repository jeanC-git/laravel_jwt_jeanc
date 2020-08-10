<?php

namespace App\Http\Controllers\Administrador;

use App\Permisos;
use App\Operaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiPermisosYOperaciones extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $explode = explode('_',$id);
        $rol_id = $explode[0];
        $modulo_id = $explode[1];

        $permisos_actuales = Permisos::join('operaciones', 'operaciones.id', '=', 'permisos.operacion_id')
                    ->where('permisos.rol_id', $rol_id)
                    ->where('operaciones.modulo_id', $modulo_id)
                    ->get();
        $_permisos_actuales=collect();

        foreach ($permisos_actuales as $p) {
            $_permisos_actuales->push([
                'permiso_id' => $p->id,
                'rol_id' => $p->rol_id,
                'modulo_id' => $p->modulo_id,
                'operacion_id' => $p->operacion_id,
                'operacion_id' => $p->operacion_id,
                'texto' => $p->nombreOperacion,
                'descripcion' => $p->descripcion,
                'value' => $p->value
            ]);
        }


        return response()->json(compact('_permisos_actuales'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
