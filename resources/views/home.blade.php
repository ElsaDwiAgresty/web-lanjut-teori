@extends('layouts.app')

@section('content')
    <style>
        /* Navbar styling */
        .navbar-custom {
            background-color: #2F4F4F;
            /* Warna biru untuk navbar */
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #fff;
        }

        .navbar-custom .nav-link:hover {
            color: #ffc107;
        }

        .navbar-custom

        /* Styling untuk kartu menu */
        .menu-card {
            width: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: auto;
            padding: 10px;
        }

        .menu-card img {
            height: 120px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-header .menu-card .card-body {
            padding: 10px;
            text-align: center;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        /* Button styling */
        .btn-primary {
            background-color: #2F4F4F;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Style untuk informasi tipe reservasi */
        .reservasi-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .reservasi-info h4 {
            font-size: 1.25rem;
            color: #2F4F4F;
            margin-bottom: 10px;
        }

        .reservasi-info ul {
            list-style: none;
            padding: 0;
        }

        .reservasi-info li {
            margin-bottom: 5px;
        }

        /* New styles */
        h3,
        h4 {
            margin-bottom: 20px;
        }

        .reservasi-info {
            margin-bottom: 40px;
            /* Memberi jarak antara waktu reservasi dan menu */
        }

        a {
            color: #2F4F4F;
            text-decoration: none;
        }

        a:hover {
            color: #465c5c;
        }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <img src="img/Logo.png" alt="Logo" style="width: 10%; height: 10%;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @if (session('id_pelanggan'))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ session('role') == 'pelanggan' ? route('pelanggan.dashboard') : route('admin.dashboard') }}">
                                @if ($user['foto_profil'])
                                    <img src="{{asset($user['foto_profil'])}}" width="48" height="48" style="border-radius: 50%; object-fit: cover" alt="">
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                </svg>
                                @endif
                                {{ $user['nama'] }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pelanggan.registrasi') }}">Signup</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container my-4">
        <h1 class="text-center mb-4">Selamat Datang di Restoran Kami!</h1>

        <!-- Informasi Restoran -->
        <div class="row mb-5">
            <div class="col-md-6">
                <h3>Informasi Restoran</h3>
                <p>Selamat datang di restoran kami, tempat yang sempurna untuk menikmati makanan lezat bersama teman dan
                    keluarga. Kami menawarkan berbagai hidangan yang terbuat dari bahan berkualitas tinggi dan disiapkan
                    oleh chef berpengalaman.</p>
                <p>Untuk reservasi, silakan klik tombol di bawah ini untuk memulai proses reservasi Anda.</p>
                <a href="{{ session('role') == 'pelanggan' ? route('pelanggan.reservasi.create') : route('login') }}"
                    class="btn btn-primary">
                    Buat Reservasi
                </a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/restoran.jpg') }}" alt="Foto Restoran" class="img-fluid rounded"
                    style="width: 100%; height: auto;">
            </div>
        </div>

        <!-- Informasi Jenis Reservasi -->
        <h3 class="mt-5">Jenis Reservasi</h3>
        <div class="row g-3 mt-4">
            @php
                $jenisReservasi = [
                    [
                        'nama' => 'VIP (6 orang)',
                        'gambar' => 'img/VipRoom.jpg',
                        'deskripsi' => 'Reservasi eksklusif dengan pelayanan istimewa.',
                    ],
                    [
                        'nama' => 'Couple (2 orang)',
                        'gambar' => 'img/CoupleRoom.jpg',
                        'deskripsi' => 'Ciptakan suasana romantis bersama pasangan.',
                    ],
                    [
                        'nama' => 'Family (6-12 orang)',
                        'gambar' => 'img/FamilyRoom.jpg',
                        'deskripsi' => 'Nyaman untuk berkumpul bersama keluarga.',
                    ],
                    [
                        'nama' => 'Group (2-12 orang)',
                        'gambar' => 'img/GroupRoom.jpg',
                        'deskripsi' => 'Ideal untuk acara bersama teman atau kolega.',
                    ],
                    [
                        'nama' => 'Business (2-12 orang)',
                        'gambar' => 'img/BusinessRoom.jpg',
                        'deskripsi' => 'Lingkungan profesional untuk pertemuan bisnis.',
                    ],
                ];
            @endphp

            @foreach ($jenisReservasi as $reservasi)
                <div class="col-12 col-md-6 col-lg-3 mb-4 d-flex justify-content-center">
                    <div class="card menu-card w-100">
                        <!-- Memperbesar gambar dengan memberi style langsung -->
                        <img src="{{ asset($reservasi['gambar']) }}" class="card-img-top" alt="{{ $reservasi['nama'] }}"
                            style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $reservasi['nama'] }}</h5>
                            <p class="card-text">{{ $reservasi['deskripsi'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Waktu Reservasi -->
        <h3>Waktu Reservasi</h3>
        <div class="d-flex flex-wrap justify-content-center gap-3 reservasi-info">
            @foreach (['13.00', '14.30', '17.00', '18.00', '20.00', '20.30'] as $time)
                <div
                    style="width: 150px; text-align: center; border: 1px solid #ddd; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <h4>{{ $time }}</h4>
                </div>
            @endforeach
        </div>

        <div class="container my-5">
            <h2>Daftar Meja yang Sudah Direservasi</h2>

            <div class="table-responsive mb-8">
                <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nomor Meja</th>
                            <th>Tipe Reservasi</th>
                            <th>Waktu Reservasi</th>
                            <th>Tanggal Reservasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservedTables as $reservation)
                            <tr>
                                <td>{{ $reservation->nomor_meja }}</td>
                                <td>{{ $reservation->tipe_reservasi }}</td>
                                <td>{{ date('H:i', strtotime($reservation->waktu_reservasi)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($reservation->tgl_reservasi)) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada reservasi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Menu Tersedia -->
        <h3 class="mt-16">Menu Tersedia</h3>
        <div class="row">
            @foreach ($menuItems as $item)
                <div class="col-6 col-md-4 col-lg-3 mb-4 text-center">
                    <div class="card menu-card">
                        <img src="{{ asset($item->foto_menu) }}" class="card-img-top" alt="{{ $item->nama_menu }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama_menu }}</h5>
                            <p class="card-text">Rp{{ number_format($item->harga_menu, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Ulasan -->
        <h3 class="mt-12">Ulasan</h3>
        @if (session('id_pelanggan') && session('role') == 'pelanggan')
            <form action="{{ route('pelanggan.ulasan.store') }}" method="POST">
                @csrf
                <textarea name="ulasan" class="form-control" id="ulasan" placeholder="Tulis ulasan di sini" required></textarea>
                <button type="submit" class="btn btn-primary my-4">Kirim</button>
            </form>
        @else
            <div class="my-4">
                <a class="text-center my-4" href="{{ route('pelanggan.login') }}">Silakan login sebagai pelanggan terlebih
                    dahulu untuk membuat
                    ulasan.</a>
            </div>
        @endif
        <div class="ulasan">
            @foreach ($reviews as $review)
                <div class="card mb-4">
                    <div class="card-header">
                        {{ $review->pelanggan->nama }}
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>{{ $review->ulasan }}</p>
                            @if($review->balasan)
                                <footer class="blockquote-footer">
                                    Admin: {{ $review->balasan }}
                                </footer>
                            @endif
                        </blockquote>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-between align-items-center mb-10 mt-5">
                <a href="{{ route('pelanggan.ulasan.index') }}" class="btn btn-primary">Lihat Selengkapnya ></a>
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
