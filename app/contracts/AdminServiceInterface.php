<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface AdminServiceInterface
{
    /**
     * Récupérer tous les utilisateurs avec le nombre d'images
     * 
     * @return Collection
     */
    public function getAllUsersWithImageCount(): Collection;

    /**
     * Mettre à jour un utilisateur
     * 
     * @param int $userId
     * @param array $data
     * @return bool
     */
    public function updateUser(int $userId, array $data): bool;

    /**
     * Supprimer un utilisateur et ses images
     * 
     * @param int $userId
     * @return bool
     */
    public function deleteUser(int $userId): bool;
}