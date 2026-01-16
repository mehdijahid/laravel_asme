<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    /**
     * Afficher le tableau de bord utilisateur
     * 
     * @return \Illuminate\View\View
     */
    public function getDashboard()
    {
        return view('user.dashboard');
    }

    /**
     * Récupérer l'historique des images de l'utilisateur
     * 
     * @return Collection
     */
    public function getUserImages(): Collection
    {
        return Auth::user()->images()->orderBy('created_at', 'desc')->get();
    }

    /**
     * Supprimer une image
     * 
     * @param int $imageId
     * @return bool
     */
    public function deleteUserImage(int $imageId): bool
    {
        $image = Image::where('id', $imageId)
                      ->where('utilisateur_id', Auth::id())
                      ->firstOrFail();
        
        // Supprimer le fichier physique
        Storage::disk('public')->delete($image->url);
        
        // Supprimer de la base de données
        return $image->delete();
    }

    /**
     * Déconnecter l'utilisateur
     * 
     * @param Request $request
     * @return void
     */
    public function logoutUser(Request $request): void
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}