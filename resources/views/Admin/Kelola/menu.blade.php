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

    .btn-sm {
        width: 4.5rem;
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

    <h2 class="text-center mb-4">Kelola Menu</h2>

    <!-- Tampilkan pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah Menu Baru -->
    <div class="text-right mb-4">
        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">
            <i class="fa fa-plus-circle"></i> Tambah Menu Baru
        </a>
    </div>

    <!-- Tabel Daftar Menu -->
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Foto Menu</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menuItems as $menu)
                <tr>
                <td>{{ $menuItems->firstItem() + $loop->index }}</td>
                    <!-- Menampilkan Foto -->
                    <td>
                        @if($menu->foto_menu)
                            <img src="{{ asset($menu->foto_menu) }}" alt="Foto Menu" class="img-thumbnail" width="100">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $menu->nama_menu }}</td>
                    <td>Rp {{ number_format($menu->harga_menu, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('menu.edit', $menu->id_menu) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('menu.delete', $menu->id_menu) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm text-centre" onclick="return confirm('Anda yakin ingin menghapus menu ini?');">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($menuItems->hasPages())
    <div class="d-flex justify-content-center">
        {{ $menuItems->links('pagination::bootstrap-4') }}
    </div>
@endif

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
