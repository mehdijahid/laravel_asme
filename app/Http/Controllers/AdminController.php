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
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function logout(Request $request)
{
    Auth::guard('web')->logout();  // or 'admin' if you have a separate guard
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(' /');
}

}
