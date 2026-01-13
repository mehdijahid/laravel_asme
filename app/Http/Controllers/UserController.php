<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function historique()
    {
        $images = Auth::user()->images()->orderBy('created_at', 'desc')->get();
        return view('user.historique', compact('images'));
    }

    public function deleteImage($id)
    {
        $image = Image::where('id', $id)
                      ->where('utilisateur_id', Auth::id())
                      ->firstOrFail();
        
        // Supprimer le fichier physique
        Storage::disk('public')->delete($image->url);
        
        // Supprimer de la base de données
        $image->delete();
        
        return redirect()->route('user.historique')
                        ->with('success', 'Image supprimée avec succès');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('gemini.index')
                        ->with('success', 'Vous avez été déconnecté avec succès');
    }
}