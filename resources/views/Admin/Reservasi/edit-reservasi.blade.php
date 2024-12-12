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
                    <h3>Edit Reservasi</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reservasi.updateReservasi', $reservasi->id_reservasi) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_pelanggan" hidden>ID Pelanggan:</label>
                            <input type="text" name="id_pelanggan" id="id_pelanggan" class="form-control" value="{{ old('id_pelanggan', $reservasi->id_pelanggan) }}" required hidden>
                        </div>
                        <div class="form-group">
                            <label for="nama_pelanggan">Nama Pelanggan:</label>
                            <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="{{ old('id_pelanggan', $reservasi->pelanggan->nama ) }}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="tipe_reservasi">Tipe Reservasi:</label>
                            <select class="form-control" id="tipe_reservasi" name="tipe_reservasi" required>
                                <option value="Family" {{ $reservasi->tipe_reservasi == 'Family' ? 'selected' : '' }}>Family</option>
                                <option value="VIP" {{ $reservasi->tipe_reservasi == 'VIP' ? 'selected' : '' }}>VIP</option>
                                <option value="Couple" {{ $reservasi->tipe_reservasi == 'Couple' ? 'selected' : '' }}>Couple</option>
                                <option value="Business" {{ $reservasi->tipe_reservasi == 'Business' ? 'selected' : '' }}>Business</option>
                                <option value="Group" {{ $reservasi->tipe_reservasi == 'Group' ? 'selected' : '' }}>Group</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nomor_meja">Nomor Meja:</label>
                            <select class="form-control" id="nomor_meja" name="nomor_meja" required>
                                <option value="1" {{ $reservasi->nomor_meja == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $reservasi->nomor_meja == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $reservasi->nomor_meja == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $reservasi->nomor_meja == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ $reservasi->nomor_meja == '5' ? 'selected' : '' }}>5</option>
                                <option value="6" {{ $reservasi->nomor_meja == '6' ? 'selected' : '' }}>6</option>
                                <option value="7" {{ $reservasi->nomor_meja == '7' ? 'selected' : '' }}>7</option>
                                <option value="8" {{ $reservasi->nomor_meja == '8' ? 'selected' : '' }}>8</option>
                                <option value="9" {{ $reservasi->nomor_meja == '9' ? 'selected' : '' }}>9</option>
                                <option value="10" {{ $reservasi->nomor_meja == '10' ? 'selected' : '' }}>10</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_reservasi">Tanggal Reservasi:</label>
                            <input
                                type="date"
                                id="tgl_reservasi"
                                name="tgl_reservasi"
                                class="form-control"
                                required
                                min="{{ date('Y-m-d') }}"
                                max="{{ date('Y-m-d', strtotime('+3 days')) }}"
                                value="{{ old('tgl_reservasi', $reservasi->tgl_reservasi) }}">
                        </div>
                        <div class="form-group">
                            <label for="waktu_reservasi">Waktu Reservasi:</label>
                            <select id="waktu_reservasi" name="waktu_reservasi" class="form-control" required>
                                <option value="13:00" {{ $reservasi->waktu_reservasi == '13:00' ? 'selected' : '' }}>13:00</option>
                                <option value="14:30" {{ $reservasi->waktu_reservasi == '14:30' ? 'selected' : '' }}>14:30</option>
                                <option value="17:00" {{ $reservasi->waktu_reservasi == '17:00' ? 'selected' : '' }}>17:00</option>
                                <option value="18:00" {{ $reservasi->waktu_reservasi == '18:00' ? 'selected' : '' }}>18:00</option>
                                <option value="20:00" {{ $reservasi->waktu_reservasi == '20:00' ? 'selected' : '' }}>20:00</option>
                                <option value="20:30" {{ $reservasi->waktu_reservasi == '20:30' ? 'selected' : '' }}>20:30</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('admin.reservasi.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
