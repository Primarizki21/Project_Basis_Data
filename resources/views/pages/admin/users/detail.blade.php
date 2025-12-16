@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6 animate-[fadeIn_0.6s_ease-out]">
  <!-- Page Header -->
  <div class="mb-8 flex items-center">
    <a href="{{ route('admin.kelola-user') }}" class="mr-4 p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors border border-gray-200">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
    </a>
    <div>
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Detail User</h2>
      <p class="text-gray-500">Informasi lengkap pengguna</p>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Profile Card -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center h-full">
        <div class="mb-6">
          <div class="w-[120px] h-[120px] mx-auto rounded-[20px] bg-gradient-to-br from-[#6B21A8] to-[#0ea5f0] flex items-center justify-center text-white font-bold text-5xl shadow-[0_10px_30px_rgba(107,33,168,0.3)]">
            {{ strtoupper(substr($user->nama, 0, 1)) }}
          </div>
        </div>

        <h4 class="text-xl font-bold text-gray-800 mb-1">{{ $user->nama }}</h4>
        <p class="text-gray-500 mb-4 text-sm">{{ $user->email }}</p>

        <span class="inline-flex items-center px-4 py-2 rounded-full font-medium text-sm
          @if($user->pekerjaanfk->nama_pekerjaan == 'Mahasiswa') bg-green-100 text-green-700
          @elseif(in_array($user->pekerjaanfk->nama_pekerjaan, ['Dosen/Peneliti', 'Tendik'])) bg-blue-100 text-blue-700
          @else bg-gray-100 text-gray-700 @endif">
          {{ $user->pekerjaanfk->nama_pekerjaan ?? 'User' }}
        </span>

        <div class="mt-8 pt-6 border-t border-gray-100">
            <p class="text-gray-500 text-sm mb-1">Bergabung Sejak</p>
            <p class="font-semibold text-gray-800">{{ $user->created_at->format('d F Y') }}</p>
        </div>
      </div>
    </div>

    <!-- Info Detail -->
    <div class="lg:col-span-2">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full">
        <div class="p-6 border-b border-gray-100">
          <h5 class="font-bold text-lg text-gray-800">Informasi Lengkap</h5>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">NIM/NIP</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ $user->nim ?? '-' }}</div>
            </div>

            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">No. Telepon</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ $user->nomor_telepon ?? '-' }}</div>
            </div>

            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Jenis Kelamin</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ $user->jenis_kelamin ?? '-' }}</div>
            </div>

            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Tanggal Lahir</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">
                {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
              </div>
            </div>

            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Tempat Lahir</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ $user->tempat_lahir ?? '-' }}</div>
            </div>

            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Program Studi / Unit</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ $user->prodifk->nama_prodi ?? '-' }}</div>
            </div>

            @if($user->angkatan)
            <div>
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Angkatan</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ $user->angkatan }}</div>
            </div>
            @endif

            <div class="md:col-span-2">
              <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Alamat</label>
              <div class="text-gray-900 font-medium py-2 border-b border-gray-100">{{ $user->alamat ?? '-' }}</div>
            </div>
          </div>

          <div class="mt-8 flex gap-3">
            <a href="{{ route('admin.users.edit', $user->user_id) }}" class="inline-flex items-center px-5 py-2.5 bg-[#f59e0b] text-white font-semibold rounded-xl hover:bg-[#d97706] hover:shadow-lg transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                Edit User
            </a>
            <form action="{{ route('admin.kelola-user.destroy', $user->user_id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus user ini secara permanen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-5 py-2.5 border border-red-200 text-red-600 font-semibold rounded-xl hover:bg-red-50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                    Hapus User
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
