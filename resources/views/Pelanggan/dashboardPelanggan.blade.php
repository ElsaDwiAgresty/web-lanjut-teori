@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            color: #2F4F4F;
        }

        .btn-primary {
            background-color: #2F4F4F;
            border: none;
        }

        .btn-primary:hover {
            background-color: #465c5c;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            color: #2F4F4F;
        }

        .card-body {
            background-color: #f0f4f8;
        }

        a {
            color: #2F4F4F;
            text-decoration: none;
        }

        a:hover {
            color: #465c5c;
        }
    </style>

    <div class="container py-5">
        <!-- Tampilkan pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('home') }}">
            < Kembali ke Home</a>

                <div class="text-center mb-5">
                    <h1>Halo, {{ $data['nama'] }}!</h1>
                    <p class="text-muted">Selamat datang di dashboard pelanggan.</p>
                    <a href="{{ route('pelanggan.logout') }}" class="btn btn-outline-dark mt-3">Logout</a>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Reservasi Saya</h5>
                                <p class="card-text">Lihat dan kelola reservasi Anda.</p>
                                <a href="{{ route('reservasi.saya') }}" class="btn btn-primary">Lihat Reservasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Profil</h5>
                                <p class="card-text">Lihat dan edit informasi profil Anda.</p>
                                <a href="{{ route('pelanggan.profil') }}" class="btn btn-primary">Profil Saya</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Riwayat Pembelian</h5>
                                <p class="card-text">Cek riwayat pembelian Anda di restoran kami.</p>
                                <a href="" class="btn btn-primary">Lihat Riwayat</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="fw-bold text-center">Ulasan Saya</h5>
                    </div>
                </div>

                <div class="row">
                    @forelse ($ulasanItems as $ulasan)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">Ulasan:</h6>
                                    <p>{{ $ulasan->ulasan }}</p>
                                    @if ($ulasan->balasan)
                                        <div class="alert alert-success mt-3" role="alert">
                                            <strong>Balasan Admin:</strong> {{ $ulasan->balasan }}
                                        </div>
                                    @else
                                        <div class="alert alert-secondary mt-3" role="alert">
                                            <strong>Belum ada balasan dari admin.</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="alert alert-warning text-center">
                                Belum ada ulasan yang Anda buat.
                            </div>
                        </div>
                    @endforelse
                </div>

    </div>


    <div class="row mt-4">
        <div class="col-md-12">
            <h5 class="fw-bold text-center">Ulasan Saya</h5>
        </div>
    </div>

    <div class="row">
        @forelse ($ulasanItems as $ulasan)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Ulasan:</h6>
                        <p>{{ $ulasan->ulasan }}</p>
                        @if($ulasan->balasan)
                            <div class="alert alert-success mt-3" role="alert">
                                <strong>Balasan Admin:</strong> {{ $ulasan->balasan }}
                            </div>
                        @else
                            <div class="alert alert-secondary mt-3" role="alert">
                                <strong>Belum ada balasan dari admin.</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-warning text-center">
                    Belum ada ulasan yang Anda buat.
                </div>
            </div>
        @endforelse
    </div>

</div>


@endsection
