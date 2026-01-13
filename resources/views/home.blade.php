@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"> <!-- Add your custom CSS if needed -->
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Bienvenue sur AsmeVision</h1>
                <p>Une plateforme d'analyse d'images alimentée par Gemini AI. Connectez-vous pour commencer à analyser vos images.</p>
                <a href="{{ route('loginform') }}" class="btn btn-primary">Se connecter</a>
                <a href="{{ route('registerform') }}" class="btn btn-secondary ml-2">S'inscrire</a>
            </div>
        </div>
    </div>
@endsection