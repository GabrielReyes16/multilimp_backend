<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    //Método para logear a un usuario
    public function login (Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'message' => 'Usuario logeado!',
            'token' => $token,
            'user' => Auth::user()
        ]);
    }

        // Método para cerrar sesión
        public function logout()
        {
            Auth::logout();

            return response()->json(['message' => 'Sesión cerrada correctamente']);
        }

        // Método para obtener información del usuario autenticado
        public function me()
        {
            return response()->json(Auth::user());
        }
}
