<?php

namespace App\Services;

use App\Contracts\AuthServiceInterface;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    /**
     * Authentifier un utilisateur
     * 
     * @param array $credentials
     * @param Request $request
     * @return bool
     */
    public function authenticate(array $credentials, Request $request): bool
    {
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return true;
        }
        
        return false;
    }

    /**
     * Enregistrer un nouvel utilisateur
     * 
     * @param array $data
     * @return bool
     */
    public function register(array $data): bool
    {
        $user = Utilisateur::create([
            'nom' => $data['nom'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        return $user ? true : false;
    }

    /**
     * Vérifier si l'utilisateur est admin
     * 
     * @return bool
     */
    public function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }
}