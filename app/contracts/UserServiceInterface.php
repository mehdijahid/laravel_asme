<?php

namespace App\Contracts;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    /**
     * Afficher le tableau de bord utilisateur
     * 
     * @return \Illuminate\View\View
     */
    public function getDashboard();

    /**
     * Récupérer l'historique des images de l'utilisateur
     * 
     * @return Collection
     */
    public function getUserImages();

    /**
     * Supprimer une image
     * 
     * @param int $imageId
     * @return bool
     */
    public function deleteUserImage(int $imageId): bool;

    /**
     * Déconnecter l'utilisateur
     * 
     * @param Request $request
     * @return void
     */
    public function logoutUser(Request $request): void;
}