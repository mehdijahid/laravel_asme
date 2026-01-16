<?php

namespace App\Services;

use App\Contracts\AdminServiceInterface;
use App\Models\Utilisateur;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class AdminService implements AdminServiceInterface
{
    /**
     * Récupérer tous les utilisateurs avec le nombre d'images
     * 
     * @return Collection
     */
    public function getAllUsersWithImageCount(): Collection
    {
        return Utilisateur::withCount('images')->get();
    }

    /**
     * Mettre à jour un utilisateur
     * 
     * @param int $userId
     * @param array $data
     * @return bool
     */
    public function updateUser(int $userId, array $data): bool
    {
        $user = Utilisateur::findOrFail($userId);

        $user->nom = $data['nom'];
        $user->email = $data['email'];
        $user->role = $data['role'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        return $user->save();
    }

    /**
     * Supprimer un utilisateur et ses images
     * 
     * @param int $userId
     * @return bool
     */
    public function deleteUser(int $userId): bool
    {
        $user = Utilisateur::findOrFail($userId);
        $user->images()->delete();
        return $user->delete();
    }
}