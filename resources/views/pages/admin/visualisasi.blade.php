@extends('layouts.app')

@section('content')
<div class="container-fluid animate-fade-in">
  <!-- Page Header -->
  <div class="row mb-4">
    <div class="col-12">
      <h2 class="fw-bold mb-2">Visualisasi Data</h2>
      <p class="text-muted">Analisis dan statistik pengaduan dalam bentuk grafik</p>
    </div>
  </div>

  <!-- Time Range Selector -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button class="btn btn-outline-primary active">Hari Ini</button>
              <button class="btn btn-outline-primary">Minggu Ini</button>
              <button class="btn btn-outline-primary">Bulan Ini</button>
              <button class="btn btn-outline-primary">Tahun Ini</button>
            </div>
            <div class="d-flex gap-2">
              <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime('-30 days')) }}">
              <span class="align-self-center">s/d</span>
              <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
              <button class="btn btn-primary">Terapkan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Overview Stats -->
  <div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #6B21A8, #7C3AED);">
        <div class="card-body p-4 text-white">
          <h6 class="mb-3 opacity-75">Total Pengaduan</h6>
          <h2 class="fw-bold mb-2 counter" data-target="1247">0</h2>
          <small class="opacity-75"><i class="bi bi-arrow-up"></i> 18% dari periode sebelumnya</small>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #10b981, #059669);">
        <div class="card-body p-4 text-white">
          <h6 class="mb-3 opacity-75">Tingkat Penyelesaian</h6>
          <h2 class="fw-bold mb-2">87.3%</h2>
          <small class="opacity-75"><i class="bi bi-check2"></i> Target tercapai</small>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
        <div class="card-body p-4 text-white">
          <h6 class="mb-3 opacity-75">Rata-rata Waktu Proses</h6>
          <h2 class="fw-bold mb-2">2.4 hari</h2>
          <small class="opacity-75"><i class="bi bi-clock"></i> Lebih cepat 0.6 hari</small>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #0ea5f0, #0284c7);">
        <div class="card-body p-4 text-white">
          <h6 class="mb-3 opacity-75">Tingkat Kepuasan</h6>
          <h2 class="fw-bold mb-2">4.2/5.0</h2>
          <small class="opacity-75"><i class="bi bi-star-fill"></i> Dari 342 rating</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Row 1 -->
  <div class="row g-4 mb-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h5 class="fw-bold mb-0">Tren Pengaduan Bulanan</h5>
              <small class="text-muted">Data 12 bulan terakhir</small>
            </div>
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-secondary active">Line</button>
              <button class="btn btn-outline-secondary">Bar</button>
            </div>
          </div>
        </div>
        <div class="card-body p-4">
          <canvas id="monthlyTrendChart" height="80"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Kategori Pengaduan</h5>
          <small class="text-muted">Distribusi berdasarkan jenis</small>
        </div>
        <div class="card-body p-4">
          <canvas id="categoryPieChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Row 2 -->
  <div class="row g-4 mb-4">
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Status Pengaduan</h5>
          <small class="text-muted">Real-time status</small>
        </div>
        <div class="card-body p-4">
          <canvas id="statusChart"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Perbandingan Waktu Respon</h5>
          <small class="text-muted">Rata-rata per kategori (dalam hari)</small>
        </div>
        <div class="card-body p-4">
          <canvas id="responseTimeChart" height="80"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Heatmap -->
  <div class="row g-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Heatmap Pengaduan</h5>
          <small class="text-muted">Frekuensi pengaduan per hari dalam seminggu</small>
        </div>
        <div class="card-body p-4">
          <div class="table-responsive">
            <table class="table table-bordered text-center heatmap-table">
              <thead>
                <tr>
                  <th style="width: 100px;">Jam</th>
                  <th>Senin</th>
                  <th>Selasa</th>
                  <th>Rabu</th>
                  <th>Kamis</th>
                  <th>Jumat</th>
                  <th>Sabtu</th>
                  <th>Minggu</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="fw-bold">08:00 - 12:00</td>
                  <td class="heat-cell" data-value="45" style="background: rgba(107, 33, 168, 0.7);">45</td>
                  <td class="heat-cell" data-value="52" style="background: rgba(107, 33, 168, 0.8);">52</td>
                  <td class="heat-cell" data-value="38" style="background: rgba(107, 33, 168, 0.6);">38</td>
                  <td class="heat-cell" data-value="48" style="background: rgba(107, 33, 168, 0.75);">48</td>
                  <td class="heat-cell" data-value="41" style="background: rgba(107, 33, 168, 0.65);">41</td>
                  <td class="heat-cell" data-value="15" style="background: rgba(107, 33, 168, 0.3);">15</td>
                  <td class="heat-cell" data-value="8" style="background: rgba(107, 33, 168, 0.2);">8</td>
                </tr>
                <tr>
                  <td class="fw-bold">12:00 - 16:00</td>
                  <td class="heat-cell" data-value="35" style="background: rgba(107, 33, 168, 0.55);">35</td>
                  <td class="heat-cell" data-value="42" style="background: rgba(107, 33, 168, 0.65);">42</td>
                  <td class="heat-cell" data-value="48" style="background: rgba(107, 33, 168, 0.75);">48</td>
                  <td class="heat-cell" data-value="39" style="background: rgba(107, 33, 168, 0.6);">39</td>
                  <td class="heat-cell" data-value="44" style="background: rgba(107, 33, 168, 0.7);">44</td>
                  <td class="heat-cell" data-value="12" style="background: rgba(107, 33, 168, 0.25);">12</td>
                  <td class="heat-cell" data-value="5" style="background: rgba(107, 33, 168, 0.15);">5</td>
                </tr>
                <tr>
                  <td class="fw-bold">16:00 - 20:00</td>
                  <td class="heat-cell" data-value="22" style="background: rgba(107, 33, 168, 0.4);">22</td>
                  <td class="heat-cell" data-value="28" style="background: rgba(107, 33, 168, 0.45);">28</td>
                  <td class="heat-cell" data-value="31" style="background: rgba(107, 33, 168, 0.5);">31</td>
                  <td class="heat-cell" data-value="25" style="background: rgba(107, 33, 168, 0.42);">25</td>
                  <td class="heat-cell" data-value="19" style="background: rgba(107, 33, 168, 0.35);">19</td>
                  <td class="heat-cell" data-value="8" style="background: rgba(107, 33, 168, 0.2);">8</td>
                  <td class="heat-cell" data-value="3" style="background: rgba(107, 33, 168, 0.1);">3</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="mt-3 d-flex justify-content-center gap-3 align-items-center">
            <small class="text-muted">Rendah</small>
            <div class="d-flex gap-1">
              <div style="width: 30px; height: 20px; background: rgba(107, 33, 168, 0.2); border-radius: 3px;"></div>
              <div style="width: 30px; height: 20px; background: rgba(107, 33, 168, 0.4); border-radius: 3px;"></div>
              <div style="width: 30px; height: 20px; background: rgba(107, 33, 168, 0.6); border-radius: 3px;"></div>
              <div style="width: 30px; height: 20px; background: rgba(107, 33, 168, 0.8); border-radius: 3px;"></div>
              <div style="width: 30px; height: 20px; background: rgba(107, 33, 168, 1); border-radius: 3px;"></div>
            </div>
            <small class="text-muted">Tinggi</small>
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

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.counter {
  font-weight: 700;
}

.heatmap-table td {
  padding: 15px;
  color: white;
  font-weight: 600;
  transition: all 0.3s ease;
}

.heatmap-table .heat-cell:hover {
  transform: scale(1.1);
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.heatmap-table th {
  background: #f8f9fa;
  padding: 12px;
  font-weight: 600;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Counter Animation
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

  // Monthly Trend Chart
  const monthlyCtx = document.getElementById('monthlyTrendChart').getContext('2d');
  new Chart(monthlyCtx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
      datasets: [{
        label: 'Total Pengaduan',
        data: [65, 59, 80, 81, 96, 105, 115, 108, 120, 125, 130, 145],
        borderColor: '#6B21A8',
        backgroundColor: 'rgba(107, 33, 168, 0.1)',
        tension: 0.4,
        fill: true
      }, {
        label: 'Selesai',
        data: [55, 52, 70, 75, 85, 95, 100, 95, 105, 110, 115, 127],
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
      }
    }
  });

  // Category Pie Chart
  const categoryCtx = document.getElementById('categoryPieChart').getContext('2d');
  new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
      labels: ['Akademik', 'Fasilitas', 'Kekerasan', 'Kemahasiswaan', 'Lainnya'],
      datasets: [{
        data: [450, 320, 85, 145, 55],
        backgroundColor: ['#6B21A8', '#0ea5f0', '#ef4444', '#f59e0b', '#8b5cf6']
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

  // Status Chart
  const statusCtx = document.getElementById('statusChart').getContext('2d');
  new Chart(statusCtx, {
    type: 'pie',
    data: {
      labels: ['Selesai', 'Diproses', 'Belum Diproses'],
      datasets: [{
        data: [870, 245, 132],
        backgroundColor: ['#10b981', '#f59e0b', '#ef4444']
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

  // Response Time Chart
  const responseCtx = document.getElementById('responseTimeChart').getContext('2d');
  new Chart(responseCtx, {
    type: 'bar',
    data: {
      labels: ['Akademik', 'Fasilitas', 'Kekerasan', 'Kemahasiswaan', 'Lainnya'],
      datasets: [{
        label: 'Waktu Respon (hari)',
        data: [2.8, 1.9, 0.8, 3.2, 2.1],
        backgroundColor: [
          'rgba(107, 33, 168, 0.8)',
          'rgba(14, 165, 240, 0.8)',
          'rgba(239, 68, 68, 0.8)',
          'rgba(245, 158, 11, 0.8)',
          'rgba(139, 92, 246, 0.8)'
        ],
        borderColor: [
          '#6B21A8',
          '#0ea5f0',
          '#ef4444',
          '#f59e0b',
          '#8b5cf6'
        ],
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Hari'
          }
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection