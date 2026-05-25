<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{



public function login(Request $request)
{
  $request->validate([
        'email' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    $user = User::where('email', $request->email)->first();

  /*   if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Usuário ou senha inválidos.'],
        ]);
    }  */

    $token = $user->createToken('app-token')->plainTextToken;



    return response()->json([
        'status' => true,
        'message' => 'Login realizado com sucesso.',
        'token' => $token,
        'user' => $user,
    ]);
}

    public function me(Request $request)
    {
        return response()->json([
            'status' => true,
            'user' => $request->user(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout realizado com sucesso.',
        ]);
    }


        public function teste(Request $request)
    {
        return "teste";
    }

}