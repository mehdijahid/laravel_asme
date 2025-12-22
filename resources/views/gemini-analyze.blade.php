@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('css/home_gemini.css') }}">
@endsection


@section('content')

    <style>
        .result {
            padding: 20px;
            background: #000000;
            margin: 20px 0;
            border-radius: 5px;
            color:white;
            border: 1px solid yellow;
        }
        .error {
            padding: 20px;
            background: #ffcccc;
            margin: 20px 0;
            border-radius: 5px;
            border: 1px solid #f44336;
            color: red;
        }
    </style>
    <div class="gemini-container">
    <h1>Test Gemini Image Analysis</h1>
    
    @if(isset($error))
        <div class="error">
            <strong>Erreur:</strong> {{ $error }}
        </div>
    @endif

    @if(isset($result))
        <div class="result">
            <h2>Résultat de l'analyse:</h2>
            @if(isset($result['candidates'][0]['content']['parts'][0]['text']))
                <p>{{ $result['candidates'][0]['content']['parts'][0]['text'] }}</p>
            @else
                <pre>{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>
            @endif
        </div>
    @endif

    <form action="{{ route('gemini.analyze') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Analyser l'image</button>
    </form>
    </div>
@endsection
