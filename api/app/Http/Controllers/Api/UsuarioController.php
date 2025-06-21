<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->tipo_usuario != 1) {
            return response()->json(['status' => 'error', 'message' => 'Acesso não autorizado'], 403);
        }

        $usuarios = Usuario::all();
        return response()->json(['status' => 'success', 'data' => $usuarios]);
    }


    public function store(Request $request)
    {
        if ($request->user()->tipo_usuario != 1) {
            return response()->json(['status' => 'error', 'message' => 'Acesso não autorizado'], 403);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:usuarios,email',
            'nome' => 'required|string|max:100',
            'senha' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string',
            'id_tipo_sanguineo' => 'nullable|exists:tipos_sanguineos,id_tipo',
            'alergias' => 'nullable|string',
            'tipo_usuario' => 'nullable|in:0,1',
            'doar' => 'nullable|boolean',
            'receber' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $usuario = Usuario::create([
            'email' => $request->email,
            'nome' => $request->nome,
            'senha' => bcrypt($request->senha),
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'id_tipo_sanguineo' => $request->id_tipo_sanguineo,
            'alergias' => $request->alergias,
            'tipo_usuario' => $request->tipo_usuario ?? 0,
            'doar' => $request->doar ?? false,
            'receber' => $request->receber ?? false,
        ]);

        return response()->json(['status' => 'success', 'data' => $usuario]);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();

        if ($user->tipo_usuario != 1 && $user->id_usuario != $id) {
            return response()->json(['status' => 'error', 'message' => 'Acesso não autorizado'], 403);
        }

        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['status' => 'error', 'message' => 'Usuário não encontrado'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $usuario]);
    }



    public function update(Request $request, $id)
    {
        if ($request->user()->tipo_usuario != 1) {
            return response()->json(['status' => 'error', 'message' => 'Acesso não autorizado'], 403);
        }

        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['status' => 'error', 'message' => 'Usuário não encontrado'], 404);
        }

        $usuario->update($request->except('senha'));

        if ($request->filled('senha')) {
            $usuario->senha = bcrypt($request->senha);
            $usuario->save();
        }

        return response()->json(['status' => 'success', 'data' => $usuario]);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->tipo_usuario != 1) {
            return response()->json(['status' => 'error', 'message' => 'Acesso não autorizado'], 403);
        }
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['status' => 'error', 'message' => 'Usuário não encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['status' => 'success', 'message' => 'Usuário deletado']);
    }
}
