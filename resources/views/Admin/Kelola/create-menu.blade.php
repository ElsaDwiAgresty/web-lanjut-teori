@extends('layouts.admin')

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

    .form-label {
        color: #2F4F4F;
    }

    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-dark text-white text-center">
                        <h3>Tambah Menu</h3>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_menu" class="form-label">Nama Menu:</label>
                            <input type="text" name="nama_menu" id="nama_menu" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_menu" class="form-label">Harga Menu:</label>
                            <input type="number" name="harga_menu" id="harga_menu" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="foto_menu" class="form-label">Foto Menu (opsional):</label>
                            <input type="file" name="foto_menu" class="form-control" id="foto_menu" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
