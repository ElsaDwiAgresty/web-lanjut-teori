@extends('layouts.app')
@section('content')

<style>
    .btn-primary {
        background-color: #2F4F4F;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div class="container my-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Reservasi Saya</h2>
        <p class="text-muted">Lihat status reservasi Anda di sini</p>
    </div>

    @if($reservasi->isEmpty())
        <div class="alert alert-info text-center">
            <p><i class="bi bi-info-circle-fill"></i> Tidak ada reservasi yang ditemukan.</p>
        </div>
    @else

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover shadow">
                <thead class="table-dark">
                    <tr>
                        <th>Tipe Reservasi</th>
                        <th>Nomor Meja</th>
                        <th>Tanggal Reservasi</th>
                        <th>Waktu Reservasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservasi as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->tipe_reservasi }}</td>
                            <td>{{ $item->nomor_meja }}</td>
                            <td>{{ $item->tgl_reservasi}}</td>
                            <td>{{ $item->waktu_reservasi}}</td>
                            <td>
                                <span class="badge 
                                    @if($item->status == 'OK') bg-success 
                                    @elseif($item->status == 'Dalam Antrian') bg-warning 
                                    @else bg-danger 
                                    @endif">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
            <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-primary">Kembali</a>
        </div>
</div>

@endsection
