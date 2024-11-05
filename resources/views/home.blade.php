@extends('layouts.app')

@section('content')
    <style>
        /* Navbar styling */
        .navbar-custom {
            background-color: #2F4F4F; /* Warna biru untuk navbar */
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
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .menu-card img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .menu-card .card-body {
            padding: 15px;
            text-align: center;
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
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <img src="img\Logo.png" alt="" style="width: 10%; height: 10%;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pelanggan.registrasi') }}">Signup</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.dashboard') }}">Dashboard</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <!-- <div class="reservasi-info">
            <h4>Informasi Tipe Reservasi dan Jumlah Kursi Kosong:</h4>
            <ul>
                @foreach ($reservasiInfo as $info)
                    <li><strong>{{ $info['tipe'] }}:</strong> {{ $info['kursi_kosong'] }} kursi kosong</li>
                @endforeach
            </ul>
        </div> -->

    <div class="container my-4">
        <h1 class="text-center mb-4">Selamat Datang di Restoran Kami!</h1>
        
        <div class="row mb-5">
            <div class="col-md-6">
                <h3>Informasi Restoran</h3>
                <p>
                    Selamat datang di restoran kami, tempat yang sempurna untuk menikmati makanan lezat bersama teman dan keluarga.
                    Kami menawarkan berbagai hidangan yang terbuat dari bahan berkualitas tinggi dan disiapkan oleh chef berpengalaman.
                </p>
                <p>
                    Untuk reservasi, silakan klik tombol di bawah ini untuk memulai proses reservasi Anda.
                </p>
                <a href="{{ route('pelanggan.reservasi') }}" class="btn btn-primary">Buat Reservasi</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/restoran.jpg') }}" alt="Foto Restoran" class="img-fluid rounded" style="width: 100%; height: auto;">
            </div>
        </div>

        <div class="my-4">
            <h3>Menu Spesial Hari Ini</h3>
            <div class="row">
                @foreach ($menuItems as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card menu-card">
                            <img src="{{ asset($item->foto_menu) }}" class="card-img-top" alt="{{ $item->nama_menu }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_menu }}</h5>
                                <p class="card-text">Rp{{ number_format($item->harga_menu, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
