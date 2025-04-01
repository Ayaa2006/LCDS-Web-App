@extends('layouts.app')

@section('contents')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-muted">Galeries</h1>
        <a href="{{ route('galeries.create') }}" class="btn btn-success">Créer une nouvelle galerie</a>
    </div>

    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">

    <!-- Swiper.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <style>
        .main-content {
            padding: 20px;
            background: #f8f9fa;
        }

        .swiper-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .swiper-wrapper {
            display: flex;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            box-sizing: border-box;
        }

        .card {
            width: 100%;
            max-width: 340px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-bottom: 2px solid #e9ecef;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #343a40;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10;
            font-size: 1.5rem;
        }

        .swiper-button-next {
            right: 15px;
        }

        .swiper-button-prev {
            left: 15px;
        }

        .swiper-pagination {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
        }

        .swiper-pagination-bullet {
            background: #343a40;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .swiper-pagination-bullet-active {
            background: #007bff;
        }

        .btn-warning {
            margin-right: 5px;
        }
    </style>

    <div class="main-content">
        <!-- Swiper Slider -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($galeries as $galerie)
                    <div class="swiper-slide">
                        <div class="card">
                            <img src="{{ asset('storage/' . $galerie->img) }}" class="card-img-top" alt="{{ $galerie->titre }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $galerie->titre }}</h5>
                                <p class="card-text">{{ $galerie->description }}</p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('galeries.edit', $galerie->id) }}" class="btn btn-warning">Modifier</a>
                                    <!-- Delete Form -->
                                    <form action="{{ route('galeries.destroy', $galerie->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette galerie ?')">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next">→</div>
            <div class="swiper-button-prev">←</div>
        </div>
    </div>

    <!-- Initialize Swiper -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 'auto',
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
            });
        });
    </script>
@endsection
