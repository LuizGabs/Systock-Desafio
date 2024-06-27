<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    public function listUsers(){
        $users = User::orderBy('id')->get();

        return response()->json($users, 200);
    }

    public function edit(string $id){
        if(!$user = User::find($id)){
            return response()->json(['message' => 'Usuário não encontrado'], 403);
        }

        return Inertia::render('EditUser', [
            'user' => $user
        ]);
    }

    public function update(UserEditRequest $request, string $id){
        if(!$user = User::find($id)){
            return response()->json(['message' => 'Usuário não encontrado'], 403);
        }

        $data = $request->only('name', 'email', 'cpf');
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        if($request->phone){
            $data['phone'] = $request->phone;
        }
        $user->update($data);
        return response()->json(['message' => 'Usuário atualizado com sucesso',], 201);
    }

    public function show(string $id){
        if(!$user = User::find($id)){
            return response()->json(['message' => 'Usuário não encontrado'], 403);
        }

        return Inertia::render('ShowUser', [
            'user' => $user
        ]);
    }

    public function delete(string $id){
        if(!$user = User::find($id)){
            return response()->json(['message' => 'Usuário não encontrado'], 403);
        }

        if(Auth::user()->id === $user->id){
            return response()->json(['message' => 'Você não pode deletar o seu próprio usuário'], 405);
        }
        $user->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso'], 201);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
