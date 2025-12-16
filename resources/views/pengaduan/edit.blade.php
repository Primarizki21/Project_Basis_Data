@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6">
  <!-- Page Header -->
  <div class="mb-8 flex items-center">
    @if(Auth::guard('admin')->check())
      <a href="{{ route('admin.kelola-pengaduan') }}" class="mr-4 p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors border border-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
      </a>
    @else
      <a href="{{ route('riwayat') }}" class="mr-4 p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors border border-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
      </a>
    @endif
    <div>
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit Pengaduan</h2>
      <p class="text-gray-500">Ubah detail pengaduan Anda sebelum diproses</p>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
      <!-- Alert Info -->
      <div class="bg-[#0ea5f0]/10 border-l-4 border-[#0ea5f0] text-[#0284c7] p-4 rounded-r-xl mb-6 flex items-start">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3 flex-shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
        <div>
          Anda hanya dapat mengedit pengaduan yang belum diproses oleh admin.
        </div>
      </div>

      <!-- Form Card -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
          {{-- Ini untuk cek yang update user atau admin --}}
          <form action="{{ Auth::guard('admin')->check() ? route('admin.pengaduan.update', $pengaduan) : route('pengaduan.update', $pengaduan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if(Auth::guard('admin')->check())
            <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
                <h5 class="font-bold text-gray-800 text-lg mb-4 border-b border-gray-200 pb-2">Panel Admin</h5>

                @if($pengaduan->tindakLanjut->isNotEmpty())
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">Riwayat Tindak Lanjut</label>
                    <div class="space-y-2">
                        @foreach($pengaduan->tindakLanjut->sortByDesc('created_at') as $tindakLanjut)
                        <div class="bg-white p-3 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex justify-between items-start mb-1">
                                <p class="text-sm text-gray-800">{{ $tindakLanjut->deskripsi }}</p>
                                <small class="text-xs text-gray-500 whitespace-nowrap ml-2">{{ $tindakLanjut->created_at->diffForHumans() }}</small>
                            </div>
                            <small class="text-xs text-gray-500">Oleh: Admin ID {{ $tindakLanjut->admin_id }}</small>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2">Ubah Status Pengaduan</label>
                    <div class="relative">
                        <select name="status_pengaduan" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white" required>
                            @foreach(['Menunggu', 'Diproses', 'Selesai'] as $status)
                                <option value="{{ $status }}" @if(old('status_pengaduan', $pengaduan->status_pengaduan) == $status) selected @endif>{{ $status }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2">Tambah Catatan Tindak Lanjut Baru</label>
                    <textarea name="deskripsi_tindak_lanjut" rows="4" required class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent">{{ old('deskripsi_tindak_lanjut') }}</textarea>
                    <small class="text-gray-500 mt-1 block">Catatan ini akan ditambahkan sebagai riwayat baru.</small>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700 mb-2">Upload Bukti Investigasi (Opsional)</label>
                    <input type="file" name="bukti[]" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#7C3AED]/10 file:text-[#7C3AED] hover:file:bg-[#7C3AED]/20" accept="image/*,.pdf">
                    <small class="text-gray-500 mt-1 block">Bukti yang di-upload di sini akan ditandai sebagai bukti dari admin.</small>
                </div>
            </div>
            @endif

            <!-- Kategori -->
            <div class="mb-6">
              <label class="block font-semibold text-gray-700 mb-2">Kategori Pengaduan</label>
              <div class="relative">
                  <select name="kategori_komplain_id" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori_komplain as $k)
                      <option value="{{ $k->kategori_komplain_id }}" @if($pengaduan->kategori_komplain_id == $k->kategori_komplain_id) selected @endif>
                        {{ $k->jenis_komplain }}
                      </option>
                    @endforeach
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                  </div>
              </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
              <label class="block font-semibold text-gray-700 mb-2">Deskripsi Kejadian</label>
              <textarea name="deskripsi_kejadian" rows="6" required class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent">{{ $pengaduan->deskripsi_kejadian }}</textarea>
              <small class="text-gray-500 mt-1 block">Jelaskan secara rinci mengenai kejadian yang anda alami</small>
            </div>

            <!-- Tanggal Kejadian -->
            <div class="mb-6">
              <label class="block font-semibold text-gray-700 mb-2">Tanggal Kejadian</label>
              <input type="date" name="tanggal_kejadian" value="{{ $pengaduan->tanggal_kejadian }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent">
            </div>

            <!-- Status Pelapor -->
            <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-2">Status Pelapor <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="status_pelapor" required class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white">
                        <option value="">-- Pilih Status --</option>
                        <option value="Korban" {{ old('status_pelapor', $pengaduan->status_pelapor) == 'Korban' ? 'selected' : '' }}>Korban</option>
                        <option value="Keluarga" {{ old('status_pelapor', $pengaduan->status_pelapor) == 'Keluarga' ? 'selected' : '' }}>Keluarga Korban</option>
                        <option value="Teman" {{ old('status_pelapor', $pengaduan->status_pelapor) == 'Teman' ? 'selected' : '' }}>Teman/Kenalan</option>
                        <option value="Saksi" {{ old('status_pelapor', $pengaduan->status_pelapor) == 'Saksi' ? 'selected' : '' }}>Saksi Mata</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                    </div>
                </div>
                <small class="text-gray-500 mt-1 block">Anda sebagai apa dalam kejadian ini?</small>
            </div>

            <!-- Upload Bukti -->
            @if(!Auth::guard('admin')->check())
                <div class="mb-6">
                    <label class="block font-semibold text-gray-700 mb-2">Upload Bukti Tambahan (Opsional)</label>
                    <input type="file" name="bukti[]" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#7C3AED]/10 file:text-[#7C3AED] hover:file:bg-[#7C3AED]/20" accept="image/*,.pdf">
                    <small class="text-gray-500 mt-1 block">Biarkan kosong jika tidak ingin menambah bukti</small>
                </div>
            @endif

            <!-- Existing Files -->
            @if($pengaduan->bukti && count($pengaduan->bukti) > 0)
            <div class="mb-8">
                <label class="block font-semibold text-gray-700 mb-3">Bukti yang Sudah Ada</label>
                <div class="space-y-3">
                    @foreach($pengaduan->bukti as $bukti)
                        @php
                            $filePath = asset('storage/' . $bukti->file_path);
                            $fileName = $bukti->nama_file;
                            $fileSizeKB = (isset($bukti->ukuran_file)) ? round($bukti->ukuran_file / 1024, 2) : null;
                            $extension = strtolower(pathinfo($bukti->file_path, PATHINFO_EXTENSION));
                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
                            $isImage = in_array($extension, $imageExtensions);
                        @endphp

                        <div class="flex items-center p-3 bg-gray-50 rounded-xl border border-gray-100 gap-3" id="existing-file-{{ $bukti->bukti_pengaduan_id }}">
                            
                            @if($isImage)
                                <img src="{{ $filePath }}" alt="{{ $fileName }}" class="w-10 h-10 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity" onclick="showImageModal('{{ $filePath }}')">
                            @else
                                <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                                </div>
                            @endif

                            <div class="flex-1 min-w-0">
                                <div class="font-medium text-gray-700 text-sm truncate">{{ $fileName }}</div>
                                @if($fileSizeKB)
                                    <small class="text-gray-500">{{ $fileSizeKB }} KB</small>
                                @endif
                            </div>

                            <a href="{{ $filePath }}" target="_blank" class="p-2 text-gray-400 hover:text-[#7C3AED] hover:bg-[#7C3AED]/10 rounded-lg transition-colors" title="Buka di tab baru">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                            </a>

                            <button type="button" class="text-red-500 hover:text-red-700 p-1" onclick="markForDeletion(this, {{ $bukti->bukti_pengaduan_id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </button>
                            
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div id="deletedBuktiContainer"></div>

            <!-- Modal Preview Gambar -->
            <div id="imageModal" class="fixed inset-0 z-[1001] hidden items-center justify-center bg-black/85" onclick="closeImageModal()">
              <span class="absolute top-4 right-8 text-white text-4xl font-bold cursor-pointer hover:text-gray-300 z-[1002]" onclick="closeImageModal(event)">&times;</span>
              <div class="relative max-w-[90%] max-h-[90vh]" onclick="event.stopPropagation()">
                <img class="block max-w-full max-h-[90vh] object-contain animate-[zoom_0.3s_ease-out]" id="modalImage">
              </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
              <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#6B21A8] to-[#7C3AED] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3.75m-3-3.75l-3 3.75M12 9.75V9A2.25 2.25 0 009.75 6.75H5.625A2.25 2.25 0 003.375 9v5.5a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021.375 16.5V9.75a2.25 2.25 0 00-2.25-2.25h-7.5" /></svg>
                Simpan Perubahan
              </button>
              @if(Auth::guard('admin')->check())
              <a href="{{ route('admin.kelola-pengaduan') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300">
                Batal
              </a>
              @else
              <a href="{{ route('riwayat') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300">
                Batal
              </a>
              @endif
            </div>
          </form>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
      <div class="bg-gradient-to-br from-[#f59e0b] to-[#d97706] rounded-2xl shadow-lg p-6 text-white">
        <h6 class="font-bold text-lg mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            Perhatian
        </h6>
        <ul class="space-y-2 text-sm text-white/90 pl-1">
            <li class="flex items-start"><span class="mr-2">•</span> Setelah diproses admin, pengaduan tidak dapat diedit</li>
            <li class="flex items-start"><span class="mr-2">•</span> Pastikan informasi yang Anda berikan akurat</li>
            <li class="flex items-start"><span class="mr-2">•</span> Perubahan akan langsung tersimpan</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<style>
@keyframes zoom {
  from {transform: scale(0.8)}
  to {transform: scale(1)}
}
</style>

<script>
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');

    function showImageModal(src) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modalImage.src = src;
    }

    function closeImageModal(event) {
        if (event) event.stopPropagation();
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function markForDeletion(iconElement, buktiId) {
        if (!confirm('Anda yakin ingin menghapus bukti ini? File akan dihapus permanen saat Anda menyimpan perubahan.')) {
            return;
        }

        // 1. Temukan elemen container file terdekat (menggunakan ID yang kita set di loop)
        const fileItem = document.getElementById('existing-file-' + buktiId);

        if (fileItem) {
            // Sembunyikan dari tampilan
            fileItem.style.display = 'none';
        }

        const container = document.getElementById('deletedBuktiContainer');

        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'delete_bukti[]';
        hiddenInput.value = buktiId;
        container.appendChild(hiddenInput);
    }
</script>
@endsection
