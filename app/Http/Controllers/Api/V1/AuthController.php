<?php

namespace app\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $user = Auth::attempt($credentials);

        if ($user) {
            $user = Auth::user();

            $token = $user->createToken('jwt', ['create', 'update', 'delete'])->plainTextToken;

            return response()->json(['jwt' => $token], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    public function getUser(Request $request) {
        $user = $request->user(); // Récupère l'utilisateur authentifié

        return response()->json(['user' => $user], 200);
    }
}
