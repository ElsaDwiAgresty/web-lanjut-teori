@extends('layouts.app')

@section('content')
<style>
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
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    <h3>Edit Menu</h3>
                </div>
                <div class="card-body">
                <form action="{{ route('menu.update', $menu->id_menu) }}" method="POST"         enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_menu" class="form-label">Nama Menu:</label>
                        <input type="text" name="nama_menu" id="nama_menu" class="form-control" value="{{ $menu->nama_menu }}" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_menu" class="form-label">Harga Menu:</label>
                        <input type="number" name="harga_menu" id="harga_menu" class="form-control" value="{{ $menu->harga_menu }}" required>
                    </div>
                    <div class="form-group">
                        <label for="foto_menu" class="form-label">Foto Menu:</label>
                        @if ($menu->foto_menu)
                            <div class="mb-3">
                                <img src="{{ asset($menu->foto_menu) }}" alt="Foto Menu" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        @endif
                        <input type="file" name="foto_menu" id="foto_menu" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Kembali</a>
                </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
