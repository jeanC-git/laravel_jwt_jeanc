<?php

namespace App\Http\Controllers\Administrador;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiUsuarios extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        $data = collect($usuarios);
        foreach ($usuarios as $value) {
            $value->nombreRol = $value->rol->nombreRol;
        }

        return response()->json( $data, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'rol_id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'nombres' => $request->get('nombres'),
            'apellidos' => $request->get('apellidos'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'rol_id' => $request->get('rol_id')
        ]);

        return response()->json(['msg' => 'Usuario creado.'], 200);
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
        $validator = Validator::make($request->all(), [
            'nombres' => 'string|max:255',
            'apellidos' => 'string|max:255',
            'password' => 'string|min:6|confirmed',
            'rol_id' => 'int',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::find($id);
        $user->nombres= $request->nombres;
        $user->apellidos= $request->apellidos;
        $user->rol_id= $request->rol_id;
        if (!empty($request->password)) {
            $user->password=  Hash::make($request->get('password'));
        }
        $user->save();

        return response()->json($user, 200);
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
