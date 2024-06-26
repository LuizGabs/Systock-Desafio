<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;

class RegisterUserController extends Controller
{
    public function store(UserStoreRequest $request) {

        $user = new User($request->validated());

        if($user->save()){
            return response()->json(['message' => 'Usuário criado com Sucesso'], 201);
        }
    }
    
}
