<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:usuarios,email',
            'nome' => 'required|string|max:100',
            'senha' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',    // Letra maiúscula
                'regex:/[a-z]/',    // Letra minúscula
                'regex:/[0-9]/',    // Número
                'regex:/[@$!%*#?&]/' // Caractere especial
            ],
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string',
            'tipo_usuario' => 'required|in:0,1', // 0 = comum, 1 = admin
            'doar' => 'required|boolean',
            'receber' => 'required|boolean',
            'id_tipo_sanguineo' => 'required|exists:tipos_sanguineos,id_tipo',
            'alergias' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $user = Usuario::create([
            'email' => $request->email,
            'nome' => $request->nome,
            'senha' => bcrypt($request->senha),
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'tipo_usuario' => $request->tipo_usuario,
            'doar' => $request->doar,
            'receber' => $request->receber,
            'id_tipo_sanguineo' => $request->id_tipo_sanguineo,
            'alergias' => $request->alergias,
        ]);

        return response()->json(['status' => 'success', 'data' => $user]);
    }


    public function login(Request $request)
    {
        $user = Usuario::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->senha, $user->senha)) {
            return response()->json(['status' => 'error', 'message' => 'Credenciais inválidas'], 401);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json(['status' => 'success', 'token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['status' => 'success', 'message' => 'Logout realizado']);
    }
}
