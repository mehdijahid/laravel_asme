@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')
<div class="auth-container">
    <form action="{{route('login')}}" method="POST">
        @csrf
        
        <h2>Connexion</h2>
        
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
                   placeholder="Entrez votre mot de passe"
                   required>
        </div>
        
        <button type="submit">Se connecter</button>
        
        <div class="auth-link">
            Pas encore de compte ? 
            <a href="{{route('registerform')}}">S'inscrire</a>
        </div>
    </form>
</div>
@endsection