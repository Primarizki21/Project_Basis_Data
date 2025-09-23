@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
  <div class="card p-6">
    <h3 class="font-bold">Kontak & Bantuan</h3>
    <p class="text-sm text-gray-500 mt-2">Butuh bantuan? Hubungi admin VOIZ atau layanan keamanan kampus.</p>

    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="p-4 rounded-lg bg-blue-50">
        <div class="font-semibold">Admin VOIZ</div>
        <div class="text-sm text-gray-600 mt-1">admin-voiz@ftmm.unair.ac.id</div>
        <div class="mt-3 flex gap-3">
          <a href="tel:+6231xxxxxxx" class="px-3 py-2 rounded-md bg-white inline-flex items-center gap-2 text-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2l2 7-2 2 6 6 2-2 7 2v2H3V5z"/></svg> Telepon</a>
          <a href="https://wa.me/628123456789" target="_blank" class="px-3 py-2 rounded-md bg-emerald-500 text-white inline-flex items-center gap-2 text-sm">WhatsApp</a>
        </div>
      </div>

      <div class="p-4 rounded-lg bg-rose-50">
        <div class="font-semibold">Laporan Darurat</div>
        <div class="text-sm text-gray-600 mt-1">Jika berkaitan keselamatan, hubungi keamanan kampus segera.</div>
        <div class="mt-3">
          <a href="tel:+6231xxxxxxx" class="px-3 py-2 rounded-md bg-rose-600 text-white">Hubungi Keamanan</a>
        </div>
      </div>
    </div>
  </div>

  <div class="card p-6">
    <h4 class="font-bold">Pesan dari VOIZ</h4>
    <p class="text-sm text-gray-600 mt-2">Terima kasih telah menggunakan VOIZ. Untuk laporan sensitif, sertakan bukti. Jika darurat, hubungi layanan keselamatan terlebih dahulu.</p>
  </div>
</div>
@endsection