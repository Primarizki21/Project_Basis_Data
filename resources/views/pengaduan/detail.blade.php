@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6">
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
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Detail Pengaduan</h2>
            <p class="text-gray-500">Informasi lengkap mengenai pengaduan Anda</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                @if(Auth::guard('admin')->check())
                <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
                    <h5 class="font-bold text-gray-800 text-lg mb-4 border-b border-gray-200 pb-2">Panel Admin</h5>
                    <div class="mb-3">
                        <label class="block font-semibold text-gray-500 text-xs uppercase tracking-wide mb-1">Status Pengaduan</label>
                        <div class="font-bold text-lg
                            @if($pengaduan->status_pengaduan == 'Selesai') text-green-600
                            @elseif($pengaduan->status_pengaduan == 'Diproses') text-yellow-600
                            @else text-gray-600 @endif">
                            {{ $pengaduan->status_pengaduan }}
                        </div>
                    </div>
                </div>
                @endif

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <label class="block font-semibold text-gray-500 text-xs uppercase tracking-wide mb-2">Kategori Pengaduan</label>
                    <div>
                        <span class="inline-block px-3 py-1 rounded text-white text-sm font-medium" style="background-color: {{ $warnaKategori[$pengaduan->kategoriKomplain->jenis_komplain] ?? '#6c757d' }};">
                            {{ $pengaduan->kategoriKomplain->jenis_komplain ?? '-' }}
                        </span>
                    </div>
                </div>

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <label class="block font-semibold text-gray-500 text-xs uppercase tracking-wide mb-2">Deskripsi Kejadian</label>
                    <div class="text-gray-800 font-medium leading-relaxed">{{ $pengaduan->deskripsi_kejadian }}</div>
                </div>

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <label class="block font-semibold text-gray-500 text-xs uppercase tracking-wide mb-2">Tanggal Kejadian</label>
                    <div class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->translatedFormat('l, d F Y') }}</div>
                </div>

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <label class="block font-semibold text-gray-500 text-xs uppercase tracking-wide mb-2">Status Pengaduan</label>
                    <div>
                        @if($pengaduan->status_pengaduan == 'Selesai')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Selesai
                            </span>
                        @elseif($pengaduan->status_pengaduan == 'Diproses')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 018.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.439.72 1.063.72 1.73 0 .666-.225 1.29-.72 1.73m0-3.46a24.347 24.347 0 010 3.46" /></svg>
                                Diproses
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Menunggu
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <label class="block font-semibold text-gray-500 text-xs uppercase tracking-wide mb-2">Status Pelapor</label>
                    <div class="text-gray-800 font-medium">{{ $pengaduan->status_pelapor }}</div>
                </div>

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <label class="block font-semibold text-gray-500 text-xs uppercase tracking-wide mb-2">Tanggal Dibuat</label>
                    <div class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('l, d F Y') }}</div>
                </div>

                <div class="mb-6 pb-4">
                    <label class="block font-semibold text-gray-500 text-xs uppercase tracking-wide mb-3">Bukti Terlampir</label>
                    @if($pengaduan->bukti && count($pengaduan->bukti) > 0)
                        <div class="space-y-3">
                            @foreach($pengaduan->bukti as $bukti)
                                @php
                                    $filePath = asset('storage/' . $bukti->file_path);
                                    $fileName = $bukti->nama_file;
                                    $extension = strtolower(pathinfo($bukti->file_path, PATHINFO_EXTENSION));
                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
                                    $isImage = in_array($extension, $imageExtensions);
                                    $fileSizeKB = (isset($bukti->ukuran_file)) ? round($bukti->ukuran_file / 1024, 2) : null;
                                @endphp

                                <div class="flex items-center p-3 bg-gray-50 rounded-xl border border-gray-100 gap-3">
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
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-gray-500 text-sm">Tidak ada bukti yang dilampirkan.</div>
                    @endif
                </div>

                <!-- Modal Preview Gambar -->
                <div id="imageModal" class="fixed inset-0 z-[1001] hidden items-center justify-center bg-black/85" onclick="closeImageModal()">
                    <span class="absolute top-4 right-8 text-white text-4xl font-bold cursor-pointer hover:text-gray-300 z-[1002]" onclick="closeImageModal(event)">&times;</span>
                    <div class="relative max-w-[90%] max-h-[90vh]" onclick="event.stopPropagation()">
                        <img class="block max-w-full max-h-[90vh] object-contain animate-[zoom_0.3s_ease-out]" id="modalImage">
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                 <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h5 class="font-bold text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-[#6B21A8]"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Riwayat Tindak Lanjut
                    </h5>
                </div>
                <div class="p-6">
                    @forelse($pengaduan->tindakLanjut->sortByDesc('created_at') as $tindakLanjut)
                        <div class="flex mb-4 pb-4 border-b border-gray-100 last:border-0 last:mb-0 last:pb-0">
                            <div class="mr-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800 mb-1 leading-relaxed">{{ $tindakLanjut->deskripsi }}</p>
                                <div class="flex items-center text-xs text-gray-500">
                                    <strong class="mr-2">{{ $tindakLanjut->handler->nama ?? 'Admin' }}</strong>
                                    <span>•</span>
                                    <span class="ml-2">{{ $tindakLanjut->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <p>Belum ada tindak lanjut.</p>
                        </div>
                    @endforelse
                </div>
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
</script>
@endsection
