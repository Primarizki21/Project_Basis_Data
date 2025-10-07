@extends('layouts.app')

@section('content')
<!-- Hero Section dengan Background Image -->
<section class="position-relative overflow-hidden hero-section" style="min-height: 80vh;">
  <div class="hero-bg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=2000') center/cover; z-index: 0;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(107, 33, 168, 0.95) 0%, rgba(124, 58, 237, 0.9) 50%, rgba(14, 165, 240, 0.85) 100%);"></div>
  </div>

  <div class="container py-5 position-relative" style="z-index: 2;">
    <div class="row align-items-center min-vh-70">
      <div class="col-lg-6 text-white py-5">
        <h1 class="display-3 fw-bold mb-4 fade-in-up">
          Selamat Datang di <span style="color: #fbbf24;">VOIZ FTMM</span>
        </h1>
        <p class="lead mb-4 fade-in-up" style="animation-delay: 0.2s;">
          Sistem Pengaduan Online Fakultas Teknologi Maju dan Multidisiplin Universitas Airlangga
        </p>
        <p class="mb-4 fade-in-up" style="animation-delay: 0.4s;">
          Sampaikan aspirasi, keluhan, dan saran Anda dengan mudah dan transparan. Kami siap mendengarkan dan menindaklanjuti setiap pengaduan Anda.
        </p>
        <div class="d-flex gap-3 fade-in-up" style="animation-delay: 0.6s;">
          @guest
            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4 shadow-lg hover-lift">
              <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4 hover-lift">
              Daftar Sekarang
            </a>
          @else
            <a href="{{ route('pengaduan.create') }}" class="btn btn-warning btn-lg px-4 shadow-lg hover-lift">
              <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan
            </a>
          @endguest
        </div>
      </div>
      <div class="col-lg-6 d-none d-lg-block">
        <div class="floating-animation">
          <div class="glass-card p-5" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); border-radius: 30px; border: 1px solid rgba(255, 255, 255, 0.2);">
            <div class="text-center text-white">
              <i class="bi bi-megaphone pulse-icon" style="font-size: 5rem; opacity: 0.9;"></i>
              <h3 class="mt-4 fw-bold">Suara Anda Penting</h3>
              <p class="mb-0 opacity-75">Bersama membangun kampus yang lebih baik</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Wave Bottom -->
  <div class="custom-shape-divider-bottom">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" class="shape-fill"></path>
    </svg>
  </div>
</section>

<!-- Jenis Pengaduan Section -->
<section id="jenis-pengaduan" class="py-5" style="background: #f8f9fa;">
  <div class="container">
    <div class="text-center mb-5 fade-in-up">
      <h2 class="fw-bold mb-2">Jenis Pengaduan</h2>
      <p class="text-muted">Pilih kategori pengaduan sesuai dengan keluhan Anda</p>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-4 fade-in-up" style="animation-delay: 0.1s;">
        @guest
        <a href="{{ route('login') }}" class="text-decoration-none">
        @else
        <a href="{{ route('pengaduan.create') }}?kategori=1" class="text-decoration-none">
        @endguest
          <div class="card border-0 shadow-sm hover-scale h-100 kategori-card">
            <div class="card-body text-center p-4">
              <div class="icon-box mb-3 mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-book text-white" style="font-size: 2.5rem;"></i>
              </div>
              <h5 class="fw-bold mb-2">Akademik</h5>
              <p class="text-muted small mb-0">Masalah perkuliahan, kurikulum, nilai</p>
            </div>
          </div>
        </a>
      </div>
      
      <div class="col-md-6 col-lg-4 fade-in-up" style="animation-delay: 0.2s;">
        @guest
        <a href="{{ route('login') }}" class="text-decoration-none">
        @else
        <a href="{{ route('pengaduan.create') }}?kategori=2" class="text-decoration-none">
        @endguest
          <div class="card border-0 shadow-sm hover-scale h-100 kategori-card">
            <div class="card-body text-center p-4">
              <div class="icon-box mb-3 mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #0ea5f0, #0284c7); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-building text-white" style="font-size: 2.5rem;"></i>
              </div>
              <h5 class="fw-bold mb-2">Fasilitas</h5>
              <p class="text-muted small mb-0">Sarana & prasarana kampus</p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-6 col-lg-4 fade-in-up" style="animation-delay: 0.3s;">
        @guest
        <a href="{{ route('login') }}" class="text-decoration-none">
        @else
        <a href="{{ route('pengaduan.create') }}?kategori=3" class="text-decoration-none">
        @endguest
          <div class="card border-0 shadow-sm hover-scale h-100 kategori-card">
            <div class="card-body text-center p-4">
              <div class="icon-box mb-3 mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #ef4444, #dc2626); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-shield-exclamation text-white" style="font-size: 2.5rem;"></i>
              </div>
              <h5 class="fw-bold mb-2">Kekerasan</h5>
              <p class="text-muted small mb-0">Bullying, pelecehan, kekerasan</p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-6 col-lg-4 fade-in-up" style="animation-delay: 0.4s;">
        @guest
        <a href="{{ route('login') }}" class="text-decoration-none">
        @else
        <a href="{{ route('pengaduan.create') }}?kategori=4" class="text-decoration-none">
        @endguest
          <div class="card border-0 shadow-sm hover-scale h-100 kategori-card">
            <div class="card-body text-center p-4">
              <div class="icon-box mb-3 mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-people text-white" style="font-size: 2.5rem;"></i>
              </div>
              <h5 class="fw-bold mb-2">Kemahasiswaan</h5>
              <p class="text-muted small mb-0">Pelayanan kemahasiswaan</p>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-6 col-lg-4 fade-in-up" style="animation-delay: 0.5s;">
        @guest
        <a href="{{ route('login') }}" class="text-decoration-none">
        @else
        <a href="{{ route('pengaduan.create') }}?kategori=5" class="text-decoration-none">
        @endguest
          <div class="card border-0 shadow-sm hover-scale h-100 kategori-card">
            <div class="card-body text-center p-4">
              <div class="icon-box mb-3 mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-three-dots text-white" style="font-size: 2.5rem;"></i>
              </div>
              <h5 class="fw-bold mb-2">Lainnya</h5>
              <p class="text-muted small mb-0">Komplain di luar kategori utama</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Alur Pengaduan Section dengan Wave -->
<section id="alur" class="py-5 position-relative" style="background: linear-gradient(135deg, #6B21A8 0%, #7C3AED 50%, #0ea5f0 100%);">
  <!-- Wave Top -->
  <div class="custom-shape-divider-top">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" class="shape-fill"></path>
    </svg>
  </div>

  <div class="container py-5">
    <div class="text-center mb-5 fade-in-up">
      <h2 class="fw-bold text-white mb-2">Alur Pengaduan</h2>
      <p class="text-white opacity-75">Proses pengaduan yang mudah dan transparan</p>
    </div>
    <div class="row g-4">
      <div class="col-md-3 fade-in-up" style="animation-delay: 0.1s;">
        <div class="text-center">
          <div class="alur-circle mx-auto mb-3">
            <i class="bi bi-pencil-square" style="font-size: 2.5rem;"></i>
          </div>
          <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
              <div class="badge bg-warning text-dark mb-2">Langkah 1</div>
              <h5 class="fw-bold mb-2">Isi Formulir</h5>
              <p class="text-muted small mb-0">Login dan lengkapi formulir pengaduan dengan detail</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 fade-in-up" style="animation-delay: 0.2s;">
        <div class="text-center">
          <div class="alur-circle mx-auto mb-3">
            <i class="bi bi-send" style="font-size: 2.5rem;"></i>
          </div>
          <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
              <div class="badge bg-warning text-dark mb-2">Langkah 2</div>
              <h5 class="fw-bold mb-2">Kirim Pengaduan</h5>
              <p class="text-muted small mb-0">Mendapat nomor tiket untuk tracking</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 fade-in-up" style="animation-delay: 0.3s;">
        <div class="text-center">
          <div class="alur-circle mx-auto mb-3">
            <i class="bi bi-gear" style="font-size: 2.5rem;"></i>
          </div>
          <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
              <div class="badge bg-warning text-dark mb-2">Langkah 3</div>
              <h5 class="fw-bold mb-2">Diproses Admin</h5>
              <p class="text-muted small mb-0">Tim kami menindaklanjuti pengaduan</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 fade-in-up" style="animation-delay: 0.4s;">
        <div class="text-center">
          <div class="alur-circle mx-auto mb-3">
            <i class="bi bi-check-circle" style="font-size: 2.5rem;"></i>
          </div>
          <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
              <div class="badge bg-warning text-dark mb-2">Langkah 4</div>
              <h5 class="fw-bold mb-2">Selesai</h5>
              <p class="text-muted small mb-0">Notifikasi hasil tindak lanjut</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Wave Bottom -->
  <div class="custom-shape-divider-bottom">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" class="shape-fill"></path>
    </svg>
  </div>
</section>

<!-- Pengaduan Anonim Publik -->
<section id="pengaduan-anonim" class="py-5" style="background: #ffffff;">
  <div class="container">
    <div class="text-center mb-5 fade-in-up">
      <div class="mb-3">
        <div class="icon-box mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
          <i class="bi bi-chat-square-dots text-white" style="font-size: 2.5rem;"></i>
        </div>
      </div>
      <h2 class="fw-bold mb-2">Pengaduan Anonim Publik</h2>
      <p class="text-muted">Transparansi pengaduan dari masyarakat kampus</p>
    </div>

    <div class="row g-4">
      @forelse($pengaduanAnonim as $index => $anonim)
          <div class="col-lg-6 fade-in-up" style="animation-delay: {{ $index * 0.1 }}s;">
              <div class="card border-0 shadow-sm h-100 hover-lift-card">
                  <div class="card-body p-4">
                      <div class="d-flex justify-content-between align-items-start mb-3">
                          <div>
                              <span class="badge mb-2" style="background-color: {{ $warnaKategori[$anonim->kategoriKomplain->jenis_komplain] ?? '#6c757d' }};">
                                  {{ $anonim->kategoriKomplain->jenis_komplain }} 
                              </span>
                              <div class="text-muted small">
                                  <i class="bi bi-calendar3 me-1"></i>{{ $anonim->created_at->format('d M Y') }}
                              </div>
                          </div>
                          <div class="text-end">
                              @if($anonim->status_pengaduan == 'Selesai')
                                  <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Selesai</span>
                              @elseif($anonim->status_pengaduan == 'Diproses')
                                  <span class="badge bg-warning text-dark"><i class="bi bi-gear me-1"></i>Diproses</span>
                              @else
                                  <span class="badge bg-secondary"><i class="bi bi-hourglass me-1"></i>Menunggu</span>
                              @endif
                          </div>
                      </div>

                      <div class="mb-3">
                          <h6 class="fw-bold mb-2">Pengaduan:</h6>
                          <p class="text-muted mb-0" style="font-size: 0.95rem;">{{ Str::limit($anonim->deskripsi_kejadian, 150) }}</p>
                      </div>

                      {{-- Bagian tanggapan bisa ditambahkan di sini jika ada --}}
                      
                  </div>
              </div>
          </div>

      @empty
          <div class="col-12">
              <div class="text-center py-5">
                  <div class="icon-box mx-auto mb-3" style="width: 70px; height: 70px; background-color: #f1f3f5; border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                      <i class="bi bi-chat-square-dots text-muted" style="font-size: 2rem;"></i>
                  </div>
                  <h4 class="fw-bold">Belum Ada Pengaduan</h4>
                  <p class="text-muted">Saat ini belum ada pengaduan anonim yang ditampilkan.</p>
              </div>
          </div>

      @endforelse
    </div>
    
    <div class="text-center mt-5">
      <a href="{{ route('pengaduan.createAnonim') }}" class="btn btn-lg text-white px-5 shadow-lg hover-lift" style="background: linear-gradient(135deg, #6B21A8, #7C3AED); border: none;">
        <i class="bi bi-pencil-square me-2"></i>
        Buat Pengaduan Anonim
      </a>
    </div>
  </div>
</section>

<!-- Kontak Section dengan Background Image -->
<section id="kontak" class="py-5 position-relative" style="min-height: 60vh; overflow: hidden;">
  <div style="position: absolute; inset: 0; background: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2000') center/cover; z-index: 0;"></div>
  <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(107, 33, 168, 0.92), rgba(14, 165, 240, 0.88)); z-index: 1;"></div>
  
  <div class="container position-relative" style="z-index: 2;">
    <div class="text-center mb-5 text-white fade-in-up">
      <h2 class="fw-bold mb-2">Hubungi Kami</h2>
      <p class="opacity-75">Ada pertanyaan atau butuh bantuan? Tim kami siap membantu</p>
    </div>

    <div class="row g-4 align-items-center">
      <div class="col-lg-6 fade-in-up">
        <div class="row g-3">
          <div class="col-12">
            <div class="d-flex align-items-start p-3 rounded" style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);">
              <div class="icon-box me-3" style="width: 50px; height: 50px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-envelope" style="font-size: 1.5rem; color: #6B21A8;"></i>
              </div>
              <div class="text-white">
                <h6 class="fw-bold mb-1">Email</h6>
                <p class="mb-0 opacity-75">ftmm@unair.ac.id</p>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="d-flex align-items-start p-3 rounded" style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);">
              <div class="icon-box me-3" style="width: 50px; height: 50px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-telephone" style="font-size: 1.5rem; color: #0ea5f0;"></i>
              </div>
              <div class="text-white">
                <h6 class="fw-bold mb-1">Telepon</h6>
                <p class="mb-0 opacity-75">(031) 5914042</p>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="d-flex align-items-start p-3 rounded" style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px);">
              <div class="icon-box me-3" style="width: 50px; height: 50px; background: white; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-geo-alt" style="font-size: 1.5rem; color: #f59e0b;"></i>
              </div>
              <div class="text-white">
                <h6 class="fw-bold mb-1">Alamat</h6>
                <p class="mb-0 opacity-75">Kampus C UNAIR, Mulyorejo, Surabaya</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 fade-in-up" style="animation-delay: 0.2s;">
        <div class="card border-0 shadow-lg">
          <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Jam Operasional</h5>
            <div class="d-flex justify-content-between mb-2">
              <span>Senin - Jumat</span>
              <span class="fw-bold">08:00 - 16:00 WIB</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Sabtu</span>
              <span class="fw-bold">08:00 - 12:00 WIB</span>
            </div>
            <div class="d-flex justify-content-between">
              <span>Minggu</span>
              <span class="text-danger fw-bold">Tutup</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="py-4 text-center" style="background: linear-gradient(135deg, #6B21A8, #7C3AED);">
  <div class="container">
    <p class="text-white mb-0">&copy; 2025 VOIZ FTMM - Fakultas Teknologi Maju dan Multidisiplin UNAIR</p>
  </div>
</footer>

<style>
/* Animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}
@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateX(-20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.05);
  }
}

.fade-in-up {
  animation: fadeInUp 0.8s ease-out;
}

.floating-animation {
  animation: float 3s ease-in-out infinite;
}

.animate-slide-in {
  animation: slideIn 0.5s ease-out;
}

.pulse-icon {
  animation: pulse 2s ease-in-out infinite;
}

/* Hero Background Parallax */
.hero-bg {
  animation: subtle-zoom 20s ease-in-out infinite alternate;
}

@keyframes subtle-zoom {
  0% { transform: scale(1); }
  100% { transform: scale(1.05); }
}

/* Glassmorphism */
.glass-card {
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}

/* Hover Effects */
.hover-lift {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.hover-lift-card {
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.hover-lift-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(107, 33, 168, 0.25) !important;
}

.hover-scale {
  transition: all 0.3s ease;
}

.hover-scale:hover {
  transform: scale(1.05);
  box-shadow: 0 15px 35px rgba(0,0,0,0.2) !important;
}

.kategori-card {
  position: relative;
  overflow: hidden;
}

.kategori-card::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  transition: transform 0.5s ease;
  transform: scale(0);
}

.kategori-card:hover::before {
  transform: scale(1);
}

/* Alur Circle */
.alur-circle {
  width: 100px;
  height: 100px;
  background: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #6B21A8;
  box-shadow: 0 10px 30px rgba(107, 33, 168, 0.3);
  transition: all 0.3s ease;
}

.alur-circle:hover {
  transform: scale(1.1) rotate(5deg);
  box-shadow: 0 15px 40px rgba(107, 33, 168, 0.4);
}

/* Wave Shapes - REVISED */
.custom-shape-divider-bottom {
  position: absolute;
  bottom: -1px;
  left: 0;
  width: 100%;
  overflow: hidden;
  line-height: 0;
}

.custom-shape-divider-bottom svg {
  position: relative;
  display: block;
  width: calc(100% + 1.3px);
  height: 80px;
}

.custom-shape-divider-top {
  position: absolute;
  top: -1px;
  left: 0;
  width: 100%;
  overflow: hidden;
  line-height: 0;
  transform: rotate(180deg);
}

.custom-shape-divider-top svg {
  position: relative;
  display: block;
  width: calc(100% + 1.3px);
  height: 80px;
}

.shape-fill {
  fill: #f8f9fa;
}

.shape-fill-white {
  fill: #ffffff;
}

/* Smooth Scroll */
html {
  scroll-behavior: smooth;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-section {
    min-height: 60vh !important;
  }
  
  .display-3 {
    font-size: 2rem !important;
  }
  
  .lead {
    font-size: 1rem !important;
  }
}
</style>

<script>
// Intersection Observer for Animations
document.addEventListener('DOMContentLoaded', function() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, observerOptions);

  document.querySelectorAll('.fade-in-up').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'all 0.8s ease-out';
    observer.observe(el);
  });
});

// Smooth Scroll for Anchor Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection