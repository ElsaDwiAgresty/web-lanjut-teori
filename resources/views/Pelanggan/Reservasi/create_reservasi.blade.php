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
        background-color: #007bff;
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
    <form action="" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap">
        </div>
        <div class="mb-3">
            <label for="tipe_reservasi" class="form-label">Tipe Reservasi</label>
            <select class="form-control" id="tipe_reservasi" name="tipe_reservasi">
                <option value="">Pilih tipe reservasi</option>
                <option value="family">Family</option>
                <option value="vip">VIP</option>
                <option value="couple">Couple</option>
                <option value="business">Business</option>
                <option value="group">Group</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nomor_meja" class="form-label">Nomor Meja</label>
            <select class="form-control" id="nomor_meja" name="nomor_meja">
                <option value="">Pilih nomor meja</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>

        <div class="container my-4">
            <h3>Pilih Menu</h3>
            <div class="row">
                @foreach ($menuItems as $item)
                    <div class="col-md-4">
                        <div class="card menu-card">
                            <img src="{{ asset($item->foto_menu) }}" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover" alt="{{ $item->nama_menu }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_menu }}</h5>
                                <p class="card-text">Rp{{ number_format($item->harga_menu, 0, ',', '.') }}</p>
                                <div class="quantity-controls">
                                    <button type="button" class="btn btn-outline-primary" onclick="decreaseQuantity('{{ $item->id }}')">-</button>
                                    <span id="{{ $item->id }}Qty">0</span>
                                    <input type="hidden" id="{{ $item->id }}Input" name="menu[{{ $item->id }}]" value="0">
                                    <button type="button" class="btn btn-outline-primary" onclick="increaseQuantity('{{ $item->id }}')">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Pesan</button>
    </form>
</div>

<script>
    function increaseQuantity(item) {
        const quantitySpan = document.getElementById(`${item}Qty`);
        const quantityInput = document.getElementById(`${item}Input`);
        let currentQuantity = parseInt(quantitySpan.innerText);
        currentQuantity++;
        quantitySpan.innerText = currentQuantity;
        quantityInput.value = currentQuantity;
    }

    function decreaseQuantity(item) {
        const quantitySpan = document.getElementById(`${item}Qty`);
        const quantityInput = document.getElementById(`${item}Input`);
        let currentQuantity = parseInt(quantitySpan.innerText);
        if (currentQuantity > 0) {
            currentQuantity--;
            quantitySpan.innerText = currentQuantity;
            quantityInput.value = currentQuantity;
        }
    }
</script>

@endsection
