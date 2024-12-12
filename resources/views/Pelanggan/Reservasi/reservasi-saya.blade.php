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
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    a {
        color: #2F4F4F;
        text-decoration: none;
    }

    a:hover {
        color: #465c5c;
    }
</style>

<div class="container my-5">
    <a href="{{ route('pelanggan.dashboard') }}">
        < Kembali ke Dashboard</a>
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
            <table table id="dataTable" class="table table-bordered table-striped table-hover shadow">
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
                                    @elseif($item->status == 'Selesai') bg-primary
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
