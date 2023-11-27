<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Lógica para exibir a lista de usuários
    }

    public function create()
    {
        // Lógica para exibir o formulário de criação de usuários
    }

    public function store(Request $request)
    {
        // Validar os dados enviados pelo formulário
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Criar um novo usuário com os dados validados
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Redirecionar para uma página com uma mensagem de sucesso
        return redirect()->route('home')->with('success', 'Usuário criado com sucesso!');
    }

    public function show($id)
    {
        // Lógica para exibir um usuário específico
    }

    public function edit($id)
    {
        // Lógica para exibir o formulário de edição de um usuário
    }

    public function update(Request $request, $id)
    {
        // Lógica para processar o formulário de edição de um usuário
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'Usuário excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o usuário'], 500);
        }
    }
}
