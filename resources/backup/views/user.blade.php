@extends('layout')

@section('content')
    <h3>Login atau Buat Akun</h3>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    {{-- Form Login --}}
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <h4>Login</h4>
        <label>NIM:</label>
        <input type="text" name="nim" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>

    <hr>

    {{-- Form Register --}}
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label>NIM:</label>
        <input type="text" name="nim" required><br>
        <label>Nama:</label>
        <input type="text" name="nama" required><br>
        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
            <option value="Lainnya">Lainnya</option>
        </select><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>

@endsection
