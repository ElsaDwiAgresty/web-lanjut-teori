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

    .btn-secondary {
        background-color: #575757;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #d4d4d4;
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
    <form action="{{ route('pelanggan.reservasi.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="tipe_reservasi" class="form-label">Jenis Reservasi</label>
            <select name="tipe_reservasi" id="tipe_reservasi" class="form-control">
                <option value="">Pilih tipe reservasi</option>
                <option value="Family">Family</option>
                <option value="VIP">VIP</option>
                <option value="Couple">Couple</option>
                <option value="Business">Business</option>
                <option value="Group">Group</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="tgl_reservasi" class="form-label">Tanggal Reservasi</label>
            <input type="date" name="tgl_reservasi" id="tgl_reservasi" class="form-control"
                   min="{{ date('Y-m-d') }}"
                   max="{{ date('Y-m-d', strtotime('+3 days')) }}">
        </div>

        <div class="form-group mb-3">
            <label for="waktu_reservasi" class="form-label">Waktu Reservasi</label>
            <select name="waktu_reservasi" id="waktu_reservasi" class="form-control" disabled>
                <option value="">Pilih Tanggal Terlebih Dahulu</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="nomor_meja" class="form-label">Nomor Meja</label>
            <select name="nomor_meja" id="nomor_meja" class="form-control" disabled>
                <option value="">Pilih Waktu Terlebih Dahulu</option>
            </select>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3 mt-5 px-4">
            <button type="submit" class="btn btn-primary">Reservasi</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>


<script>
    document.getElementById('tgl_reservasi').addEventListener('change', function () {
        const tglReservasi = this.value;

        fetch('{{ route('reservasi.getWaktu') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ tgl_reservasi: tglReservasi })
        })
        .then(response => response.json())
        .then(data => {
            const waktuSelect = document.getElementById('waktu_reservasi');
            waktuSelect.innerHTML = '<option value="">Pilih Waktu</option>';
            data.forEach(waktu => {
                waktuSelect.innerHTML += `<option value="${waktu}">${waktu}</option>`;
            });
            waktuSelect.disabled = false;
        });
    });

    document.getElementById('waktu_reservasi').addEventListener('change', function () {
        const tglReservasi = document.getElementById('tgl_reservasi').value;
        const waktuReservasi = this.value;

        fetch('{{ route('reservasi.getMeja') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ tgl_reservasi: tglReservasi, waktu_reservasi: waktuReservasi })
        })
        .then(response => response.json())
        .then(data => {
            const mejaSelect = document.getElementById('nomor_meja');
            mejaSelect.innerHTML = '<option value="">Pilih Meja</option>';
            data.forEach(meja => {
                mejaSelect.innerHTML += `<option value="${meja}">${meja}</option>`;
            });
            mejaSelect.disabled = false;
        });
    });
</script>
@endsection
