@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6">
  <!-- Page Header -->
  <div class="mb-8 flex items-center">
    <a href="{{ route('beranda') }}" class="mr-4 p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors border border-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
    </a>
    <div>
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Pengaduan Baru</h2>
      <p class="text-gray-500">Sampaikan keluhan atau aspirasi Anda dengan jelas dan lengkap</p>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
      <!-- Form Card -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @php
              $preKategoriId = request()->query('kategori');
              $preKategoriObj = null;
              if($preKategoriId) {
                $preKategoriObj = \App\Models\KategoriKomplain::where('kategori_komplain_id', $preKategoriId)->first();
              }
            @endphp

            @if($preKategoriObj)
                @if ($errors->any())
                    <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6">
                        <strong>Input Gagal, mohon periksa kembali:</strong>
                        <ul class="list-disc pl-5 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              <!-- Show selected kategori from landing -->
              <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-2">Kategori Pengaduan</label>
                <div class="border-2 border-[#6B21A8] rounded-xl p-4 bg-purple-50">
                    <div class="flex justify-between items-center">
                      <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#6B21A8] to-[#7C3AED] rounded-lg flex items-center justify-center mr-4 text-white shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" /></svg>
                        </div>
                        <div>
                          <h6 class="font-bold text-gray-800">{{ $preKategoriObj->jenis_komplain }}</h6>
                          <small class="text-gray-500">{{ Str::limit($preKategoriObj->keterangan ?? 'Kategori dipilih dari landing page', 80) }}</small>
                        </div>
                      </div>
                      <a href="{{ url('/') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-gray-600 text-sm font-medium rounded-lg hover:bg-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                        Ubah
                      </a>
                    </div>
                </div>
                <input type="hidden" name="kategori_komplain_id" value="{{ $preKategoriObj->kategori_komplain_id }}">
              </div>
            @else
              <!-- Fallback: Show select dropdown -->
              <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-2">Kategori Pengaduan <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="kategori_komplain_id" required class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->kategori_komplain_id }}" @if(old('kategori_komplain_id') == $k->kategori_komplain_id) selected @endif>
                        {{ $k->jenis_komplain }}
                        </option>
                    @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                    </div>
                </div>
                <small class="text-gray-500 mt-1 block">Pilih kategori yang sesuai dengan pengaduan Anda</small>
              </div>
            @endif

            <!-- Deskripsi Kejadian -->
            <div class="mb-6">
              <label class="block font-semibold text-gray-700 mb-2">Deskripsi Kejadian <span class="text-red-500">*</span></label>
              <textarea name="deskripsi_kejadian" rows="6" required class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" placeholder="Jelaskan detail pengaduan Anda dengan jelas dan lengkap...">{{ old('deskripsi_kejadian') }}</textarea>
              <small class="text-gray-500 mt-1 block">Minimal 50 karakter. Semakin detail, semakin mudah kami memproses pengaduan Anda.</small>
            </div>

            <!-- Tanggal Kejadian -->
            <div class="mb-6">
              <label class="block font-semibold text-gray-700 mb-2">Tanggal Kejadian</label>
              <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', date('Y-m-d')) }}" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent" max="{{ date('Y-m-d') }}">
              <small class="text-gray-500 mt-1 block">Kapan kejadian ini terjadi?</small>
            </div>

            <!-- Status Pelapor -->
            <div class="mb-6">
              <label class="block font-semibold text-gray-700 mb-2">Status Pelapor <span class="text-red-500">*</span></label>
              <div class="relative">
                  <select name="status_pelapor" required class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent appearance-none bg-white">
                    <option value="">-- Pilih Status --</option>
                    <option value="Korban" {{ old('status_pelapor') == 'Korban' ? 'selected' : '' }}>Korban</option>
                    <option value="Keluarga" {{ old('status_pelapor') == 'Keluarga' ? 'selected' : '' }}>Keluarga Korban</option>
                    <option value="Teman" {{ old('status_pelapor') == 'Teman' ? 'selected' : '' }}>Teman/Kenalan</option>
                    <option value="Saksi" {{ old('status_pelapor') == 'Saksi' ? 'selected' : '' }}>Saksi Mata</option>
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                  </div>
              </div>
              <small class="text-gray-500 mt-1 block">Anda sebagai apa dalam kejadian ini?</small>
            </div>

            <!-- Upload Bukti -->
            <div class="mb-6">
              <label class="block font-semibold text-gray-700 mb-2">Upload Bukti (Opsional)</label>
              <div class="upload-area border-2 border-dashed border-gray-300 rounded-xl transition-all duration-300 hover:border-[#6B21A8] hover:bg-gray-50 cursor-pointer" id="uploadArea">
                <input type="file" name="bukti[]" multiple class="hidden" id="buktiInput" accept="image/*,.pdf">
                <label for="buktiInput" class="cursor-pointer w-full block">
                  <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-[#6B21A8] mb-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3.75m-3-3.75l-3 3.75M12 9.75V9A2.25 2.25 0 009.75 6.75H5.625A2.25 2.25 0 003.375 9v5.5a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021.375 16.5V9.75a2.25 2.25 0 00-2.25-2.25h-7.5" /></svg>
                    <p class="font-semibold text-gray-700 mb-1">Klik untuk upload file</p>
                    <small class="text-gray-500">atau drag & drop file di sini</small>
                    <p class="text-gray-400 text-xs mt-2">Format: JPG, PNG, PDF • Maksimal 2MB per file • Bisa upload lebih dari satu</p>
                  </div>
                </label>
              </div>
              <div id="filePreview" class="mt-4 space-y-2"></div>
            </div>

            <!-- Modal Preview Gambar -->
            <div id="imageModal" class="fixed inset-0 z-[1001] hidden items-center justify-center bg-black/85" onclick="closeImageModal()">
              <span class="absolute top-4 right-8 text-white text-4xl font-bold cursor-pointer hover:text-gray-300 z-[1002]" onclick="closeImageModal(event)">&times;</span>
              <div class="relative max-w-[90%] max-h-[90vh]" onclick="event.stopPropagation()">
                <img class="block max-w-full max-h-[90vh] object-contain animate-[zoom_0.3s_ease-out]" id="modalImage">
              </div>
            </div>

            <!-- Persetujuan -->
            <div class="mb-8">
              <label class="flex items-start cursor-pointer">
                <input type="checkbox" id="agreement" required class="mt-1 w-4 h-4 text-[#7C3AED] border-gray-300 rounded focus:ring-[#7C3AED]">
                <span class="ml-2 text-gray-700 text-sm">
                  Saya menyatakan bahwa informasi yang saya berikan adalah <strong>benar dan dapat dipertanggungjawabkan</strong>
                </span>
              </label>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
              <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#6B21A8] to-[#7C3AED] text-white font-semibold rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                Kirim Pengaduan
              </button>
              <a href="{{ route('beranda') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300">
                Batal
              </a>
            </div>
          </form>
      </div>
    </div>

    <!-- Sidebar Info -->
    <div class="lg:col-span-1 space-y-6">
      <!-- Panduan -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
          <h5 class="font-bold text-gray-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-[#6B21A8]"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
            Panduan Pengaduan
          </h5>
        </div>
        <div class="p-6">
            @php
                $guides = [
                    ['step' => 1, 'title' => 'Pilih Kategori', 'desc' => 'Pilih kategori yang sesuai dengan pengaduan Anda'],
                    ['step' => 2, 'title' => 'Jelaskan Detail', 'desc' => 'Berikan penjelasan yang lengkap dan jelas'],
                    ['step' => 3, 'title' => 'Upload Bukti', 'desc' => 'Lampirkan foto atau dokumen pendukung jika ada'],
                    ['step' => 4, 'title' => 'Kirim & Lacak', 'desc' => 'Pengaduan akan diproses dan Anda dapat melacak statusnya'],
                ];
            @endphp
            @foreach($guides as $guide)
              <div class="flex mb-4 last:mb-0">
                <div class="mr-4">
                  <div class="w-8 h-8 bg-gradient-to-br from-[#6B21A8] to-[#7C3AED] rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md">
                      {{ $guide['step'] }}
                  </div>
                </div>
                <div>
                  <h6 class="font-semibold text-gray-800 text-sm mb-0.5">{{ $guide['title'] }}</h6>
                  <small class="text-gray-500 leading-tight block">{{ $guide['desc'] }}</small>
                </div>
              </div>
            @endforeach
        </div>
      </div>

      <!-- Tips -->
      <div class="rounded-2xl shadow-lg p-6 bg-gradient-to-br from-[#0ea5f0] to-[#0284c7] text-white">
          <h6 class="font-bold mb-4 flex items-center text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.854 1.577-2.087a6.014 6.014 0 012.146 0c.92.233 1.577 1.104 1.577 2.087V18a2.25 2.25 0 002.25 2.25h.15a2.25 2.25 0 002.25-2.25V8.718a2.25 2.25 0 00-.75-1.744A11.03 11.03 0 0015 5.25 11.03 11.03 0 005.25 6.974a2.25 2.25 0 00-.75 1.744V18a2.25 2.25 0 002.25 2.25h.15A2.25 2.25 0 009 18v-2.146a6.014 6.014 0 012.277-4.908l.723-.547" /></svg>
            Tips Pengaduan Efektif
          </h6>
          <ul class="space-y-2 text-sm text-white/90 pl-1">
            <li class="flex items-start"><span class="mr-2">•</span> Gunakan bahasa yang sopan dan jelas</li>
            <li class="flex items-start"><span class="mr-2">•</span> Sertakan bukti foto jika memungkinkan</li>
            <li class="flex items-start"><span class="mr-2">•</span> Sebutkan lokasi dan waktu kejadian</li>
            <li class="flex items-start"><span class="mr-2">•</span> Cantumkan nama jika diperlukan</li>
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
document.addEventListener('DOMContentLoaded', () => {
    const buktiInput = document.getElementById('buktiInput');
    const filePreview = document.getElementById('filePreview');
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const uploadArea = document.getElementById('uploadArea');

    let allFiles = [];

    if (buktiInput) {
        buktiInput.addEventListener('change', function(e) {
            const newFiles = Array.from(e.target.files);
            allFiles = allFiles.concat(newFiles);
            updateFileInput();
            renderFilePreview(allFiles);
        });
    }

    function updateFileInput() {
        const dt = new DataTransfer();
        allFiles.forEach(file => dt.items.add(file));
        buktiInput.files = dt.files;
    }

    function renderFilePreview(files) {
        filePreview.innerHTML = '';
        Array.from(files).forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'flex items-center p-3 bg-gray-50 rounded-xl border border-gray-100 gap-3';

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageUrl = e.target.result;
                    fileItem.innerHTML = `
                        <img src="${imageUrl}" alt="${file.name}" class="w-10 h-10 object-cover rounded-lg cursor-pointer hover:opacity-80 transition-opacity" onclick="showImageModal('${imageUrl}')">
                        <div class="flex-1 min-w-0">
                            <div class="font-medium text-gray-700 text-sm truncate">${file.name}</div>
                            <small class="text-gray-500">${(file.size / 1024).toFixed(2)} KB</small>
                        </div>
                        <button type="button" class="text-red-500 hover:text-red-700 p-1" onclick="removeFile(${index})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </button>
                    `;
                };
                reader.readAsDataURL(file);
            } else {
                fileItem.innerHTML = `
                    <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-gray-700 text-sm truncate">${file.name}</div>
                        <small class="text-gray-500">${(file.size / 1024).toFixed(2)} KB</small>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700 p-1" onclick="removeFile(${index})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </button>
                `;
            }
            filePreview.appendChild(fileItem);
        });
    }

    // Attach to window so it can be called from inline HTML
    window.removeFile = function(index) {
        allFiles.splice(index, 1);
        updateFileInput();
        renderFilePreview(allFiles);
    };

    window.showImageModal = function(src) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modalImage.src = src;
    };

    window.closeImageModal = function(event) {
        if (event) event.stopPropagation();
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    // Drag & drop
    if (uploadArea) {
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('border-[#6B21A8]', 'bg-purple-50');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('border-[#6B21A8]', 'bg-purple-50');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('border-[#6B21A8]', 'bg-purple-50');

            const newFiles = Array.from(e.dataTransfer.files);
            allFiles = allFiles.concat(newFiles);
            updateFileInput();
            renderFilePreview(allFiles);
        });
    }
});
</script>
@endsection
