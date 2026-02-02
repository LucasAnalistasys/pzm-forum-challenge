<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService; 
use App\Http\Requests\RegisterRequest; 

class AuthController extends Controller
{   

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request) 
    {        
        $response = $this->authService->register($request->validated());
        return response()->json($response);
    }

    public function login(Request $request)
    {
        $result = $this->authService->login($request->only('email', 'password'));

        if (!$result) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json($result); 
    }

    public function logout()
    {
        $this->authService->logout();

        return response()->json([
            'message' => 'Token revogado com sucesso e logout realizado.'
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($this->authService->me());
    }

    public function forgotPassword(RegisterRequest $request)
    {
        $this->authService->forgotPassword($request->only('email'));

        return response()->json([
            'message' => 'Se o e-mail existir, um link de redefinição de senha foi enviado.'
        ]);
    }

    public function resetPassword(Request $request)
    {
        $this->authService->resetPassword($request->only('token', 'email', 'password', 'password_confirmation'));

        return response()->json([
            'message' => 'Senha redefinida com sucesso.'
        ]);
    }
}
