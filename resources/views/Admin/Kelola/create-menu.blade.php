@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Tambah Menu Baru</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_menu">Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" id="nama_menu" required>
        </div>
        <div class="form-group">
            <label for="harga_menu">Harga Menu</label>
            <input type="number" name="harga_menu" class="form-control" id="harga_menu" required>
        </div>
        <div class="form-group">
            <label for="foto_menu">Foto Menu (opsional)</label>
            <input type="file" name="foto_menu" class="form-control-file" id="foto_menu" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
