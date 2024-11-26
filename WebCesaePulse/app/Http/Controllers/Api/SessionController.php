<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Session;

class SessionController extends Controller
{
    /**
     * Exibir uma sessão específica.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = Session::find($id);

        if (!$session) {
            return response()->json(['message' => 'Sessão não encontrada'], 404);
        }

        return response()->json($session);
    }
}
