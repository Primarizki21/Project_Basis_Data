@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6 animate-[fadeIn_0.6s_ease-out]">
  <!-- Welcome Header -->
  <div class="mb-8">
    <div class="bg-gradient-to-br from-[#6B21A8] via-[#7C3AED] to-[#0ea5f0] rounded-2xl shadow-lg border-none p-8">
      <div class="text-white">
        <h3 class="font-bold text-2xl lg:text-3xl mb-2">Dashboard Administrator 🎯</h3>
        <p class="mb-0 opacity-80 text-lg">Selamat datang kembali, {{ Auth::guard('admin')->user()->nama ?? 'Admin' }}!</p>
      </div>
    </div>
  </div>

  <!-- Quick Stats -->
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-[slideUp_0.6s_ease-out_both] delay-100">
        <div class="flex items-center justify-between">
            <div>
                <small class="text-gray-500 block font-medium mb-1">Total Pengaduan</small>
                <h3 class="font-bold text-3xl text-[#6B21A8] mb-0 counter" data-target="{{ $totalPengaduan }}">0</h3>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-[#6B21A8] to-[#7C3AED] rounded-xl flex items-center justify-center shadow-md text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-[slideUp_0.6s_ease-out_both] delay-200">
        <div class="flex items-center justify-between">
            <div>
                <small class="text-gray-500 block font-medium mb-1">Belum Diproses</small>
                <h3 class="font-bold text-3xl text-[#ef4444] mb-0 counter" data-target="{{ $belumDiproses }}">0</h3>
                <small class="text-red-500 flex items-center mt-1 text-xs font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                    Perlu tindakan
                </small>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-[#ef4444] to-[#dc2626] rounded-xl flex items-center justify-center shadow-md text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-[slideUp_0.6s_ease-out_both] delay-300">
        <div class="flex items-center justify-between">
            <div>
                <small class="text-gray-500 block font-medium mb-1">Selesai Bulan Ini</small>
                <h3 class="font-bold text-3xl text-[#10b981] mb-0 counter" data-target="{{ $selesaiBulanIni }}">0</h3>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-[#10b981] to-[#059669] rounded-xl flex items-center justify-center shadow-md text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 animate-[slideUp_0.6s_ease-out_both] delay-400">
        <div class="flex items-center justify-between">
            <div>
                <small class="text-gray-500 block font-medium mb-1">Total User Aktif</small>
                <h3 class="font-bold text-3xl text-[#0ea5f0] mb-0 counter" data-target="{{ $totalUsers }}">0</h3>
                <small class="text-gray-500 flex items-center mt-1 text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                    Mahasiswa & Staff
                </small>
            </div>
            <div class="w-14 h-14 bg-gradient-to-br from-[#0ea5f0] to-[#0284c7] rounded-xl flex items-center justify-center shadow-md text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg>
            </div>
        </div>
    </div>

  <!-- Recent Activities -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="lg:col-span-1">
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
          <h5 class="font-bold text-gray-800 text-lg">Aktivitas Terbaru</h5>
          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
            <span class="w-2 h-2 mr-1.5 bg-blue-500 rounded-full animate-pulse"></span>
            Live
          </span>
        </div>
        <div class="p-6">
          <div class="space-y-6">
              @forelse($activities as $activity)
                  <div class="flex relative pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                      <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center text-white mr-4 shadow-sm" style="background: {{ $activity->icon_color }};">
                          @if(str_contains($activity->icon_class, 'pencil'))
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>
                          @elseif(str_contains($activity->icon_class, 'check'))
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                          @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                          @endif
                      </div>
                      <div class="flex-1 min-w-0">
                          @if ($activity->subject && $activity->subject_type === 'App\Models\Pengaduan')
                              <p class="text-sm text-gray-800 mb-1">
                                  <strong>Pengaduan
                                  <a href="{{ route('admin.pengaduan.edit', $activity->subject->pengaduan_id) }}" class="text-[#7C3AED] hover:underline">
                                      #{{ $activity->subject->pengaduan_id }}
                                  </a>:</strong> {{ $activity->title_summary }}
                              </p>
                              <div class="text-xs text-gray-500 mb-1">
                                  @if ($activity->admin)
                                      Oleh: {{ $activity->admin->nama }} (Admin)
                                  @elseif ($activity->user)
                                      Oleh: {{ $activity->user->nama }}
                                  @elseif (is_null($activity->subject->user_id))
                                      Oleh: Anonim
                                  @endif
                              </div>
                              <p class="text-sm text-gray-600 mb-1">{{ $activity->description }}</p>
                              @if ($activity->title_summary != "Perubahan Bukti")
                                  <p class="text-xs text-gray-400 italic">
                                      "{{ Str::limit($activity->subject->deskripsi_kejadian, 80) }}"
                                  </p>
                              @endif
                          @else
                              <p class="text-sm font-semibold text-gray-800 mb-1">{{ $activity->description }}</p>
                              <!-- Similar logic for other types can be added here if needed -->
                          @endif

                          <span class="text-xs text-gray-400 mt-2 block">{{ $activity->created_at->diffForHumans() }}</span>
                      </div>
                  </div>
              @empty
                  <div class="flex flex-col items-center justify-center py-8 text-gray-400">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                      <p>Belum ada aktivitas.</p>
                  </div>
              @endforelse
          </div>
        </div>
      </div>
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
    
    if (target > 0) {
        updateCounter();
    } else {
        counter.textContent = 0;
    }
  });
});
</script>
@endsection
