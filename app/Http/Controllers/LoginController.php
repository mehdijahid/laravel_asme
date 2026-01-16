<?php

namespace App\Http\Controllers;

use App\Contracts\AuthServiceInterface;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function LoginForm()
    {
        return view('authentification.login');
    }

    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($this->authService->authenticate($credentials, $request)) {
            if ($this->authService->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ]);
    }

    public function registerForm()
    {
        return view('authentification.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email|unique:utilisateurs',
            'password' => 'required|min:6'
        ]);

        $this->authService->register($request->only(['nom', 'email', 'password']));
        
        return redirect()->route('loginform');
    }
}