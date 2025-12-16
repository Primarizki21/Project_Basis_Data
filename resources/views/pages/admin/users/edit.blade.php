@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6 animate-[fadeIn_0.6s_ease-out]">
  <!-- Page Header -->
  <div class="mb-8 flex items-center">
    <a href="{{ route('admin.kelola-user') }}" class="mr-4 p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors border border-gray-200">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
    </a>
    <div>
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit User</h2>
      <p class="text-gray-500">Ubah data pengguna sistem</p>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-4xl mx-auto">
    <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
          <input type="text" name="nama" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" value="{{ old('nama', $user->nama) }}" required>
        </div>

        <div>
          <label class="block font-semibold text-gray-700 mb-2">Email</label>
          <input type="email" name="email" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" value="{{ old('email', $user->email) }}" required>
        </div>

        <div>
          <label class="block font-semibold text-gray-700 mb-2">NIM/NIP</label>
          <input type="text" name="nim" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" value="{{ old('nim', $user->nim) }}">
        </div>

        <div>
          <label class="block font-semibold text-gray-700 mb-2">No. Telepon</label>
          <input type="tel" name="nomor_telepon" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" value="{{ old('nomor_telepon', $user->nomor_telepon) }}">
        </div>

        <div>
          <label class="block font-semibold text-gray-700 mb-2">Role</label>
          <div class="relative">
              <select name="jenis_pekerjaan_id" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white" required>
                  @foreach ($jenisPekerjaan as $jenis)
                      <option value="{{ $jenis->jenis_pekerjaan_id }}" {{ $user->jenis_pekerjaan_id == $jenis->jenis_pekerjaan_id ? 'selected' : '' }}>
                          {{ $jenis->nama_pekerjaan }}
                      </option>
                  @endforeach
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
              </div>
          </div>
        </div>

        <div>
          <label class="block font-semibold text-gray-700 mb-2">Program Studi</label>
          <div class="relative">
              <select name="prodi_id" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white" required>
                  @foreach ($prodis as $prodi)
                      <option value="{{ $prodi->prodi_id }}" {{ $user->prodi_id == $prodi->prodi_id ? 'selected' : '' }}>
                          {{ $prodi->nama_prodi }}
                      </option>
                  @endforeach
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
              </div>
          </div>
        </div>

        <div>
          <label class="block font-semibold text-gray-700 mb-2">Password Baru <span class="text-gray-400 font-normal text-sm">(Opsional)</span></label>
          <input type="password" name="password" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" placeholder="Kosongkan jika tidak ingin mengubah">
        </div>

        <div>
          <label class="block font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" placeholder="Ulangi password baru">
        </div>
      </div>

      <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-6">
        <a href="{{ route('admin.kelola-user') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all">Batal</a>
        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#6B21A8] to-[#0ea5f0] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endsection
