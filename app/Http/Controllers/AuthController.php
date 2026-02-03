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

    // Registro de um novo usuário
    public function register(RegisterRequest $request) 
    {        
        $response = $this->authService->register($request->validated());
        return response()->json($response, 201);
    }

    // Login do usuário
    public function login(Request $request)
    {
        $result = $this->authService->login($request->only('email', 'password'));

        if (!$result) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json($result); 
    }

    // Logout do usuário
    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'Token revogado com sucesso e logout realizado.']);
    }

    // Retorna o usuário autenticado
    public function me(Request $request)
    {
        return response()->json($this->authService->me());
    }

    
}
