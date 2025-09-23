@extends('layout')

@section('content')
    <h3>Apa itu Kekerasan Seksual terhadap Perempuan?</h3>
    <p>
        Kekerasan seksual adalah setiap perbuatan merendahkan, menghina, menyerang, 
        atau tindakan lainnya terhadap tubuh atau seksualitas perempuan yang 
        mengakibatkan penderitaan fisik, psikologis, maupun sosial.
    </p>

    <h4>Jenis-jenis Kekerasan Seksual:</h4>
    <ul>
        <li>Pelecehan Verbal</li>
        <li>Pelecehan Fisik</li>
        <li>Pemaksaan Hubungan Seksual</li>
        <li>Kekerasan Berbasis Teknologi</li>
    </ul>

    <p>
        Sistem ini dibuat untuk memudahkan pelaporan kasus kekerasan seksual di lingkungan fakultas.
    </p>

    @if(Auth::check())
    <a href="{{ route('pengaduan.create') }}">Klik untuk melapor</a>
    @else
    <a href="{{ route('login') }}">Login untuk melapor</a>
    @endif

@endsection
