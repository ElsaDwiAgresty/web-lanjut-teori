@extends('layouts.app')

@section('content')
    <style>
        /* Navbar styling */
        .navbar-custom {
            background-color: #2F4F4F;
            /* Warna biru untuk navbar */
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #fff;
        }

        .navbar-custom .nav-link:hover {
            color: #ffc107;
        }

        /* Styling untuk kartu menu */
        .menu-card {
            width: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: auto;
            padding: 10px;
        }

        .menu-card img {
            height: 120px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-header .menu-card .card-body {
            padding: 10px;
            text-align: center;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        /* Button styling */
        .btn-primary {
            background-color: #2F4F4F;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Style untuk informasi tipe reservasi */
        .reservasi-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .reservasi-info h4 {
            font-size: 1.25rem;
            color: #2F4F4F;
            margin-bottom: 10px;
        }

        .reservasi-info ul {
            list-style: none;
            padding: 0;
        }

        .reservasi-info li {
            margin-bottom: 5px;
        }

        /* New styles */
        h3,
        h4 {
            font-family: 'Arial', sans-serif;
            /* Mengubah font untuk judul */
            margin-bottom: 20px;
        }

        .reservasi-info {
            margin-bottom: 40px;
            /* Memberi jarak antara waktu reservasi dan menu */
        }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <img src="img/Logo.png" alt="Logo" style="width: 10%; height: 10%;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @if (session('id_pelanggan'))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ session('role') == 'pelanggan' ? route('pelanggan.dashboard') : route('admin.dashboard') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                </svg>
                                {{ $user['nama'] }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.registrasi') }}">Signup</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container my-4">
        <div class="mb-5">
            <a href="{{ route('home') }}">< Kembali ke Home</a>
        </div>
        <h1 class="text-center mb-4">Ulasan</h1>
        @if (session('id_pelanggan') && session('role') == 'pelanggan')
            <form action="{{ route('pelanggan.ulasan.store') }}" method="POST">
                @csrf
                <textarea name="ulasan" class="form-control" id="ulasan" placeholder="Tulis ulasan di sini" required></textarea>
                <button type="submit" class="btn btn-primary my-4">Kirim</button>
            </form>
        @else
            <div class="my-4">
                <a class="text-center my-4" href="{{ route('pelanggan.login') }}">Silakan login sebagai pelanggan terlebih
                    dahulu untuk membuat
                    ulasan.</a>
            </div>
        @endif
        @foreach ($reviews as $review)

            <div class="row mb-4">
                <div class="card">
                    <div class="card-header">
                        {{ $review->pelanggan->nama }}
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>{{ $review->ulasan }}</p>
                        </blockquote>
                    </div>

            <div class="card mb-4">
                <div class="card-header">
                    {{ $review->pelanggan->nama }}
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ $review->ulasan }}</p>
                        @if($review->balasan)
                            <footer class="blockquote-footer text-primary">
                                Admin: {{ $review->balasan }}
                            </footer>
                        @endif
                    </blockquote>

                </div>
            </div>
        @endforeach
    </div>
@endsection
