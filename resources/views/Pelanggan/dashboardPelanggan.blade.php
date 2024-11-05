@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Halo, !</h1>
        <p>Selamat datang di dashboard pelanggan.</p>

        <!-- Contoh konten dashboard -->
        <div class="row my-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reservasi Saya</h5>
                        <p class="card-text">Lihat dan kelola reservasi Anda.</p>
                        <a href="{{ route('pelanggan.reservasi') }}" class="btn btn-primary">Lihat Reservasi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Profil</h5>
                        <p class="card-text">Lihat dan edit informasi profil Anda.</p>
                        <a href="" class="btn btn-primary">Profil Saya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Pembelian</h5>
                        <p class="card-text">Cek riwayat pembelian Anda di restoran kami.</p>
                        <a href="" class="btn btn-primary">Lihat Riwayat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
