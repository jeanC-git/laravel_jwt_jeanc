<?php

namespace App\Http\Controllers;


    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Email y/o contraseña inválidos'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo crear token'], 500);
        }
        $token = auth()->claims(['name' => auth()->user()->name])->attempt($credentials);
        $user = User::where('email',$credentials['email'])->first();
        $user->token = $token;
        $user->nombreRol = $user->rol->nombreRol;
        $user->permisos = $user->rol->permisos;

        return response()->json(compact('user'));
    }
    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expirado'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalido'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['no_token'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }
    public function register(Request $request)
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
            'rol_id' => $request->rol_id
        ]);

        return response()->json(compact('user'),201);
    }
}
