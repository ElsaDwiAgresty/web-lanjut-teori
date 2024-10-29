@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="my-4">Registrasi Pelanggan</h1>
        <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
            </div>
            <div class="mb-3">
                <label for="nohp" class="form-label">Nomor Hp</label>
                <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Masukkan nomor hp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>
@endsection
