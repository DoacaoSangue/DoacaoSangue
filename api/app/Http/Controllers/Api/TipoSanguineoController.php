<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoSanguineo;

class TipoSanguineoController extends Controller
{
    public function index()
    {
        $tipos = TipoSanguineo::all();
        return response()->json(['status' => 'success', 'data' => $tipos]);
    }
}
