<?php

namespace App\Http\Controllers\Administrador;

use App\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiRoles extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::all();

        return response()->json($roles, 200);
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
            'nombreRol.required' => 'El nombre del rol no puede ir vacio',
        ];

        $validator = Validator::make($request->all(), [
            'nombreRol' => 'required|string|max:255',
        ], $messages);

        if($validator->fails()) return response()->json($validator->errors(), 400);

        $rol = Roles::where('nombreRol', $request->nombreRol)->first();
        $msg = collect();
        if ($rol){
            $msg->push(['msg' => 'Ya existe un rol con este nombre.']);
            return  response()->json($msg, 400);
        }


        $rol = new Roles();
        $rol->nombreRol = $request->nombreRol;
        $rol->save();

        return response()->json(['msg' => 'Rol creado.'], 200);
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
        $messages = [
            'nombreRol.required' => 'El nombre del rol no puede ir vacio',
        ];

        $validator = Validator::make($request->all(), [
            'nombreRol' => 'required|string|max:255',
        ], $messages);
        if($validator->fails()) return response()->json($validator->errors(), 400);

        $rol = Roles::find($id);
        $rol->nombreRol = $request->nombreRol;
        $rol->save();

        return response()->json(['msg' => 'Rol actualizado.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
    }
}
