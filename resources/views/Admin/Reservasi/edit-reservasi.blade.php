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
                    <h3>Edit Reservasi</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reservasi.updateReservasi', $reservasi->id_reservasi) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_pelanggan">ID Pelanggan:</label>
                            <input type="text" name="id_pelanggan" id="id_pelanggan" class="form-control" value="{{ old('id_pelanggan', $reservasi->id_pelanggan) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tipe_reservasi">Tipe Reservasi:</label>
                            <input type="text" name="tipe_reservasi" id="tipe_reservasi" class="form-control" value="{{ old('tipe_reservasi', $reservasi->tipe_reservasi) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_meja">Nomor Meja:</label>
                            <input type="text" name="nomor_meja" id="nomor_meja" class="form-control" value="{{ old('nomor_meja', $reservasi->nomor_meja) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_reservasi">Tanggal Reservasi:</label>
                            <input type="date" name="tgl_reservasi" id="tgl_reservasi" class="form-control" value="{{ old('tgl_reservasi', $reservasi->tgl_reservasi) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="waktu_reservasi">Waktu Reservasi:</label>
                            <input type="time" name="waktu_reservasi" id="waktu_reservasi" class="form-control" value="{{ old('waktu_reservasi', $reservasi->waktu_reservasi) }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('admin.reservasi.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
