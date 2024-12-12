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
        <table id="dataTable" class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
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
                    <td>{{ $reservasi->pelanggan->nama}}</td>
                    <td>{{ $reservasi->tipe_reservasi }}</td>
                    <td>{{ $reservasi->nomor_meja }}</td>
                    <td>{{ $reservasi->tgl_reservasi }}</td>
                    <td>{{ $reservasi->waktu_reservasi }}</td>
                    <td>{{ $reservasi->status }}</td>
                    <td>
                        <form action="{{ route('admin.reservasi.updateStatus', $reservasi->id_reservasi) }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <select name="status" class="form-select form-select-sm"

                                    {{$reservasi->status == 'Ditolak' ? 'disabled' : ''}}>
                                    <option value="OK" {{ $reservasi->status == 'OK' ? 'selected' : '' }}>OK</option>
                                    <option value="Dalam Antrian" {{ $reservasi->status == 'Dalam Antrian' ? 'selected' : '' }}>Dalam Antrian</option>
                                    <option value="Ditolak" {{ $reservasi->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="Selesai" {{ $reservasi->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                            @if($reservasi->status != 'Ditolak')
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </form>

                                <a href="{{ route('admin.reservasi.editReservasi', $reservasi->id_reservasi) }}" class="btn btn-warning btn-sm">

                                {{ !$reservasi->id_reservasi ? 'disabled' : ''}}
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            @endif
                                <form action="{{ route('admin.reservasi.destroy', $reservasi->id_reservasi) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus pelanggan ini?');">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
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

<!-- Tambahkan CDN DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- Inisialisasi DataTables -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "responsive": true,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Berikutnya"
                }
            }
        });
    });
</script>
@endsection
