@extends('layouts.app')
@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <style>
        body {
            background-image: url('{{ asset('img/Restoran.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm mt-5">
                    <div class="card-header text-white text-center" style="background-color: #2F4F4F;">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                                @foreach($errors->get('email') as $msg)
                                    <p class="text-danger text-sm mt-1">{{ $msg }}</p>
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" minlength="8" required>
                                @foreach($errors->get('password') as $msg)
                                    <p class="text-danger text-sm mt-1">{{ $msg }}</p>
                                @endforeach
                            </div>

                            <button type="submit" class="w-100 text-white text-center" style="background-color: #2F4F4F;">Login</button>
                            <span>Belum Memiliki akun?<a href={{ route('pelanggan.registrasi') }}>SignUp</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection