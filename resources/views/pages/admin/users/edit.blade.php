@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center">
        <a href="{{ route('admin.kelola-user') }}" class="btn btn-outline-secondary me-3">
          <i class="bi bi-arrow-left"></i>
        </a>
        <div>
          <h2 class="fw-bold mb-1">Edit Data Pengguna</h2>
          <p class="text-muted mb-0">Ubah detail informasi pengguna yang dipilih</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i>
        <div>
          Perubahan pada email atau password akan mempengaruhi cara pengguna login.
        </div>
      </div>

      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4" role="alert">
                            <h5 class="alert-heading fw-bold">Terjadi Kesalahan!</h5>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="mb-4">
              <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
              <input type="text" id="nama" name="nama" class="form-control form-control-lg" value="{{ old('nama', $user->nama) }}" required>
            </div>

            <div class="mb-4">
              <label for="email" class="form-label fw-semibold">Alamat Email</label>
              <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email', $user->email) }}" required>
            </div>
            
            <div class="mb-4">
              <label for="nim" class="form-label fw-semibold">NIM</label>
              <input type="text" id="nim" name="nim" class="form-control form-control-lg" value="{{ old('nim', $user->nim) }}" required>
            </div>
            
            <div class="mb-4">
                <label for="jenis_pekerjaan_id" class="form-label fw-semibold">Jenis Pekerjaan</label>
                <select name="jenis_pekerjaan_id" id="jenis_pekerjaan_id" class="form-select form-select-lg" required>
                    <option value="">-- Pilih Jenis Pekerjaan --</option>                    
                    @foreach($jenis_pekerjaan as $pekerjaan)
                    <option 
                    value="{{ $pekerjaan->jenis_pekerjaan_id }}" 
                    @selected(old('jenis_pekerjaan_id', $user->jenis_pekerjaan_id) == $pekerjaan->jenis_pekerjaan_id)>
                    {{ $pekerjaan->nama_pekerjaan }}
                </option>
                @endforeach
            </select>
        </div>
            
        <div class="mb-4">
            <label for="prodi_id" class="form-label fw-semibold">Program Studi</label>
                <select name="prodi_id" id="prodi_id" class="form-select form-select-lg" required>
                    <option value="">-- Pilih Program Studi --</option>                    
                    @foreach($program_studi as $prodi)
                    <option 
                    value="{{ $prodi->prodi_id }}" 
                    @selected(old('prodi_id', $user->prodi_id) == $prodi->prodi_id)>
                    {{ $prodi->nama_prodi }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
          <label for="angkatan" class="form-label fw-semibold">Angkatan</label>
          <input type="text" id="angkatan" name="angkatan" class="form-control form-control-lg" value="{{ old('angkatan', $user->angkatan) }}" required>
        </div>
        
        <div class="mb-4">
            <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select form-select-lg" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki" @selected(old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki')>
                    Laki-laki
                </option>
                <option value="Perempuan" @selected(old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan')>
                    Perempuan
                </option>
            </select>
        </div>

        <div class="mb-4">
          <label for="tempat_lahir" class="form-label fw-semibold">Tempat Lahir</label>
          <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control form-control-lg" value="{{ old('tempat_lahir', $user->tempat_lahir) }}" required>
        </div>
            
        <div class="mb-4">
          <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
          <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control form-control-lg" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" required>
        </div>
        
        <div class="mb-4">
          <label for="alamat" class="form-label fw-semibold">Alamat</label>
          <input type="text" id="alamat" name="alamat" class="form-control form-control-lg" value="{{ old('alamat', $user->alamat) }}" required>
        </div>
        
        <div class="mb-4">
          <label for="nomor_telepon" class="form-label fw-semibold">No. Telepon</label>
          <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control form-control-lg" value="{{ old('nomor_telepon', $user->nomor_telepon) }}" required>
        </div>
            
            <div class="mb-4">
                <label for="account_type" class="form-label fw-semibold">Tipe Akun</label>
                <select name="account_type" id="account_type" class="form-select form-select-lg">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>
                <small class="text-muted">Mengubah ke 'Admin' akan memindahkan data pengguna ini ke tabel admin.</small>
            </div>

            <div class="mb-4">
              <label for="password" class="form-label fw-semibold">Password Baru (Opsional)</label>
              <input type="password" id="password" name="password" class="form-control form-control-lg">
              <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
            </div>

            <div class="mb-4">
              <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg">
            </div>
            
            <div class="mb-4">
                <label class="form-label fw-semibold">Foto Profil</label>
                @if($user->foto_profil)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="img-thumbnail" width="120">
                </div>
                @endif
                <input type="file" name="foto_profil" class="form-control" accept="image/*">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto profil.</small>
            </div>


            <div class="d-flex gap-3 mt-4">
              <button type="submit" class="btn btn-lg text-white px-5" style="background: linear-gradient(135deg, #6B21A8, #7C3AED); border: none;">
                <i class="bi bi-save me-2"></i>Simpan Perubahan
              </button>
              <a href="{{ route('admin.kelola-user') }}" class="btn btn-lg btn-outline-secondary px-4">
                Batal
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
        <div class="card-body p-4 text-white">
          <h6 class="fw-bold mb-3">
            <i class="bi bi-exclamation-triangle me-2"></i>Perhatian
          </h6>
          <ul class="mb-0 ps-3" style="font-size: 0.9rem;">
            <li class="mb-2">Pastikan email yang dimasukkan unik dan valid.</li>
            <li class="mb-2">Kosongkan field password jika Anda tidak berniat untuk mengubahnya.</li>
            <li class="mb-0">Perubahan akan langsung diterapkan pada data pengguna.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css"> --}}
@endsection