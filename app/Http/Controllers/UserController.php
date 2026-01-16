<?php

namespace App\Http\Controllers;

use App\Contracts\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function dashboard()
    {
        return $this->userService->getDashboard();
    }

    public function historique()
    {
        $images = $this->userService->getUserImages();
        return view('user.historique', compact('images'));
    }

    public function deleteImage($id)
    {
        $this->userService->deleteUserImage($id);
        
        return redirect()->route('user.historique')
                        ->with('success', 'Image supprimée avec succès');
    }

    public function logout(Request $request)
    {
        $this->userService->logoutUser($request);
        
        return redirect()->route('gemini.index')
                        ->with('success', 'Vous avez été déconnecté avec succès');
    }
}