@extends('layouts.app')

@section('style')
    <style>
        .hero-section {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            
          
        }


        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #ffffff 0%, #ffd000 50%, #ffffff 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 2px;
        }
        .hero-content p {
            font-size: 1.3rem;
            color: #e0e0e0;
            margin-bottom: 40px;
            line-height: 1.8;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            overflow: hidden;
            letter-spacing: 1px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-custom::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-custom:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #ffd000 0%, #ffdb33 100%);
            color: #000000;
            box-shadow: 0 5px 20px rgba(255, 208, 0, 0.3);
        }

        .btn-primary-custom::before {
            background: rgba(255, 255, 255, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 30px rgba(255, 208, 0, 0.5);
            color: #000000;
        }

        .btn-secondary-custom {
            background: transparent;
            color: #ffd000;
            border: 2px solid #ffd000;
            box-shadow: 0 5px 20px rgba(255, 208, 0, 0.2);
        }

        .btn-secondary-custom::before {
            background: #ffd000;
        }

        .btn-secondary-custom:hover {
            transform: translateY(-5px) scale(1.05);
            color: #000000;
            box-shadow: 0 10px 30px rgba(255, 208, 0, 0.4);
        }

        .btn-custom i {
            transition: transform 0.3s ease;
        }

        .btn-custom:hover i {
            transform: translateX(5px);
        }

        /* Animation d'apparition */
        .hero-content h1,
        .hero-content p,
        .hero-buttons {
            animation: fadeInUp 1s ease-out;
        }

        .hero-content p {
            animation-delay: 0.2s;
        }

        .hero-buttons {
            animation-delay: 0.4s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .btn-custom {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="hero-section">
        <div class="hero-content">
            <h1>Bienvenue sur AsmeVision</h1>
            <p>Une plateforme d'analyse d'images alimentée par Gemini AI. Connectez-vous pour commencer à analyser vos images.</p>
            <div class="hero-buttons">
                <a href="{{ route('loginform') }}" class="btn-custom btn-primary-custom">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Se connecter
                </a>
                <a href="{{ route('registerform') }}" class="btn-custom btn-secondary-custom">
                    <i class="bi bi-person-plus-fill"></i>
                    S'inscrire
                </a>
            </div>
        </div>
    </div>
@endsection