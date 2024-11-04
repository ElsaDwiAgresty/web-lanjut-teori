@extends('layouts.app')
@section('content')
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
                        <img src="{{ $item->foto_menu }}" class="card-img-top" alt="{{ $item->nama_menu }}">
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

    <script>
        function increaseQuantity(item) {
            const quantitySpan = document.getElementById(`${item}Qty`);
            const quantityInput = document.getElementById(`${item}Input`);
            let currentQuantity = parseInt(quantitySpan.innerText);
            currentQuantity++;
            quantitySpan.innerText = currentQuantity;
            quantityInput.value = currentQuantity; // Update input tersembunyi
        }

        function decreaseQuantity(item) {
            const quantitySpan = document.getElementById(`${item}Qty`);
            const quantityInput = document.getElementById(`${item}Input`);
            let currentQuantity = parseInt(quantitySpan.innerText);
            if (currentQuantity > 0) {
                currentQuantity--;
                quantitySpan.innerText = currentQuantity;
                quantityInput.value = currentQuantity; // Update input tersembunyi
            }
        }
    </script>

            <button type="submit" class="btn btn-primary">Pesan</button>
        </form>
    </div>
@endsection
