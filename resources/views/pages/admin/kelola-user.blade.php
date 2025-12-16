@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6 animate-[fadeIn_0.6s_ease-out]">
  <!-- Page Header -->
  <div class="mb-8 flex justify-between items-center">
    <div>
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Kelola User</h2>
      <p class="text-gray-500">Manajemen akun pengguna sistem</p>
    </div>
    <button onclick="toggleUserModal()" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-[#6B21A8] to-[#7C3AED] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" /></svg>
      Tambah User Baru
    </button>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center">
            <div class="w-14 h-14 bg-gradient-to-br from-[#6B21A8] to-[#7C3AED] rounded-xl flex items-center justify-center mr-4 text-white shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
            </div>
            <div>
                <small class="text-gray-500 block font-medium mb-1">Total User</small>
                <h4 class="font-bold text-2xl text-[#6B21A8] counter" data-target="{{ $totalUsers }}">0</h4>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center">
            <div class="w-14 h-14 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-xl flex items-center justify-center mr-4 text-white shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <small class="text-gray-500 block font-medium mb-1">Mahasiswa</small>
                <h4 class="font-bold text-2xl text-[#10b981] counter" data-target="{{ $totalMahasiswa }}">0</h4>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center">
            <div class="w-14 h-14 bg-gradient-to-br from-[#0ea5f0] to-[#0284c7] rounded-xl flex items-center justify-center mr-4 text-white shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-1.294-1.51l-1.294 1.51c-.139.162-.355.195-.533.097-1.403-.769-3.08-1.574-3.553-1.85-.357-.208-.432-.69-.175-1.026.47-.615.913-1.272 1.32-1.956.143-.242.42-.365.688-.293 1.05.275 2.05.275 3.099 0 .269-.071.545.05.688.293.407.684.85 1.341 1.32 1.956.257.337.182.818-.175 1.026-.473.276-2.15.881-3.553 1.85-.178.098-.394.065-.533-.097z" /></svg>
            </div>
            <div>
                <small class="text-gray-500 block font-medium mb-1">Staff</small>
                <h4 class="font-bold text-2xl text-[#0ea5f0] counter" data-target="{{ $totalStaff }}">0</h4>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center">
            <div class="w-14 h-14 bg-gradient-to-br from-[#f59e0b] to-[#d97706] rounded-xl flex items-center justify-center mr-4 text-white shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" /></svg>
            </div>
            <div>
                <small class="text-gray-500 block font-medium mb-1">Admin</small>
                <h4 class="font-bold text-2xl text-[#f59e0b] counter" data-target="{{ $totalAdmin }}">0</h4>
            </div>
        </div>
    </div>
  </div>

  <!-- Filter & Search -->
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
      <form action="{{ route('admin.kelola-user') }}" method="GET">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
              <div class="md:col-span-1">
                  <label class="block font-semibold text-gray-700 mb-2 text-sm">Cari User</label>
                  <div class="relative">
                      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                      </div>
                      <input type="text" name="search" class="w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" placeholder="Nama, NIM, atau email..." value="{{ request('search') }}">
                  </div>
              </div>

              <div>
                  <label class="block font-semibold text-gray-700 mb-2 text-sm">Role</label>
                  <div class="relative">
                      <select name="jenis_pekerjaan_id" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white">
                          <option value="" {{ request('jenis_pekerjaan_id') == '' ? 'selected' : '' }}>Semua Role</option>
                          @foreach($jenisPekerjaan as $kerja)
                              <option value="{{ $kerja->jenis_pekerjaan_id }}" {{ request('jenis_pekerjaan_id') == $kerja->jenis_pekerjaan_id ? 'selected' : '' }}>
                                  {{ $kerja->nama_pekerjaan }}
                              </option>
                          @endforeach
                      </select>
                      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                      </div>
                  </div>
              </div>

              <div>
                  <label class="block font-semibold text-gray-700 mb-2 text-sm">Program Studi</label>
                  <div class="relative">
                      <select name="prodi_id" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white">
                          <option value="" {{ request('prodi_id') == '' ? 'selected' : '' }}>Semua Prodi</option>
                          @foreach($prodis as $prodi)
                              <option value="{{ $prodi->prodi_id }}" {{ request('prodi_id') == $prodi->prodi_id ? 'selected' : '' }}>
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
                  <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-[#0ea5f0] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" /></svg>
                      Filter
                  </button>
              </div>
          </div>
      </form>
  </div>

  <!-- User Table -->
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="p-6 border-b border-gray-100">
        <h5 class="font-bold text-lg text-gray-800">Daftar User</h5>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Nama</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">NIM/NIP</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Email</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Prodi/Unit</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Role</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Bergabung</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-sm text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($users as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#6B21A8] to-[#0ea5f0] flex items-center justify-center text-white font-bold mr-3">
                                {{ substr($user->nama, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800 text-sm">{{ $user->nama }}</div>
                                <small class="text-gray-500 text-xs">{{ $user->pekerjaanfk->nama_pekerjaan ?? 'User' }}</small>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $user->nim ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $user->prodifk->nama_prodi ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if($user->pekerjaanfk->nama_pekerjaan == 'Mahasiswa')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Mahasiswa</span>
                        @elseif(in_array($user->pekerjaanfk->nama_pekerjaan, ['Dosen/Peneliti', 'Tendik']))
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Staff</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $user->pekerjaanfk->nama_pekerjaan }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.users.edit', $user->user_id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                            </a>
                            <a href="{{ route('admin.kelola-user.detail', $user->user_id) }}" class="p-2 text-teal-600 hover:bg-teal-50 rounded-lg transition-colors" title="Detail">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </a>
                            <form action="{{ route('admin.kelola-user.destroy', $user->user_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus user ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-3 text-gray-300"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg>
                            <span class="font-medium text-lg">Tidak ada data user.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer bg-white border-0 p-6 border-t border-gray-100 flex justify-between items-center">
        <small class="text-gray-500">
            Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} user
        </small>
        <div>
            {{ $users->links() }}
        </div>
    </div>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <div class="p-6 border-b border-gray-100">
          <h5 class="font-bold text-lg text-gray-800">Daftar Admin</h5>
      </div>
      <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
              <thead class="bg-gray-50/50 border-b border-gray-100">
                  <tr>
                      <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Nama</th>
                      <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Email</th>
                      <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Role</th>
                      <th class="px-6 py-4 font-semibold text-gray-700 text-sm">Bergabung</th>
                      <th class="px-6 py-4 font-semibold text-gray-700 text-sm text-center">Aksi</th>
                  </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                  @forelse ($admins as $admin)
                  <tr class="hover:bg-gray-50 transition-colors">
                      <td class="px-6 py-4">
                          <div class="flex items-center">
                              <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#f59e0b] to-[#d97706] flex items-center justify-center text-white font-bold mr-3">
                                  {{ substr($admin->nama, 0, 1) }}
                              </div>
                              <div>
                                  <div class="font-semibold text-gray-800 text-sm">{{ $admin->nama }}</div>
                                  <small class="text-gray-500 text-xs">Administrator</small>
                              </div>
                          </div>
                      </td>
                      <td class="px-6 py-4 text-sm text-gray-600">{{ $admin->email }}</td>
                      <td class="px-6 py-4">
                          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Admin</span>
                      </td>
                      <td class="px-6 py-4 text-sm text-gray-500">
                          {{ $admin->created_at->format('d M Y') }}
                      </td>
                      <td class="px-6 py-4 text-center">
                          <div class="flex justify-center space-x-2">
                              <a href="#" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg></a>
                              <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors disabled:opacity-50" title="Hapus" @if($admin->id == 1) disabled @endif>
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                              </button>
                          </div>
                      </td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                          <span class="font-medium text-lg">Tidak ada data admin.</span>
                      </td>
                  </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
      <div class="card-footer bg-white border-0 p-6 border-t border-gray-100 flex justify-between items-center">
          <small class="text-gray-500">
              Menampilkan {{ $admins->firstItem() }} - {{ $admins->lastItem() }} dari {{ $admins->total() }} admin
          </small>
          <div>
              {{ $admins->links() }}
          </div>
      </div>
  </div>

</div>

<!-- Modal Add User -->
<div id="addUserModal" class="fixed inset-0 z-[1001] hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-all duration-300 opacity-0">
  <div class="bg-white rounded-2xl w-full max-w-3xl mx-4 shadow-2xl transform scale-95 transition-all duration-300" id="modalContent">
    <div class="p-6 bg-gradient-to-r from-[#6B21A8] to-[#0ea5f0] rounded-t-2xl flex justify-between items-center text-white">
      <h5 class="text-xl font-bold flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" /></svg>
        Tambah User Baru
      </h5>
      <button type="button" onclick="toggleUserModal()" class="text-white/80 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
      </button>
    </div>
    <div class="p-8">
      <form id="formTambahUser" action="{{route('admin.kelola-user.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" name="nama" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" required>
          </div>

          <div>
            <label class="block font-semibold text-gray-700 mb-2">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" placeholder="@ftmm.unair.ac.id" required>
          </div>

          <div>
            <label class="block font-semibold text-gray-700 mb-2">NIM/NIP</label>
            <input type="text" name="nim" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent">
          </div>

          <div>
            <label class="block font-semibold text-gray-700 mb-2">No. Telepon</label>
            <input type="tel" name="nomor_telepon" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent">
          </div>

          <div>
            <label class="block font-semibold text-gray-700 mb-2">Role</label>
            <div class="relative">
                <select name="jenis_pekerjaan_id" id="role" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white" required>
                    <option value="">-- Pilih Role --</option>
                    @foreach ($jenisPekerjaan as $jenis)
                        <option value="{{ $jenis->jenis_pekerjaan_id }}">{{ $jenis->nama_pekerjaan }}</option>
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
                <select name="prodi_id" id="prodi" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white" required>
                    <option value="">-- Pilih Prodi --</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->prodi_id }}">{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </div>
            </div>
          </div>

          <div>
            <label class="block font-semibold text-gray-700 mb-2">Password</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" required>
          </div>

          <div>
            <label class="block font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" required>
          </div>
        </div>
      </form>
    </div>
    <div class="p-6 border-t border-gray-100 flex justify-end gap-3">
      <button type="button" class="px-5 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all" onclick="toggleUserModal()">Batal</button>
      <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-[#6B21A8] to-[#0ea5f0] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all" form="formTambahUser">Simpan User</button>
    </div>
  </div>
</div>

<script>
// Counter Animation
document.addEventListener('DOMContentLoaded', function() {
  const counters = document.querySelectorAll('.counter');
  
  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute('data-target'));
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;

    const updateCounter = () => {
      current += step;
      if (current < target) {
        counter.textContent = Math.floor(current);
        requestAnimationFrame(updateCounter);
      } else {
        counter.textContent = target;
      }
    };
    
    updateCounter();
  });
});

// Modal Logic
function toggleUserModal() {
    const modal = document.getElementById('addUserModal');
    const content = document.getElementById('modalContent');

    if (modal.classList.contains('hidden')) {
        // Open
        modal.classList.remove('hidden', 'opacity-0');
        modal.classList.add('flex', 'opacity-100');
        setTimeout(() => {
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);
    } else {
        // Close
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300);
    }
}
</script>
@endsection
