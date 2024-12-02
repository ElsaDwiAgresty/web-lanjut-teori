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

    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        color: #2F4F4F;
    }

    .card-body {
        background-color: #f0f4f8;
    }

    a {
        color: #2F4F4F;
        text-decoration: none;
    }

    a:hover {
        color: #465c5c;
    }
</style>
<div class="container mt-5">
    <h2 class="text-center mb-4">Kelola Pelanggan</h2>

    <!-- Tampilkan pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Daftar pelanggan -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelangganItems as $pelanggan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <!-- Menampilkan Foto -->
                    <td>{{ $pelanggan->nama }}</td>
                    <td>{{ $pelanggan->email }}</td>
                    <td>{{ $pelanggan->no_hp }}</td>
                    <td>
                        <a href="{{ $pelanggan->id_pelanggan ? route('admin.pelanggan.editPelanggan', ['id' => $pelanggan->id_pelanggan]) : '#' }}" class="btn btn-warning btn-sm"
                            {{ !$pelanggan->id_pelanggan ? 'disabled' : '' }}>
                            <i class="fa fa-edit"></i> Edit
                        </a>


                        <form action="{{ route('admin.pelanggan.destroy', $pelanggan->id_pelanggan) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus pelanggan ini?');">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection
