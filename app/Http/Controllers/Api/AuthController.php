<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Horta;
use App\Models\Pedido;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario', // observar esse unique aqui
            'telefone' => 'required|string|max:15',
            'datanasc' => 'required|date',
            'foto' => 'nullable|string',
            'banner' => 'nullable|string',
            'password' => ['required', 'confirmed', Password::defaults()],
            'Tipo_usuario' => 'required|in:consumidor,produtor', // <- mudou

            // Campos apenas para produtores
            'nome_horta' => 'required_if:Tipo_usuario,produtor|string|max:255',
            'frete' => 'required_if:Tipo_usuario,produtor|numeric|min:0',
        ]);


        $user = DB::transaction(function () use ($data) { #se alguma parte falhar não salva no banco de dados

            $user = User::create([
                'nome' => $data['nome'],
                'email' => $data['email'],
                'Tipo_usuario' => $data['Tipo_usuario'], // <- mudou
                'telefone' => $data['telefone'],
                'datanasc' => $data['datanasc'],
                'foto' => $data['foto'] ?? null,
                'banner' => $data['banner'] ?? null,
                'password' => bcrypt($data['password']),
            ]);

            if ($data['Tipo_usuario'] === 'produtor') {
                Horta::create([
                    'nome_horta' => $data['NomeHorta'],
                    'frete' => $data['frete'],
                    'fk_usuario_id' => $user->id,
                ]);
            }

            return $user;
        });
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }




    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout realizado']);
    }

}
