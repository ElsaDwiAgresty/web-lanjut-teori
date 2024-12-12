@extends('layouts.app')
@section('content')

<style>
    /* Tampilan untuk container utama */
    .container {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Tampilan untuk judul */
    h1, h3 {
        color: #333;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Form Label */
    .form-label {
        font-weight: bold;
        color: #555;
    }

    /* Input dan Select */
    .form-control {
        border-radius: 6px;
        padding: 10px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Tombol utama */

    .btn-primary {
        background-color: #2F4F4F;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Kartu menu */
    .menu-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        transition: box-shadow 0.3s ease;
    }

    .menu-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    /* Kontrol jumlah */
    .quantity-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .quantity-controls .btn-outline-primary {
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .quantity-controls span {
        font-weight: bold;
    }
</style>

<div class="container">
    <h1 class="my-4">Form Data Reservasi</h1>
    <form action="{{ route('pelanggan.reservasi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tipe_reservasi" class="form-label">Tipe Reservasi</label>
            <select class="form-control" id="tipe_reservasi" name="tipe_reservasi" required>
                <option value="">Pilih tipe reservasi</option>
                <option value="Family">Family</option>
                <option value="VIP">VIP</option>
                <option value="Couple">Couple</option>
                <option value="Business">Business</option>
                <option value="Group">Group</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nomor_meja" class="form-label">Nomor Meja</label>
            <select class="form-control @error('nomor_meja') is-invalid @enderror" id="nomor_meja" name="nomor_meja" required>
                <option value="">Pilih nomor meja</option>
                @php
                    $reservedTables = DB::table('reservasi')
                        ->whereDate('tgl_reservasi', now()->toDateString())
                        ->pluck('nomor_meja')
                        ->toArray();
                @endphp
                @for ($i = 1; $i <= 10; $i++)
                    @if (in_array($i, $reservedTables))
                        <option value="{{ $i }}" disabled>{{ $i }} (Sedang direservasi)</option>
                    @else
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
            @error('nomor_meja')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tgl_reservasi" class="form-label">Tanggal Reservasi</label>
            <input 
                type="date" 
                id="tgl_reservasi" 
                name="tgl_reservasi" 
                class="form-control" 
                required 
                min="{{ date('Y-m-d') }}" 
                max="{{ date('Y-m-d', strtotime('+3 days')) }}">
        </div>

        <div class="mb-3">
            <label for="waktu_reservasi" class="form-label">Waktu Reservasi</label>
            <select id="waktu_reservasi" name="waktu_reservasi" class="form-control" required>
                <option value="pilih waktu reservasi">Pilih Waktu Reservasi</option>
                <option value="13:00">13:00</option>
                <option value="14:30">14:30</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="20:00">20:00</option>
                <option value="20:30">20:30</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Pesan</button>
    </form>
</div>


<div class="d-flex justify-content-between align-items-center mb-3 mt-5 px-4">
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali</a>
        </div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@endsection
