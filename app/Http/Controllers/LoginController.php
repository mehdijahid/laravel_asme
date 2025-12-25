<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function LoginForm(){
        return view('authentification.login');
    }
    public function Login(Request $request){
        $donnes = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string',
        ]);
        if(Auth::attempt($donnes)){
            $request->session()->regenerate();
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');
        };
         return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect',
        ]);
    }
    public function registerForm()
    {
        return view('authentification.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email|unique:utilisateurs',
            'password' => 'required|min:6'
        ]);

        Utilisateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('loginform');
    }
}
