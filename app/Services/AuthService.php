<?php    

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use Exception;

class AuthService {

    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
         $this->authRepository = $authRepository;
    }

    
    public function register(array $data) // Registro de um novo usuário
    {
        // Uso do Hash::make para o bcrypt
        $data['password'] = Hash::make($data['password']);

        // Envio para o repositório salvar o usuário
        $user = $this->authRepository->register($data);

        // Criar o token para o usuário não precisar logar logo após o cadastro
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(array $credentials) // Login do usuário
    {   
        // Tentativa de autenticação
        if (!Auth::attempt($credentials)) {
            return null; 
        }
        


        // Usuário autenticado
        $user = Auth::user();

        if (!$user instanceof User) {
            return null;
        }

        // Gerar token
        $token = $user->createToken('auth_token')->plainTextToken; 

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout()
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            return null;
        }
        
        if ($user) {
            // Deleta todos os tokens do usuário logado
            $user->tokens()->delete();
            return true;
        }

        return false;
    }

    // Retorna o usuário autenticado
    public function me()
    {
        return Auth::user();
    }
    

}