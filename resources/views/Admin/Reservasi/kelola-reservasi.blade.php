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
    <h2 class="text-center mb-4">Kelola Reservasi</h2>

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
                    <th>Id Pelanggan</th>
                    <th>Tipe Reservasi</th>
                    <th>Nomor Meja</th>
                    <th>Tanggal Reservasi</th>
                    <th>Waktu Reservasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservasiItems as $reservasi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <!-- Menampilkan Foto -->
                    <td>{{ $reservasi->id_pelanggan}}</td>
                    <td>{{ $reservasi->tipe_reservasi }}</td>
                    <td>{{ $reservasi->nomor_meja }}</td>
                    <td>{{ $reservasi->tgl_reservasi }}</td>
                    <td>{{ $reservasi->waktu_reservasi }}</td>
                    <td>{{ $reservasi->status }}</td>
                    <td>
                        <form action="{{ route('admin.reservasi.updateStatus', $reservasi->id_reservasi) }}" method="POST">
                            @csrf
                            <select name="status" class="form-select form-select-sm mb-2">
                                <option value="OK" {{ $reservasi->status == 'OK' ? 'selected' : '' }}>OK</option>
                                <option value="Dalam Antrian" {{ $reservasi->status == 'Dalam Antrian' ? 'selected' : '' }}>Dalam Antrian</option>
                                <option value="Ditolak" {{ $reservasi->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </form>
                    
                        <a href="" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>

                        <form action="" method="POST" class="d-inline">
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
    </div>
</div>
@endsection