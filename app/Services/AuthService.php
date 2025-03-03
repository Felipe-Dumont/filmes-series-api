<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function __construct(
        protected User $user
    )
    {}

    // Método para registrar um novo usuário
    public function register(array $data): User
    {
        $user = $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    // Método para fazer login de um usuário
    public function login(array $data): array
    {
        $validator = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return ['user' => Auth::user()];
        }

        return ['errors' => 'Invalid credentials'];
    }

    // Método para fazer logout
    public function logout(): array
    {
        Auth::logout();
        return ['message' => 'Logged out successfully'];
    }
}
