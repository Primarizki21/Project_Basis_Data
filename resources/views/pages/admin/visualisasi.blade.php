@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 lg:px-6 py-6 animate-[fadeIn_0.6s_ease-out]">

  <!-- ================= HEADER ================= -->
  <div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Visualisasi Data</h2>
    <p class="text-gray-500">Analisis dan statistik pengaduan dalam bentuk grafik</p>
  </div>

  <!-- ================= OVERVIEW ================= -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-gradient-to-br from-[#6B21A8] to-[#7C3AED] rounded-2xl shadow-sm p-6 text-white h-full transform hover:scale-[1.02] transition-transform duration-300">
        <h6 class="mb-3 opacity-90 font-medium">Total Pengaduan</h6>
        <h2 class="text-4xl font-bold mb-2" id="totalPengaduan">0</h2>
        <small class="opacity-80 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
            Data dari Data Warehouse
        </small>
    </div>

    <div class="bg-gradient-to-br from-[#f59e0b] to-[#d97706] rounded-2xl shadow-sm p-6 text-white h-full transform hover:scale-[1.02] transition-transform duration-300">
        <h6 class="mb-3 opacity-90 font-medium">Rata-rata Waktu Proses</h6>
        <h2 class="text-4xl font-bold mb-2" id="avgWaktu">—</h2>
        <small class="opacity-80">Hari</small>
    </div>
  </div>

  <!-- ================= ROW 1 ================= -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col">
      <div class="p-6 border-b border-gray-100 bg-gray-50/50">
        <h5 class="font-bold text-lg text-gray-800 mb-0">Tren Pengaduan Bulanan</h5>
        <small class="text-gray-500">Berdasarkan waktu</small>
      </div>
      <div class="p-6 flex-1">
        <div class="relative h-[300px]">
            <canvas id="monthlyTrendChart"></canvas>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col">
      <div class="p-6 border-b border-gray-100 bg-gray-50/50">
        <h5 class="font-bold text-lg text-gray-800 mb-0">Perbandingan Waktu Respon</h5>
        <small class="text-gray-500">Rata-rata per kategori (hari)</small>
      </div>
      <div class="p-6 flex-1">
        <div class="relative h-[300px]">
            <canvas id="responseTimeChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- ================= ROW 2 ================= -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col">
      <div class="p-6 border-b border-gray-100 bg-gray-50/50">
        <h5 class="font-bold text-lg text-gray-800 mb-0">Kategori Pengaduan</h5>
        <small class="text-gray-500">Distribusi berdasarkan jenis</small>
      </div>
      <div class="p-6 flex-1 flex items-center justify-center">
        <div class="relative h-[300px] w-full max-w-[400px]">
            <canvas id="categoryPieChart"></canvas>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col">
      <div class="p-6 border-b border-gray-100 bg-gray-50/50">
        <h5 class="font-bold text-lg text-gray-800 mb-0">Status Pengaduan</h5>
        <small class="text-gray-500">Distribusi status</small>
      </div>
      <div class="p-6 flex-1 flex items-center justify-center">
        <div class="relative h-[300px] w-full max-w-[400px]">
            <canvas id="statusChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Row 3 -->
  <div class="mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full">
      <div class="p-6 border-b border-gray-100 bg-gray-50/50">
        <h5 class="font-bold text-lg text-gray-800 mb-0">Performa Admin Bulanan</h5>
        <small class="text-gray-500">Total tiket ditangani per admin (berdasarkan data warehouse)</small>
      </div>
      <div class="p-6">
        <div class="relative h-[400px] w-full">
          <canvas id="adminPerformanceChart"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- ================= SCRIPT ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart.js Global Defaults for Better Aesthetics
Chart.defaults.font.family = "'Inter', system-ui, -apple-system, sans-serif";
Chart.defaults.color = '#6b7280';
Chart.defaults.scale.grid.color = '#f3f4f6';
Chart.defaults.plugins.tooltip.backgroundColor = 'rgba(17, 24, 39, 0.9)';
Chart.defaults.plugins.tooltip.padding = 12;
Chart.defaults.plugins.tooltip.cornerRadius = 8;
Chart.defaults.plugins.tooltip.titleFont = { size: 14, weight: '600' };
Chart.defaults.plugins.tooltip.bodyFont = { size: 13 };

document.addEventListener('DOMContentLoaded', async () => {

  // TOTAL
  try {
      const summary = await fetch('/api/visualisasi/summary').then(r => r.json());
      document.getElementById('totalPengaduan').innerText = summary.total_pengaduan;
  } catch (e) { console.error(e); }

  // KATEGORI
  try {
      const kategori = await fetch('/api/visualisasi/kategori').then(r => r.json());
      new Chart(document.getElementById('categoryPieChart'), {
        type: 'doughnut',
        data: {
          labels: kategori.map(x => x.label),
          datasets: [{
            data: kategori.map(x => x.value),
            backgroundColor: ['#6B21A8','#0ea5f0','#ef4444','#f59e0b','#8b5cf6'],
            borderWidth: 0,
            hoverOffset: 15
          }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } }
            },
            cutout: '70%'
        }
      });
  } catch (e) { console.error(e); }

  // STATUS
  try {
      const status = await fetch('/api/visualisasi/status').then(r => r.json());
      new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
          labels: status.map(x => x.label),
          datasets: [{
            data: status.map(x => x.value),
            backgroundColor: ['#10b981','#f59e0b','#ef4444'],
            borderWidth: 0,
            hoverOffset: 15
          }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } }
            }
        }
      });
  } catch (e) { console.error(e); }

  // ADMIN PERFORMANCE (BULANAN)
  try {
    const res = await fetch('/api/visualisasi/performa-admin-bulanan');
    const rows = await res.json();

    const monthKey = (r) => `${r.tahun}-${String(r.bulan).padStart(2,'0')}`;
    const labels = [...new Set(rows.map(monthKey))];
    const admins = [...new Set(rows.map(r => r.admin))];

    // Generate colors dynamically if many admins, else use preset
    const colors = ['#6B21A8', '#0ea5f0', '#f59e0b', '#10b981', '#ef4444'];

    const datasets = admins.map((admin, idx) => {
      const data = labels.map((lbl) => {
        const hit = rows.find(r => r.admin === admin && monthKey(r) === lbl);
        return hit ? Number(hit.total) : 0;
      });
      return {
        label: admin,
        data,
        backgroundColor: colors[idx % colors.length],
        borderRadius: 4,
        barPercentage: 0.6
      };
    });

    new Chart(document.getElementById('adminPerformanceChart'), {
      type: 'bar',
      data: { labels, datasets },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'top', align: 'end', labels: { usePointStyle: true } }
        },
        scales: {
          y: { beginAtZero: true, grid: { borderDash: [2, 2] } },
          x: { grid: { display: false } }
        }
      }
    });
  } catch (e) {
    console.warn('Performa admin bulanan gagal', e);
  }

  // RESPONSE TIME
  try {
      const rt = await fetch('/api/visualisasi/response-time').then(r => r.json());
      new Chart(document.getElementById('responseTimeChart'), {
        type: 'bar',
        data: {
          labels: rt.map(x => x.label),
          datasets: [{
            label: 'Hari',
            data: rt.map(x => Number(x.value)),
            backgroundColor: 'rgba(107,33,168,0.8)',
            borderRadius: 6,
            barThickness: 40
          }]
        },
        options: {
          maintainAspectRatio: false,
          scales: {
              y: { beginAtZero: true, grid: { borderDash: [2, 2] } },
              x: { grid: { display: false } }
          },
          plugins: { legend: { display: false } }
        }
      });
  } catch (e) { console.error(e); }

  // MONTHLY TREND
  try {
    const rows = await fetch('/api/visualisasi/trend-bulanan').then(r => r.json());
    if (!Array.isArray(rows) || rows.length === 0) throw new Error('Data trend kosong');

    const labels  = rows.map(r => `${String(r.bulan).padStart(2,'0')}/${r.tahun}`);
    const totals  = rows.map(r => Number(r.total || 0));
    const selesai = rows.map(r => Number(r.selesai || 0));

    new Chart(document.getElementById('monthlyTrendChart'), {
      type: 'line',
      data: {
        labels,
        datasets: [
          {
            label: 'Total Pengaduan',
            data: totals,
            borderColor: '#6B21A8',
            backgroundColor: 'rgba(107,33,168,0.1)',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#6B21A8',
            pointRadius: 4,
            pointHoverRadius: 6
          },
          {
            label: 'Selesai',
            data: selesai,
            borderColor: '#10b981',
            backgroundColor: 'rgba(16,185,129,0.1)',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#10b981',
            pointRadius: 4,
            pointHoverRadius: 6
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'top', align: 'end', labels: { usePointStyle: true } }
        },
        scales: {
            y: { beginAtZero: true, grid: { borderDash: [2, 2] } },
            x: { grid: { display: false } }
        },
        interaction: {
            mode: 'index',
            intersect: false,
        },
      }
    });

  } catch (e) {
    console.warn('Trend bulanan gagal/kosong', e);
  }

  // AVG WAKTU PROSES
  try {
    const res = await fetch('/api/visualisasi/avg-waktu-proses');
    const d = await res.json();
    document.getElementById('avgWaktu').innerText = d.avg_hari !== null ? d.avg_hari : '—';
  } catch {
    document.getElementById('avgWaktu').innerText = '—';
  }

});
</script>
@endsection
