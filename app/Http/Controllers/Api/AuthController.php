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
                    'nome_horta' => $data['nome_horta'],
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



    public function update(Request $request)
{
    $user = $request->user(); #pega o usuario de jeito

    $rules = [
        'nome' => 'sometimes|string|max:255',
        'telefone' => 'sometimes|string|max:15',
        'datanasc' => 'sometimes|date',
        'foto' => 'nullable|string',
        'banner' => 'nullable|string',
    ];

    if ($user->Tipo_usuario === 'produtor') { #se for produtor tbm tem essas coisinhas bacanas
        $rules['nome_horta'] = 'sometimes|string|max:255';
        $rules['frete'] = 'sometimes|numeric|min:0';
    }

    $data = $request->validate($rules);

    DB::transaction(function () use ($user, $data) {

        $user->update([
            'nome' => $data['nome'] ?? $user->nome,
            'telefone' => $data['telefone'] ?? $user->telefone,
            'datanasc' => $data['datanasc'] ?? $user->datanasc,
            'foto' => $data['foto'] ?? $user->foto,
            'banner' => $data['banner'] ?? $user->banner,
        ]);

        if ($user->Tipo_usuario === 'produtor' && ($user->hortas ?? false)) {
            $user->hortas->update([
                'nome_horta' => $data['nome_horta'] ?? $user->hortas->nome_horta,
                'frete' => $data['frete'] ?? $user->hortas->frete,
            ]);
        }
    });

    return response()->json([
        'message' => 'Dados atualizados com sucesso',
        'user' => $user->load('hortas'), 
    ]);
}





    

}
