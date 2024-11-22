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
    <a href="{{ route('home') }}">< Kembali ke Home</a>

    <div class="text-center mb-5">
        <h1>Selamat Datang, Admin!</h1>
        <p class="text-muted">Kelola semua data dan aktivitas dengan mudah di dashboard admin.</p>
        <a href="{{ route('pelanggan.logout') }}" class="btn btn-outline-dark mt-3">Logout</a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Kelola Menu</h5>
                    <p class="card-text">Tambah, edit, dan hapus menu makanan.</p>
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-primary">Lihat Menu</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Kelola Pelanggan</h5>
                    <p class="card-text">Lihat dan kelola data pelanggan.</p>
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-primary">Kelola Pelanggan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Reservasi</h5>
                    <p class="card-text">Pantau dan atur reservasi pelanggan.</p>
                    <a href="{{ route('admin.reservasi.index') }}" class="btn btn-primary">Kelola Reservasi</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Laporan</h5>
                    <p class="card-text">Lihat laporan penjualan dan aktivitas lainnya.</p>
                    <a href="#" class="btn btn-primary">Lihat Laporan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
