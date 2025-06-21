<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoacaoController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->tipo_usuario == 1) {
            // Admin: pode ver todas
            $doacoes = Doacao::all();
        } else {
            // Usuário comum: só pode ver as dele (como doador ou recebedor)
            $doacoes = Doacao::where('id_doador', $user->id_usuario)
                        ->orWhere('id_recebedor', $user->id_usuario)
                        ->get();
        }

        return response()->json(['status' => 'success', 'data' => $doacoes]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_doador' => 'required|exists:usuarios,id_usuario',
            'id_recebedor' => 'required|exists:usuarios,id_usuario',
            'id_local' => 'required|exists:locais,id_local',
            'data' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $doacao = Doacao::create($request->all());

        return response()->json(['status' => 'success', 'data' => $doacao]);
    }

    public function show(Request $request, $id)
    {
        $doacao = Doacao::find($id);

        if (!$doacao) {
            return response()->json(['status' => 'error', 'message' => 'Doação não encontrada'], 404);
        }

        $user = $request->user();

        if ($user->tipo_usuario != 1 && $doacao->id_doador != $user->id_usuario && $doacao->id_recebedor != $user->id_usuario) {
            return response()->json(['status' => 'error', 'message' => 'Acesso não autorizado'], 403);
        }

        return response()->json(['status' => 'success', 'data' => $doacao]);
    }



    public function update(Request $request, $id)
    {
        $doacao = Doacao::find($id);
        if (!$doacao) {
            return response()->json(['status' => 'error', 'message' => 'Doação não encontrada'], 404);
        }

        $doacao->update($request->all());

        return response()->json(['status' => 'success', 'data' => $doacao]);
    }

    public function destroy($id)
    {
        $doacao = Doacao::find($id);
        if (!$doacao) {
            return response()->json(['status' => 'error', 'message' => 'Doação não encontrada'], 404);
        }

        $doacao->delete();

        return response()->json(['status' => 'success', 'message' => 'Doação deletada']);
    }
}
