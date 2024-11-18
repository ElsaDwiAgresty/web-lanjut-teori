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
    <form action="{{ route('pelanggan.registrasi.store') }}" method="POST">
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
            <select class="form-control" id="nomor_meja" name="nomor_meja" required>
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

        <div class="mb-3">
            <label for="tgl_reservasi" class="form-label">Tanggal Reservasi</label>
            <input type="date" id="tgl_reservasi" name="tgl_reservasi" class="form-control" required min="{{ date('Y-m-d') }}">
        </div>

        <div class="mb-3">
            <label for="waktu_reservasi" class="form-label">Waktu Reservasi</label>
            <input type="time" id="waktu_reservasi" name="waktu_reservasi" class="form-control" required>
        </div>

        <!-- <div class="container my-4">
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
                                    <span id="qty-{{ $item->id }}">0</span>
                                    <input type="hidden" id="input-{{ $item->id }}" name="menu[{{ $item->id }}]" value="0">
                                    <button type="button" class="btn btn-outline-primary" onclick="increaseQuantity('{{ $item->id }}')">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> -->

        <button type="submit" class="btn btn-primary">Pesan</button>
    </form>
</div>

<!-- <script>
    function increaseQuantity(id_menu) {
        let qtyElement = document.getElementById('qty-' + id_menu);
        let inputElement = document.getElementById('input-' + id_menu);
        
        // Ambil nilai saat ini dan tambahkan 1
        let currentQty = parseInt(qtyElement.textContent);
        qtyElement.textContent = currentQty + 1;
        inputElement.value = currentQty + 1;
    }

    function decreaseQuantity(id_menu) {
        let qtyElement = document.getElementById('qty-' + id_menu);
        let inputElement = document.getElementById('input-' + id_menu);
        
        // Ambil nilai saat ini dan kurangi 1 (jika lebih besar dari 0)
        let currentQty = parseInt(qtyElement.textContent);
        if (currentQty > 0) {
            qtyElement.textContent = currentQty - 1;
            inputElement.value = currentQty - 1;
        }
    }
</script> -->

@endsection
