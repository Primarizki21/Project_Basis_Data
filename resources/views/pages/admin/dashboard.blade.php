/* stylelint-disable */
@extends('layouts.app')

@section('content')
<div class="container-fluid animate-fade-in">
  <!-- Welcome Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6B21A8 0%, #7C3AED 50%, #0ea5f0 100%); border-radius: 15px;">
        <div class="card-body p-4">
          <div class="text-white">
            <h3 class="fw-bold mb-2">Dashboard Administrator 🎯</h3>
            <p class="mb-0 opacity-75">Selamat datang kembali, {{ Auth::guard('admin')->user()->nama ?? 'Admin' }}!</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Stats -->
  <div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6 animate-on-scroll" style="animation-delay: 0.1s;">
        <div class="card border-0 shadow-sm hover-lift-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted d-block mb-1">Total Pengaduan</small>
                        <h3 class="fw-bold mb-0 counter" data-target="{{ $totalPengaduan }}" style="color: #6B21A8;">0</h3>
                    </div>
                    <div class="icon-box" style="width: 55px; height: 55px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-file-earmark-text text-white" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 animate-on-scroll" style="animation-delay: 0.2s;">
        <div class="card border-0 shadow-sm hover-lift-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted d-block mb-1">Belum Diproses</small>
                        <h3 class="fw-bold mb-0 counter" data-target="{{ $belumDiproses }}" style="color: #ef4444;">0</h3>
                        <small class="text-danger"><i class="bi bi-exclamation-triangle"></i> Perlu tindakan</small>
                    </div>
                    <div class="icon-box" style="width: 55px; height: 55px; background: linear-gradient(135deg, #ef4444, #dc2626); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-hourglass-split text-white" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 animate-on-scroll" style="animation-delay: 0.3s;">
        <div class="card border-0 shadow-sm hover-lift-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted d-block mb-1">Selesai Bulan Ini</small>
                        <h3 class="fw-bold mb-0 counter" data-target="{{ $selesaiBulanIni }}" style="color: #10b981;">0</h3>
                    </div>
                    <div class="icon-box" style="width: 55px; height: 55px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-check-circle text-white" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 animate-on-scroll" style="animation-delay: 0.4s;">
        <div class="card border-0 shadow-sm hover-lift-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-muted d-block mb-1">Total User Aktif</small>
                        <h3 class="fw-bold mb-0 counter" data-target="{{ $totalUsers }}" style="color: #0ea5f0;">0</h3>
                        <small class="text-muted"><i class="bi bi-people"></i> Mahasiswa & Staff</small>
                    </div>
                    <div class="icon-box" style="width: 55px; height: 55px; background: linear-gradient(135deg, #0ea5f0, #0284c7); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-people text-white" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Charts Row
  <div class="row g-4 mb-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Tren Pengaduan 6 Bulan Terakhir</h5>
        </div>
        <div class="card-body p-4">
          <canvas id="trendChart" height="80"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Kategori Pengaduan</h5>
        </div>
        <div class="card-body p-4">
          <canvas id="categoryChart"></canvas>
        </div>
      </div>
    </div>
  </div> -->

  <!-- Recent Activities -->
  <div class="row g-4">
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
          <h5 class="fw-bold mb-0">Aktivitas Terbaru</h5>
          <span class="badge bg-primary">Live</span>
        </div>
        <div class="card-body p-0">
          <div class="activity-timeline">

              @forelse($activities as $activity)
                <div class="activity-item">
                    <div class="activity-icon" style="background: {{ $activity->icon_color }};">
                        <i class="bi {{ $activity->icon_class }}"></i>
                    </div>
                    <div class="activity-content">
                        <strong>{{ $activity->description }}</strong>
                        @if ($activity->user)
                            <p class="text-muted mb-0 small">
                                Oleh: {{ $activity->user->nama }} ({{ $activity->user->email }})
                            </p>
                        @endif

                        @if ($activity->subject)
                            @if ($activity->subject_type === 'App\Models\Pengaduan')
                                <p class="text-muted mb-0 small fst-italic">
                                    "{{ Str::limit($activity->subject->deskripsi_kejadian, 50) }}"
                                </p>
                            @elseif ($activity->subject_type === 'App\Models\User')
                                <p class="text-muted mb-0 small">
                                    {{ $activity->subject->email }}
                                </p>
                            @endif
                        @endif
                        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                    </div>
                </div>

              @empty
                  {{-- Ini akan ditampilkan jika variabel $activities kosong --}}
                  <div class="activity-item">
                      <div class="activity-icon" style="background: #6c757d;">
                          <i class="bi bi-info-circle"></i>
                      </div>
                      <div class="activity-content">
                          <strong>Belum ada aktivitas.</strong>
                          <p class="text-muted mb-0 small">Semua aktivitas terbaru akan muncul di sini.</p>
                      </div>
                  </div>
              @endforelse

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.animate-fade-in {
  animation: fadeIn 0.6s ease-out;
}

.animate-on-scroll {
  animation: slideUp 0.6s ease-out both;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.hover-lift-card {
  transition: all 0.3s ease;
}

.hover-lift-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.12) !important;
}

.activity-timeline {
  padding: 1.5rem;
}

.activity-item {
  display: flex;
  padding-bottom: 1.5rem;
  margin-bottom: 1.5rem;
  border-bottom: 1px solid #e5e7eb;
  position: relative;
}

.activity-item:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}

.activity-icon {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  margin-right: 1rem;
  flex-shrink: 0;
}

.activity-content {
  flex: 1;
}

.activity-content strong {
  display: block;
  margin-bottom: 0.25rem;
}

.priority-item {
  transition: all 0.3s ease;
}

.priority-item:hover {
  transform: translateX(5px);
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

  // Trend Chart
  const trendCtx = document.getElementById('trendChart').getContext('2d');
  new Chart(trendCtx, {
    type: 'line',
    data: {
      labels: ['Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt'],
      datasets: [{
        label: 'Total Pengaduan',
        data: [45, 52, 48, 63, 58, 67],
        borderColor: '#6B21A8',
        backgroundColor: 'rgba(107, 33, 168, 0.1)',
        tension: 0.4,
        fill: true
      }, {
        label: 'Selesai',
        data: [38, 45, 42, 55, 50, 58],
        borderColor: '#10b981',
        backgroundColor: 'rgba(16, 185, 129, 0.1)',
        tension: 0.4,
        fill: true
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          position: 'top',
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Category Chart
  const categoryCtx = document.getElementById('categoryChart').getContext('2d');
  new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
      labels: ['Akademik', 'Fasilitas', 'Kekerasan', 'Kemahasiswaan', 'Lainnya'],
      datasets: [{
        data: [45, 30, 8, 12, 5],
        backgroundColor: [
          '#6B21A8',
          '#0ea5f0',
          '#ef4444',
          '#f59e0b',
          '#8b5cf6'
        ]
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          position: 'bottom',
        }
      }
    }
  });
});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection