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
                    <h3>Edit Pelanggan</h3>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.pelanggan.updatePelanggan', $pelanggan->id_pelanggan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $pelanggan->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $pelanggan->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP:</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $pelanggan->no_hp }}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $pelanggan->alamat }}" required></input>
                    </div>
                    <div class="form-group">
                        <label for="foto_profil">Foto Profil (Max. 2 MB)</label>
                        <br><img src="{{ asset($pelanggan->foto_profil?? 'img/profile/default.webp') }}" alt="Foto Profil" width="100">
                        <br><input type="file" name="foto_profil" class="form-control-file" id="foto_profil"
                            accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
