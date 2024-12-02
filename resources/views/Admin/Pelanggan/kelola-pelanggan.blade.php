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

    /* Tambahkan garis pemisah pada setiap baris */
    tbody tr {
        border-bottom: 1px solid #dee2e6; /* Warna abu-abu terang */
    }

    tbody tr:last-child {
        border-bottom: none; /* Hilangkan garis di baris terakhir */
    }

    .btn-sm {
        width: 4.5rem;
    }

    /* Styling untuk form aksi dan tombol */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: flex-start;
    }

    

    .form-actions select {
        margin-top: 5px;
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

    <!-- Tabel Daftar Pelanggan -->
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelangganItems as $pelanggan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pelanggan->nama }}</td>
                    <td>{{ $pelanggan->email }}</td>
                    <td>{{ $pelanggan->no_hp }}</td>
                    <td>{{ $pelanggan->status }}</td>
                    <td>
                        <div class="form-actions">
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
                        </div>
                        
                        <form action="{{ route('admin.pelanggan.updateStatusPelanggan', $pelanggan->id_pelanggan) }}" method="POST">
                            @csrf
                            <div class="form-actions">
                                <select name="status" class="form-select form-select-sm mb-2" 
                                    {{ $pelanggan->status == 'NonAktif' ? 'disabled' : '' }}>
                                    <option value="Aktif" {{ $pelanggan->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="NonAktif" {{ $pelanggan->status == 'NonAktif' ? 'selected' : '' }}>NonAktif</option>
                                    <option value="Dalam Proses" {{ $pelanggan->status == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                                </select>
                                @if($pelanggan->status != 'NonAktif')
                                    <button type="submit" class="btn btn-success btn-sm {{ $pelanggan->status == 'NonAktif' ? 'disabled-btn' : '' }}" 
                                        {{ $pelanggan->status == 'NonAktif' ? 'disabled' : '' }}>
                                        Update
                                    </button>
                                @endif
                            </div>
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
