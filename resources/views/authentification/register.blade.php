@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')
<div class="auth-container">
    <form action="{{route('register')}}" method="POST">
        @csrf
        
        <h2>Inscription</h2>
        
        @if($errors->any())
            <div class="error-message">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="mb-3">
            <label for="nom">Nom</label>
            <input type="text" 
                   name="nom" 
                   id="nom" 
                   class="form-control" 
                   value="{{ old('nom') }}"
                   placeholder="Entrez votre nom"
                   required>
        </div>
        
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" 
                   name="email" 
                   id="email" 
                   class="form-control" 
                   value="{{ old('email') }}"
                   placeholder="exemple@email.com"
                   required>
        </div>
        
        <div class="mb-3">
            <label for="password">Mot de passe</label>
            <input type="password" 
                   name="password" 
                   id="password" 
                   class="form-control" 
                   placeholder="Minimum 6 caractères"
                   required>
        </div>
        
        <button type="submit">S'inscrire</button>
        
        <div class="auth-link">
            Vous avez déjà un compte ? 
            <a href="{{route('loginform')}}">Se connecter</a>
        </div>
    </form>
</div>
@endsection