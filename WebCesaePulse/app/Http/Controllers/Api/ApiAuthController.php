<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Importando o modelo Session

class ApiAuthController extends Controller
{
    /**
     * Realizar o login do usuário na API.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        // Validação dos dados de login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentando autenticar o usuário
        if (Auth::attempt($credentials)) {
            // Usuário autenticado com sucesso
            $request->session()->regenerate();

            $user =Auth::id();
            $session = DB::table('sessions')->where('user_id', Auth::id())
                ->orderBy('last_activity', 'desc')
                ->first();

            // Retornar a resposta com o usuário e dados da sessão
            return response()->json([
                'message' => 'Login bem-sucedido',
                'user' => $user,
                'session' => $session
            ], 200);
        }

        // Se a autenticação falhar
        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    /**
     * Realizar o logout do usuário na API.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Remover a sessão do usuário
        $session = Session::where('user_id', Auth::id())->first();
        if ($session) {
            $session->delete();
        }

        // Fazer logout do usuário
        Auth::logout();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
