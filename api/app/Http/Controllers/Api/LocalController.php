<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success', 'data' => Local::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'bairro' => 'required|string',
            'rua' => 'required|string',
            'numero' => 'required|integer'
        ]);

        $local = Local::create($request->all());

        return response()->json(['status' => 'success', 'data' => $local]);
    }

    public function show($id)
    {
        $local = Local::find($id);
        if (!$local) {
            return response()->json(['status' => 'error', 'message' => 'Local não encontrado'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $local]);
    }

    public function update(Request $request, $id)
    {
        $local = Local::find($id);
        if (!$local) {
            return response()->json(['status' => 'error', 'message' => 'Local não encontrado'], 404);
        }

        $local->update($request->all());

        return response()->json(['status' => 'success', 'data' => $local]);
    }

    public function destroy($id)
    {
        $local = Local::find($id);
        if (!$local) {
            return response()->json(['status' => 'error', 'message' => 'Local não encontrado'], 404);
        }

        $local->delete();

        return response()->json(['status' => 'success', 'message' => 'Local deletado']);
    }
}
