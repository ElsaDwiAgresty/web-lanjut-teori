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
    <a href="{{ route('admin.dashboard') }}">
        < Kembali ke Dashboard</a>
        
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
                    <th>Ulasan</th>
                    <th>Balasan</th>
                    <th>Waktu Pembuatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ulasanItems as $ulasan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ulasan->pelanggan->nama}}</td>
                    <td>{{ $ulasan->ulasan }}</td>
                    <td>{{ $ulasan->balasan }}</td>
                    <td>{{ $ulasan->created_at }}</td>

                    <td>
                        <form action="{{ route('admin.ulasan.reply', $ulasan->id_ulasan) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="input-group mb-2">
                                <textarea name="balasan" class="form-control" placeholder="Tulis balasan...">{{ $ulasan->balasan }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa fa-reply"></i> Balas
                            </button>
                        </form>

                        <form action="{{ route('admin.ulasan.destroy', $ulasan->id_ulasan) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus ulasan ini?');">
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
