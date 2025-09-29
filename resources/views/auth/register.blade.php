@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto">
  <div class="card p-6 mt-6">
    <h2 class="text-2xl font-bold text-teal-700 mb-1 text-center">Daftar Akun VOIZ</h2>
    <p class="text-center text-sm text-gray-500 mb-4">Gunakan email institusi <strong>@ftmm.unair.ac.id</strong></p>

    <form method="POST" action="{{ route('register') }}" class="space-y-3">
      @csrf

      <div>
        <label class="text-sm font-semibold">NIM</label>
        <input name="nim" value="{{ old('nim') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('nim')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Nama Lengkap</label>
        <input name="nama" value="{{ old('nama') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('nama')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Email Institusi</label>
        <input name="email" value="{{ old('email') }}" placeholder="Contoh: mahasiswa@ftmm.unair.ac.id" required pattern=".+@ftmm\.unair\.ac\.id" class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('email')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Jenis Kelamin</label>
        <select name="jenis_kelamin" required class="w-full mt-1 px-3 py-2 border rounded-md">
          <option value="">-- Pilih --</option>
          <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
          <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Tempat Lahir</label>
        <input name="tempat_lahir" value="{{ old('tempat_lahir') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('tempat_lahir')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('tanggal_lahir')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Alamat</label>
        <textarea name="alamat" required class="w-full mt-1 px-3 py-2 border rounded-md">{{ old('alamat') }}</textarea>
        @error('alamat')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Nomor Telepon</label>
        <input name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="Contoh: 08123456789" required class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('nomor_telepon')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
          <label for="jenis_pekerjaan_id" class="text-sm font-semibold">Pekerjaan</label>
          
          <select name="jenis_pekerjaan_id" id="jenis_pekerjaan_id" required class="w-full mt-1 px-3 py-2 border rounded-md">
              <option value="" disabled selected>-- Pilih Pekerjaan --</option>
              
              @foreach ($listPekerjaan as $pekerjaan)
                  <option value="{{ $pekerjaan->jenis_pekerjaan_id }}" 
                      {{-- Cek apakah ada input lama atau data dari database yang cocok --}}
                      @if(old('jenis_pekerjaan_id', $user->jenis_pekerjaan_id ?? '') == $pekerjaan->jenis_pekerjaan_id) selected @endif>
                      
                      {{ $pekerjaan->nama_pekerjaan }}
                  </option>
              @endforeach
          </select>

          {{-- Pastikan nama error sesuai dengan nama field yaitu 'jenis_pekerjaan_id' --}}
          @error('jenis_pekerjaan_id')
              <div class="text-rose-500 text-xs mt-1">{{ $message }}</div>
          @enderror
      </div>

      <div id="info_mahasiswa" class="hidden space-y-4">
          <hr>
          <div class="mb-4">
              <label class="text-sm font-semibold">Program Studi</label>
              <select name="prodi_id" class="w-full mt-1 px-3 py-2 border rounded-md">
                  <option value="">-- Pilih Program Studi --</option>
                  @foreach($listProdi as $prodi)
                      <option value="{{ $prodi->prodi_id }}" 
                      @if(old('prodi_id', $user->prodi_id ?? '') == $prodi->prodi_id) selected @endif>
                      
                      {{ $prodi->nama_prodi }}
                  </option>
                  @endforeach
              </select>
          </div>
          <div>
              <label class="text-sm font-semibold">Angkatan</label>
              <input name="angkatan" value="{{ old('angkatan') }}" placeholder="Contoh: 2023" class="w-full mt-1 px-3 py-2 border rounded-md">
          </div>
          <hr>
      </div>

      <div>
        <label class="text-sm font-semibold">Password</label>
        <input name="password" type="password" required minlength="6" class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('password')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="text-sm font-semibold">Konfirmasi Password</label>
        <input name="password_confirmation" type="password" required minlength="6" class="w-full mt-1 px-3 py-2 border rounded-md">
        @error('password_confirmation')<div class="text-rose-500 text-xs mt-1">{{ $message }}</div>@enderror
      </div>

      <div class="flex items-center justify-between">
        <a href="{{ route('login.form') }}" class="text-sm text-gray-600">Kembali ke Login</a>
        <button type="submit" class="bg-gradient-to-r from-blue-500 to-teal-500 text-white px-4 py-2 rounded-md">Daftar</button>
      </div>
    </form>
  </div>
</div>

<script>
    const jenisPekerjaanSelect = document.getElementById('jenis_pekerjaan_id');
    const infoMahasiswaDiv = document.getElementById('info_mahasiswa');

    jenisPekerjaanSelect.addEventListener('change', function() {
        if (this.value === '1') {
            infoMahasiswaDiv.classList.remove('hidden'); // Tampilkan div
        } else {
            infoMahasiswaDiv.classList.add('hidden'); // Sembunyikan div
            infoMahasiswaDiv.querySelectorAll('input').forEach(input => input.value = '');
        }
    });
</script>
@endsection
