<?php

namespace App\Http\Controllers\Administrador;

use App\Modulos;
use App\Operaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiModulos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = Modulos::all();
        $m_collect = collect($modulos);
        foreach ($m_collect as $m) {
            $m->push($m->getOperaciones);
        }

        return response()->json($m_collect, 200);
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

        $messages = [
            'nombreModulo.unique' => 'Este nombre de módulo ya existe',
            'nombreModulo.required' => 'El nombre de módulo no puede estar en blanco',
            'ruta.unique' => 'Esta ruta ya existe',
            'ruta.required' => 'La ruta del módulo no puede estar en blanco',
        ];
        $validator = Validator::make($request->all(), [
            'nombreModulo' => 'string|max:255|unique:modulos',
            'ruta' => 'string|max:255|unique:modulos',
        ], $messages);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $modulo = new Modulos();
        $modulo->nombreModulo = $request->nombreModulo;
        $modulo->ruta = $request->ruta;
        $modulo->icono = 'mdi-plus';
        $modulo->text = $request->nombreModulo;
        $modulo->align = 'start';
        $modulo->sortable = true;
        $modulo->estado = 'beta';
        $value = explode('/', $request->ruta);
        $modulo->value = $value[1];
        $modulo->save();

        $operaciones = $request->operaciones;
        if (count($operaciones)) {
            foreach ($operaciones as $o) {
                $operacion = Operaciones::create([
                    'nombreOperacion' => $o['nombreOperacion'],
                    'descripcion' => $o['descripcion'],
                    'modulo_id' => $modulo->id
                ]);
            }
        }

        return response()->jsonp(['msg' => 'Ruta y operaciones asignadas correctamente'], $data, 200, $headers);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
