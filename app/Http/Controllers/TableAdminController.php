<?php

namespace App\Http\Controllers;

use App\Contracts\AdminServiceInterface;
use Illuminate\Http\Request;

class TableAdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Afficher la liste des utilisateurs
     */
    public function index()
    {
        $userstable = $this->adminService->getAllUsersWithImageCount();
        return view('admin.tables', compact('userstable'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email,' . $id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $this->adminService->updateUser($id, $request->only(['nom', 'email', 'role', 'password']));

        return redirect()->route('admin.tables')->with('success', 'Utilisateur modifié avec succès !');
    }

    /**
     * Supprimer un utilisateur
     */
    public function destroy($id)
    {
        $this->adminService->deleteUser($id);
        return redirect()->route('admin.tables')->with('success', 'Utilisateur supprimé avec succès !');
    }
}