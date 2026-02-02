<?php

namespace App\Repositories;
use App\Models\User;

class AuthRepository {
    public function __construct()
    {
        
    }

    public function register(array $data)
    {
        return User::create($data);
    }

}   