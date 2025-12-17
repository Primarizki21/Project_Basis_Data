@extends('layouts.app')

@section('content')
<div class="container-fluid animate-fade-in">

  <!-- ================= HEADER ================= -->
  <div class="row mb-4">
    <div class="col-12">
      <h2 class="fw-bold mb-2">Visualisasi Data</h2>
      <p class="text-muted">Analisis dan statistik pengaduan dalam bentuk grafik</p>
    </div>
  </div>

  <!-- ================= OVERVIEW ================= -->
  <div class="row g-4 mb-4 justify-content-center">
    <div class="col-lg-6 col-md-6">
      <div class="card border-0 shadow-sm h-100"
           style="background: linear-gradient(135deg, #6B21A8, #7C3AED);">
        <div class="card-body p-4 text-white">
          <h6 class="mb-3 opacity-75">Total Pengaduan</h6>
          <h2 class="fw-bold mb-2" id="totalPengaduan">0</h2>
          <small class="opacity-75">Data dari Data Warehouse</small>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card border-0 shadow-sm h-100"
           style="background: linear-gradient(135deg, #f59e0b, #d97706);">
        <div class="card-body p-4 text-white">
          <h6 class="mb-3 opacity-75">Rata-rata Waktu Proses</h6>
          <h2 class="fw-bold mb-2" id="avgWaktu">—</h2>
          <small class="opacity-75">Hari</small>
        </div>
      </div>
    </div>
  </div>

<!-- ================= ROW 1 ================= -->
<div class="row g-4 mb-4">
  <div class="col-lg-6">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">Tren Pengaduan Bulanan</h5>
        <small class="text-muted">Berdasarkan waktu</small>
      </div>
      <div class="card-body p-4">
        <canvas id="monthlyTrendChart" height="120"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">Perbandingan Waktu Respon</h5>
        <small class="text-muted">Rata-rata per kategori (hari)</small>
      </div>
      <div class="card-body p-4">
        <canvas id="responseTimeChart" height="120"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- ================= ROW 2 ================= -->
<div class="row g-4 mb-4">
  <div class="col-lg-6">
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

  <div class="col-lg-6">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">Status Pengaduan</h5>
        <small class="text-muted">Distribusi status</small>
      </div>
      <div class="card-body p-4">
        <canvas id="statusChart"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Charts Row 3 -->
<div class="row g-4 mb-4">
  <div class="col-lg-12">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">Performa Admin Bulanan</h5>
        <small class="text-muted">Total tiket ditangani per admin (berdasarkan data warehouse)</small>
      </div>
      <div class="card-body p-4">
        <div class="chart-box-lg">
          <canvas id="adminPerformanceChart"></canvas>
        </div>
        
      </div>

    </div>
  </div>
</div>
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">Demografi Prodi</h5>
        <small class="text-muted">Jumlah pengaduan per prodi</small>
      </div>
      <div class="card-body p-4">
        <canvas id="demografiProdiChart" height="120"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">Jenis Kelamin</h5>
        <small class="text-muted">Distribusi pelapor</small>
      </div>
      <div class="card-body p-4">
        <canvas id="demografiGenderChart"></canvas>
      </div>
    </div>
  </div>
</div>

<div class="row g-4 mb-4">
  <div class="col-12">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">Angkatan</h5>
        <small class="text-muted">Jumlah pengaduan per angkatan</small>
      </div>
      <div class="card-body p-4">
        <canvas id="demografiAngkatanChart" height="80"></canvas>
      </div>
    </div>
  </div>
</div>



</div>

<!-- ================= STYLE ================= -->
<style>
.animate-fade-in {
  animation: fadeIn 0.6s ease-out;
}
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

<style>
  .chart-box-lg{
    position: relative;
    height: 380px;   /* coba 320-520 sesuai selera */
    width: 100%;
  }
</style>

<!-- ================= SCRIPT ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', async () => {
  console.log('--- [DEBUG] START VISUALISASI SCRIPT ---');

  

  // Cek apakah Library Chart.js terbaca
  if (typeof Chart === 'undefined') {
    console.error('--- [FATAL ERROR] Library Chart.js TIDAK TERMUAT. Cek koneksi internet atau CDN URL. ---');
    alert('Library Chart.js gagal dimuat! Cek Console.');
    return;
  } else {
    console.log('--- [DEBUG] Chart.js version:', Chart.version);
  }

  // --- 1. TOTAL PENGADUAN ---
  console.log('--- [DEBUG] 1. Fetching Summary... ---');
  try {
    const resp = await fetch('/api/visualisasi/summary');
    const summary = await resp.json();
    console.log('[DEBUG] Data Summary diterima:', summary);
    
    const elTotal = document.getElementById('totalPengaduan');
    if (elTotal) {
      elTotal.innerText = summary.total_pengaduan;
      console.log('[DEBUG] Element #totalPengaduan updated.');
    } else {
      console.error('[DEBUG] Element #totalPengaduan TIDAK DITEMUKAN di HTML.');
    }
  } catch (error) {
    console.error('[DEBUG] Error Summary:', error);
  }

  // --- 2. KATEGORI (Pie Chart) ---
  console.log('--- [DEBUG] 2. Fetching Kategori... ---');
  try {
    const resp = await fetch('/api/visualisasi/kategori');
    const kategori = await resp.json();
    console.log('[DEBUG] Data Kategori diterima:', kategori);

    const ctxKategori = document.getElementById('categoryPieChart');
    if (ctxKategori) {
      // Cek isi data mapping
      const labels = kategori.map(x => x.label);
      const values = kategori.map(x => x.value);
      console.log('[DEBUG] Kategori Mapping -> Labels:', labels, 'Values:', values);

      new Chart(ctxKategori, {
        type: 'doughnut',
        data: {
          labels: labels,
          datasets: [{
            data: values,
            backgroundColor: ['#6B21A8','#0ea5f0','#ef4444','#f59e0b','#8b5cf6']
          }]
        },
        options: { plugins: { legend: { position: 'bottom' } } }
      });
      console.log('[DEBUG] Chart Kategori berhasil di-init.');
    } else {
      console.error('[DEBUG] Canvas #categoryPieChart TIDAK DITEMUKAN.');
    }
  } catch (error) {
    console.error('[DEBUG] Error Kategori:', error);
  }

  // --- 3. STATUS (Pie Chart) ---
  console.log('--- [DEBUG] 3. Fetching Status... ---');
  try {
    const resp = await fetch('/api/visualisasi/status');
    const status = await resp.json();
    console.log('[DEBUG] Data Status diterima:', status);

    const ctxStatus = document.getElementById('statusChart');
    if (ctxStatus) {
      new Chart(ctxStatus, {
        type: 'pie',
        data: {
          labels: status.map(x => x.label),
          datasets: [{
            data: status.map(x => x.value),
            backgroundColor: ['#10b981','#f59e0b','#ef4444']
          }]
        },
        options: { plugins: { legend: { position: 'bottom' } } }
      });
      console.log('[DEBUG] Chart Status berhasil di-init.');
    } else {
      console.error('[DEBUG] Canvas #statusChart TIDAK DITEMUKAN.');
    }
  } catch (error) {
    console.error('[DEBUG] Error Status:', error);
  }

  // --- 4. RESPONSE TIME (Bar Chart) ---
  console.log('--- [DEBUG] 4. Fetching Response Time... ---');
  try {
    const resp = await fetch('/api/visualisasi/response-time');
    const rt = await resp.json();
    console.log('[DEBUG] Data Response Time diterima:', rt);

    const ctxResp = document.getElementById('responseTimeChart');
    if (ctxResp) {
      new Chart(ctxResp, {
        type: 'bar',
        data: {
          labels: rt.map(x => x.label),
          datasets: [{
            data: rt.map(x => Number(x.value)),
            backgroundColor: 'rgba(107,33,168,0.8)'
          }]
        },
        options: {
          scales: { y: { beginAtZero: true } },
          plugins: { legend: { display: false } }
        }
      });
      console.log('[DEBUG] Chart Response Time berhasil di-init.');
    } else {
      console.error('[DEBUG] Canvas #responseTimeChart TIDAK DITEMUKAN.');
    }
  } catch (error) {
    console.error('[DEBUG] Error Response Time:', error);
  }

   // --- 5. MONTHLY TREND (Line Chart) ---
  console.log('--- [DEBUG] 5. Fetching Trend Bulanan... ---');
  try {
    const resp = await fetch('/api/visualisasi/trend-bulanan');
    const rows = await resp.json();
    console.log('[DEBUG] Data Trend diterima:', rows);

    const ctxTrend = document.getElementById('monthlyTrendChart');
    if (ctxTrend) {
      const labels  = Array.isArray(rows) ? rows.map(r => `${String(r.bulan).padStart(2,'0')}/${r.tahun}`) : [];
      const totals  = Array.isArray(rows) ? rows.map(r => Number(r.total || 0)) : [];
      const selesai = Array.isArray(rows) ? rows.map(r => Number(r.selesai || 0)) : [];

      console.log('[DEBUG] Trend Mapping -> Labels:', labels, 'Total:', totals);

      new Chart(ctxTrend, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [
            {
              label: 'Total Pengaduan',
              data: totals,
              borderColor: '#6B21A8',
              backgroundColor: 'rgba(107,33,168,0.12)',
              tension: 0.35,
              fill: true
            },
            {
              label: 'Selesai',
              data: selesai,
              borderColor: '#10b981',
              backgroundColor: 'rgba(16,185,129,0.10)',
              tension: 0.35,
              fill: true
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          plugins: { legend: { position: 'top' } }
        }
      });
      console.log('[DEBUG] Chart Trend berhasil di-init.');
    } else {
      console.error('[DEBUG] Canvas #monthlyTrendChart TIDAK DITEMUKAN.');
    }
  } catch (e) {
    console.error('[DEBUG] Error Trend:', e);
  }

  // --- 6. AVG WAKTU PROSES ---
  try {
    const resp = await fetch('/api/visualisasi/avg-waktu-proses');
    const d = await resp.json();
    console.log('[DEBUG] Data Avg Waktu diterima:', d);
    const elAvg = document.getElementById('avgWaktu');
    if (elAvg) {
        elAvg.innerText = (d.avg_hari !== null) ? d.avg_hari : '—';
    }
  } catch (error) {
    console.error('[DEBUG] Error Avg Waktu:', error);
  }

  // --- 7. ADMIN PERFORMANCE ---
  console.log('--- [DEBUG] 7. Fetching Admin Performance... ---');
  try {
    const resp = await fetch('/api/visualisasi/performa-admin-bulanan');
    const rows = await resp.json();
    console.log('[DEBUG] Data Admin Performance diterima (RAW):', rows);

    const ctxAdmin = document.getElementById('adminPerformanceChart');

    if (ctxAdmin && Array.isArray(rows) && rows.length > 0) {
      const monthKey = (r) => `${r.tahun}-${String(r.bulan).padStart(2,'0')}`;
      const labels = [...new Set(rows.map(monthKey))].sort();
      const admins = [...new Set(rows.map(r => r.admin))];

      console.log('[DEBUG] Admin Processing -> Labels:', labels);
      console.log('[DEBUG] Admin Processing -> Admins List:', admins);

      const datasets = admins.map((admin, index) => {
        const data = labels.map((lbl) => {
          const hit = rows.find(r => r.admin === admin && monthKey(r) === lbl);
          return hit ? Number(hit.total) : 0;
        });
        const colors = ['#6B21A8', '#0ea5f0', '#ef4444', '#f59e0b', '#10b981'];
        return {
          label: admin,
          data: data,
          backgroundColor: colors[index % colors.length],
          borderWidth: 1
        };
      });

      console.log('[DEBUG] Admin Final Datasets:', datasets);

      new Chart(ctxAdmin, {
        type: 'bar',
        data: { labels, datasets },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { position: 'bottom' } },
          scales: {
            y: { beginAtZero: true, title: { display: true, text: 'Jumlah Tiket' } }
          }
        }
      });
      console.log('[DEBUG] Chart Admin berhasil di-init.');
    } else {
      console.warn("[DEBUG] Data Admin kosong atau Canvas #adminPerformanceChart tidak ketemu.");
      if(!ctxAdmin) console.error("[DEBUG] Masalahnya: Canvas ID tidak ada di HTML.");
      if(!Array.isArray(rows)) console.error("[DEBUG] Masalahnya: Response bukan Array.");
    }
  } catch (e) {
    console.error('[DEBUG] Error Admin Performance:', e);
  }

  // DEMOGRAFI PRODI
try {
  const prodi = await fetch('/api/visualisasi/demografi-prodi').then(r => r.json());
  new Chart(document.getElementById('demografiProdiChart'), {
    type: 'bar',
    data: {
      labels: prodi.map(x => x.label),
      datasets: [{ data: prodi.map(x => x.value) }]
    },
    options: { plugins: { legend: { display: false } } }
  });
} catch (e) { console.warn('Demografi prodi gagal', e); }

// DEMOGRAFI GENDER
try {
  const g = await fetch('/api/visualisasi/demografi-gender').then(r => r.json());
  new Chart(document.getElementById('demografiGenderChart'), {
    type: 'doughnut',
    data: {
      labels: g.map(x => x.label),
      datasets: [{ data: g.map(x => x.value) }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
  });
} catch (e) { console.warn('Demografi gender gagal', e); }

// DEMOGRAFI ANGKATAN
try {
  const a = await fetch('/api/visualisasi/demografi-angkatan').then(r => r.json());
  new Chart(document.getElementById('demografiAngkatanChart'), {
    type: 'bar',
    data: {
      labels: a.map(x => x.label),
      datasets: [{ data: a.map(x => x.value) }]
    },
    options: { plugins: { legend: { display: false } } }
  });
} catch (e) { console.warn('Demografi angkatan gagal', e); }


});
</script>

<link rel="stylesheet"
 href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
