<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginAuthRequest;

class LoginUserController extends Controller
{
    public function authentication(LoginAuthRequest $request){
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            //return redirect()->intended('dashboard');
            return redirect('/dashboard');
        }
        else{
            return response()->json(['message' => 'Credenciais Inválidas'], 401);
        }
    }

    public function getAuthUser(){
        $user = Auth::user();

        return response()->json($user);
    }
}
