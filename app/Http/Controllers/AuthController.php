<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // Registrar um novo usuário
    public function register(Request $request)
    {
        $data = $request->all();
        $result = $this->authService->register($data);
        return response()->json($result);
    }

    // Realizar login
    public function login(Request $request)
    {
        $data = $request->all();
        $result = $this->authService->login($data);
        return response()->json($result);
    }

    // Realizar logout
    public function logout()
    {
        $result = $this->authService->logout();
        return response()->json($result);
    }
}
