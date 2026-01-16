<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
class AdminController extends Controller
{
    public function index()
    {
        $users = Utilisateur::where('role', 'user')->count();
        $admins = Utilisateur::where('role', 'admin')->count();
        $images = Image::count();
       
        return view('admin.dashboard', compact('users', 'admins','images'));
    }
    
    public function logout(Request $request)
{
    Auth::guard('web')->logout();  
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(' /');
}

}
