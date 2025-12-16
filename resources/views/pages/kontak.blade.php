@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 container mx-auto px-4 lg:px-6 py-6 animate-[fadeIn_0.6s_ease-out]">
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h3 class="font-bold text-gray-800 text-lg">Kontak & Bantuan</h3>
    <p class="text-sm text-gray-500 mt-2">Butuh bantuan? Hubungi admin VOIZ atau layanan keamanan kampus.</p>

    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="p-4 rounded-xl bg-blue-50 border border-blue-100">
        <div class="font-semibold text-blue-900">Admin VOIZ</div>
        <div class="text-sm text-blue-700 mt-1">admin-voiz@ftmm.unair.ac.id</div>
        <div class="mt-3 flex gap-3">
          <a href="tel:+6231xxxxxxx" class="px-3 py-2 rounded-lg bg-white border border-blue-200 text-blue-700 inline-flex items-center gap-2 text-sm hover:bg-blue-50 transition-colors shadow-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2l2 7-2 2 6 6 2-2 7 2v2H3V5z"/></svg> Telepon</a>
          <a href="https://wa.me/628123456789" target="_blank" class="px-3 py-2 rounded-lg bg-emerald-500 text-white inline-flex items-center gap-2 text-sm hover:bg-emerald-600 transition-colors shadow-sm shadow-emerald-200">WhatsApp</a>
        </div>
      </div>

      <div class="p-4 rounded-xl bg-rose-50 border border-rose-100">
        <div class="font-semibold text-rose-900">Laporan Darurat</div>
        <div class="text-sm text-rose-700 mt-1">Jika berkaitan keselamatan, hubungi keamanan kampus segera.</div>
        <div class="mt-3">
          <a href="tel:+6231xxxxxxx" class="inline-flex items-center px-4 py-2 rounded-lg bg-rose-600 text-white hover:bg-rose-700 transition-colors shadow-sm shadow-rose-200 font-medium text-sm">Hubungi Keamanan</a>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h4 class="font-bold text-gray-800 text-lg">Pesan dari VOIZ</h4>
    <p class="text-sm text-gray-600 mt-2 leading-relaxed">Terima kasih telah menggunakan VOIZ. Untuk laporan sensitif, sertakan bukti. Jika darurat, hubungi layanan keselamatan terlebih dahulu.</p>
  </div>
</div>
@endsection
