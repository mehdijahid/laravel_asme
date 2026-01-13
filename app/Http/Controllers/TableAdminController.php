<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Hash;

class TableAdminController extends Controller
{
    /**
     * Afficher la liste des utilisateurs
     */
 public function index()
{
    $userstable = Utilisateur::withCount('images')->get();
     $images = Image::all(); 
    return view('admin.tables', compact('userstable'));
}

    /**
     * Mettre à jour un utilisateur
     */
    public function update(Request $request, $id)
    {
        $user = Utilisateur::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,' . $id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.tables')->with('success', 'Utilisateur modifié avec succès !');
    }

    /**
     * Supprimer un utilisateur
     */
   public function destroy($id)
           {
    $user = Utilisateur::findOrFail($id);
    $user->images()->delete(); // Delete related images
    $user->delete();
    return redirect()->route('admin.tables')->with('success', 'Utilisateur supprimé avec succès !');
} }