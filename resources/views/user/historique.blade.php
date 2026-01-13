@extends('layouts.userapp')

@section('style')
<link rel="stylesheet" href="{{ asset('css/historique.css') }}">
@endsection

@section('content')
<div class="historique-container">
    <h1 class="historique-title">Mon Historique d'Analyses</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Succès!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erreur!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($images->count() > 0)
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($images as $image)
                    <div class="swiper-slide">
                        <div class="slide-content">
                            <div class="image-section">
                                <img src="{{ asset('storage/' . $image->url) }}" alt="{{ $image->name }}">
                            </div>
                            <div class="description-section">
                                <div class="description-content">
                                    <h3>Description</h3>
                                    <p>{{ $image->description }}</p>
                                    
                                    <div class="image-meta">
                                        <small><strong>Nom:</strong> {{ $image->name }}</small>
                                        <small><strong>Date:</strong> {{ $image->created_at->format('d/m/Y à H:i') }}</small>
                                    </div>
                                </div>

                                <div class="action-buttons">
                                    <form action="{{ route('user.deleteImage', $image->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-images"></i>
            <h3>Aucune image analysée</h3>
            <p>Commencez par analyser votre première image depuis le dashboard</p>
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-3">Analyser une image</a>
        </div>
    @endif
</div>

@if($images->count() > 0)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.mySwiper', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Confirmation de suppression avec alert
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Êtes-vous sûr de vouloir supprimer cette image ? Cette action est irréversible.')) {
                    this.submit();
                }
            });
        });
    });
</script>
@endif
@endsection