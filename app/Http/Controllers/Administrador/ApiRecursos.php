<?php

namespace App\Http\Controllers\Administrador;

use App\Roles;
use App\Recursos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiRecursos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recursos = Recursos::all();

        return response()->json($recursos, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Roles::find($id);

        $permisos = json_decode($rol->permisos);
        return response()->json(['msg' => 'Recursos cargados correctamente', 'permisos' => $permisos], 200);
        // return $permisos;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'nombreRecurso.unique' => 'Este nombre de recurso ya existe',
            'nombreRecurso.required' => 'El nombre de recurso no puede estar en blanco',
            'ruta.unique' => 'Esta ruta ya existe',
            'ruta.required' => 'La ruta del recurso no puede estar en blanco',
        ];
        $validator = Validator::make($request->all(), [
            'nombreRecurso' => 'string|max:255|unique:recursos',
            'ruta' => 'string|max:255|unique:recursos',
        ], $messages);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $recurso = new Recursos();
        $recurso->nombreRecurso = $request->nombreRecurso;
        $recurso->ruta = $request->ruta;
        $recurso->icono = 'mdi-plus';
        $recurso->permisos = $request->permisos;
        $recurso->save();

        $roles = Roles::all();
        foreach ($roles as $rol) {
            $rol_edit = Roles::find($rol->id);
            $collect = collect(json_decode($rol_edit->permisos));
            $collect->push([
                'recurso'=> $request->nombreRecurso,
                'ver'=> false,
                'editar'=> false,
                'agregar'=> false,
                'eliminar'=> false,
                'ruta'=> $request->ruta,
            ]);
            $rol_edit->permisos = json_encode($collect);
            $rol_edit->save();
        }

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
