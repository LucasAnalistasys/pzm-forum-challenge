<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class AuthRepository {
    public function __construct()
    {
        
    }

    // Registro de um novo usuário
    public function register(array $data)
    {
        return User::create($data);
    }

}   