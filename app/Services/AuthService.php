<?php    

namespace App\Services;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthService {

    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
         $this->authRepository = $authRepository;
    }

    public function register(array $data)
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

    public function login(array $credentials)
    {
        // Verificar as credenciais
        if (!Auth::attempt($credentials)) {
            return null;
        }

        $user = Auth::user();

        // Gerar o token
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $user->currentAccessToken()->delete();
        }
    }

    public function me()
    {
        return Auth::user();
    }
    

}