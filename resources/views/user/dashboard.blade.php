@extends('layouts.userapp')
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
        .image-preview {
            margin: 20px 0;
            text-align: center;
        }
        .image-preview img {
            max-width: 100%;
            max-height: 100px;
            border-radius: 10px;
            border: 2px solid yellow;
        }
        .image-preview-title {
            color: yellow;
            margin-bottom: 10px;
            font-size: 18px;
        }
    </style>
    <div class="gemini-container">
    <h1>Test Gemini Image Analysis</h1>
    
    <!-- Aperçu de l'image sélectionnée -->
    <div class="image-preview" id="imagePreview" style="display: none;">
        <h3 class="image-preview-title">Image sélectionnée :</h3>
        <img id="preview" src="" alt="Aperçu de l'image">
    </div>

    @if(session('error'))
        <div class="error">
            <strong>Erreur:</strong> {{ session('error') }}
        </div>
    @endif

    @if(session('result'))
        <div class="result">
            <h2>Résultat de l'analyse:</h2>
            @php
                $result = session('result');
            @endphp
            @if(isset($result['candidates'][0]['content']['parts'][0]['text']))
                <p>{{ $result['candidates'][0]['content']['parts'][0]['text'] }}</p>
            @else
                <pre>{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>
            @endif
        </div>
    @endif

    <form action="{{ route('gemini.analyze') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" id="imageInput" accept="image/*" required>
        <button type="submit">Analyser l'image</button>
    </form>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
