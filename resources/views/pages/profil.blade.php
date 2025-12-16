@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6">
  <!-- Page Header -->
  <div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Profil Saya</h2>
    <p class="text-gray-500">Informasi akun dan keamanan</p>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Profile Info Card -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center">
        <!-- Avatar -->
        <div class="mb-6">
          <div class="w-[120px] h-[120px] mx-auto rounded-[20px] bg-gradient-to-br from-[#6B21A8] to-[#0ea5f0] flex items-center justify-center text-white font-bold text-5xl shadow-[0_10px_30px_rgba(107,33,168,0.3)]">
            @auth('web')
              {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
            @endauth
            @auth('admin')
              {{ strtoupper(substr(Auth::guard('admin')->user()->nama ?? 'A', 0, 1)) }}
            @endauth
          </div>
        </div>

        <!-- User Info -->
        @auth('web')
          <h4 class="text-xl font-bold text-gray-800 mb-1">{{ Auth::user()->nama ?? 'User Name' }}</h4>
          <p class="text-gray-500 mb-4 text-sm">{{ Auth::user()->email ?? 'user@mail.com' }}</p>
          <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-full font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
            Mahasiswa
          </span>

          <!-- Stats for USER (synced with dashboard) -->
          <div class="grid grid-cols-2 gap-4 mt-8 pt-6 border-t border-gray-100">
            <div class="text-center">
              <h5 class="font-bold text-2xl text-[#6B21A8] mb-1">{{ $totalPengaduan ?? 0 }}</h5>
              <small class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Total</small>
            </div>
            <div class="text-center">
              <h5 class="font-bold text-2xl text-[#f59e0b] mb-1">{{ $menunggu ?? 0 }}</h5>
              <small class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Menunggu</small>
            </div>
            <div class="text-center">
              <h5 class="font-bold text-2xl text-[#0ea5f0] mb-1">{{ $diproses ?? 0 }}</h5>
              <small class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Diproses</small>
            </div>
            <div class="text-center">
              <h5 class="font-bold text-2xl text-[#10b981] mb-1">{{ $selesai ?? 0 }}</h5>
              <small class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Selesai</small>
            </div>
          </div>
        @endauth

        @auth('admin')
          <h4 class="text-xl font-bold text-gray-800 mb-1">{{ Auth::guard('admin')->user()->nama ?? 'Administrator' }}</h4>
          <p class="text-gray-500 mb-4 text-sm">{{ Auth::guard('admin')->user()->email ?? 'admin@mail.com' }}</p>
          <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#6B21A8] to-[#0ea5f0] text-white rounded-full font-medium text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" /></svg>
            Administrator
          </span>

          <!-- Stats for ADMIN -->
          <div class="grid grid-cols-3 gap-2 mt-8 pt-6 border-t border-gray-100">
            <div class="text-center">
              <h5 class="font-bold text-xl text-[#6B21A8] mb-1">{{ $totalPengaduan ?? 0 }}</h5>
              <small class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Total</small>
            </div>
            <div class="text-center">
              <h5 class="font-bold text-xl text-[#10b981] mb-1">{{ $selesai ?? 0 }}</h5>
              <small class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Selesai</small>
            </div>
            <div class="text-center">
              <h5 class="font-bold text-xl text-[#0ea5f0] mb-1">
                @php
                  $persentase = ($totalPengaduan ?? 0) > 0
                      ? round(($selesai / $totalPengaduan) * 100)
                      : 0;
                @endphp
                {{ $persentase }}%
              </h5>
              <small class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Resolved</small>
            </div>
          </div>
        @endauth
      </div>

      <!-- Quick Actions (Admin only) -->
      @auth('admin')
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-6">
        <h6 class="font-bold text-gray-800 mb-4">Aksi Cepat</h6>
        <div class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center w-full py-2.5 px-4 bg-gradient-to-r from-[#6B21A8] to-[#0ea5f0] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.kelola-pengaduan') }}" class="flex items-center justify-center w-full py-2.5 px-4 border border-[#0ea5f0] text-[#0ea5f0] font-semibold rounded-xl hover:bg-[#0ea5f0] hover:text-white transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
                Kelola Pengaduan
            </a>
            <a href="{{ route('admin.visualisasi') }}" class="flex items-center justify-center w-full py-2.5 px-4 border border-gray-300 text-gray-600 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
                Visualisasi
            </a>
        </div>
      </div>
      @endauth
    </div>

    <!-- Info & Password Section -->
    <div class="lg:col-span-2 space-y-8">
      <!-- Personal Info -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
          <h5 class="font-bold text-lg text-gray-800">Informasi Personal</h5>
          <small class="text-gray-500">Data ini tidak dapat diubah. Hubungi admin jika ada kesalahan.</small>
        </div>
        <div class="p-6">
          @auth('web')
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama Lengkap</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ Auth::user()->nama ?? '-' }}</div>
            </div>
            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Email</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ Auth::user()->email ?? '-' }}</div>
            </div>
            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">NIM</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ Auth::user()->nim ?? '-' }}</div>
            </div>
            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">No. Telepon</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ Auth::user()->nomor_telepon ?? '-' }}</div>
            </div>
            <div class="md:col-span-2">
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Program Studi</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ Auth::user()->prodifk->nama_prodi ?? '-' }}</div>
            </div>
          </div>
          @endauth

          @auth('admin')
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Nama Lengkap</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ Auth::guard('admin')->user()->nama ?? 'Administrator Utama' }}</div>
            </div>
            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Email</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ Auth::guard('admin')->user()->email ?? 'admin@ftmm.unair.ac.id' }}</div>
            </div>
          </div>
          @endauth
        </div>
      </div>

      <!-- Change Password Section -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
          <div>
            <h5 class="font-bold text-lg text-gray-800">Keamanan Akun</h5>
            <small class="text-gray-500">Ubah password untuk keamanan akun Anda</small>
          </div>
          <button id="toggleBtn" class="inline-flex items-center px-4 py-2 border border-[#0ea5f0] text-[#0ea5f0] text-sm font-semibold rounded-lg hover:bg-[#0ea5f0] hover:text-white transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" /></svg>
            <span id="toggleText">Ubah Password</span>
          </button>
        </div>

        <div id="passwordForm" class="hidden">
          <div class="p-6 bg-gray-50/50">
            @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-xl mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" /></svg>
                {{ $errors->first() }}
            </div>
            @endif

            @auth('web')
            <form action="{{ route('profil.password') }}" method="POST">
            @endauth
            @auth('admin')
            <form action="{{ route('admin.profil.password') }}" method="POST">
            @endauth
              @csrf
              @method('PUT')

              <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2 text-sm">Password Lama <span class="text-red-500">*</span></label>
                <input type="password" name="old_password" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent transition-all" placeholder="Masukkan password lama" required>
              </div>

              <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-2 text-sm">Password Baru <span class="text-red-500">*</span></label>
                <input type="password" name="new_password" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent transition-all" placeholder="Min. 6 karakter" required>
              </div>

              <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-2 text-sm">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                <input type="password" name="new_password_confirmation" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent transition-all" placeholder="Ulangi password baru" required>
              </div>

              <div class="flex gap-3">
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-[#f59e0b] text-white font-semibold rounded-xl hover:bg-[#d97706] transition-all shadow-md hover:shadow-lg">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" /></svg>
                  Update Password
                </button>
                <button type="button" id="cancelBtn" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-100 transition-all">
                  Batal
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggleBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const form = document.getElementById('passwordForm');
    const toggleText = document.getElementById('toggleText');

    function toggleForm() {
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
            toggleText.textContent = 'Tutup Form';
        } else {
            form.classList.add('hidden');
            toggleText.textContent = 'Ubah Password';
        }
    }

    if(toggleBtn) toggleBtn.addEventListener('click', toggleForm);
    if(cancelBtn) cancelBtn.addEventListener('click', toggleForm);
});
</script>
@endsection
