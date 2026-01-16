<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface AuthServiceInterface
{
    /**
     * Authentifier un utilisateur
     * 
     * @param array $credentials
     * @param Request $request
     * @return bool
     */
    public function authenticate(array $credentials, Request $request): bool;

    /**
     * Enregistrer un nouvel utilisateur
     * 
     * @param array $data
     * @return bool
     */
    public function register(array $data): bool;

    /**
     * Vérifier si l'utilisateur est admin
     * 
     * @return bool
     */
    public function isAdmin(): bool;
}