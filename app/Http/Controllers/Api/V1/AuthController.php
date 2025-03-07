<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse{
        if(! Auth::attempt($request->validated())){
            return response()->json([
                'errors' => 'Credenciales incorrectas.'
            ], 401);
        }
        $user = $request->user();
        $userToken = $user->createToken('AppToken')->plainTextToken;

        return response()->json([
            'message' => 'Se ha iniciado sesión correctamente!.',
            'token' => $userToken,
            'user' => $user
        ]);
    }
}
