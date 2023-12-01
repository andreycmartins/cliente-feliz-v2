<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return response()->json([
            'data' => $user
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Redirecionar para uma página com uma mensagem de sucesso
        return redirect()->route('home')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        try{

            if (!$id) {
                return ['error' => true, 'message' => "ID do usuário não informado"];
            }

            $user = User::FindOrFail($id);

            return response()->json([
                'error' => false,
                'dados' => $user
            ]);

        } catch(Exception $e) {

            return response()->json([
                'error' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request)
    {
        try{
            
            if (!$request->id) {
                return ['error' => true, 'message' => "ID do cliente não informado!"];
            }

            User::FindOrFail($request->id)->update($request->all());

            return response()->json([
                'error' => false,
                'dados' => 'Usuario editado com sucesso',
            ]);

        } catch(Exception $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);

        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'Usuário excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o usuário'], 500 + $e);
        }
    }
}
