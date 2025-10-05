@extends('layouts.app')

@section('content')
<!-- Hero Section dengan Background Image -->
<section class="position-relative overflow-hidden hero-section" style="min-height: 80vh;">
  <!-- Background Image dengan Overlay -->
  <div class="hero-bg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=2000') center/cover; z-index: 0;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(107, 33, 168, 0.95) 0%, rgba(124, 58, 237, 0.9) 50%, rgba(14, 165, 240, 0.85) 100%);"></div>
  </div>

  <div class="container py-5 position-relative" style="z-index: 2;">
    <div class="row align-items-center min-vh-70">
      <div class="col-lg-6 text-white py-5">
        <h1 class="display-3 fw-bold mb-4 animate-fade-in">
          Selamat Datang di <span style="color: #fbbf24;">VOIZ FTMM</span>
        </h1>
        <p class="lead mb-4 animate-fade-in-delay">
          Sistem Pengaduan Online Fakultas Teknologi Maju dan Multidisiplin Universitas Airlangga
        </p>
        <p class="mb-4 animate-fade-in-delay-2">
          Sampaikan aspirasi, keluhan, dan saran Anda dengan mudah dan transparan. Kami siap mendengarkan dan menindaklanjuti setiap pengaduan Anda.
        </p>
        <div class="d-flex gap-3 animate-fade-in-delay-3">
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
              <i class="bi bi-megaphone" style="font-size: 5rem; opacity: 0.9;"></i>
              <h3 class="mt-4 fw-bold">Suara Anda Penting</h3>
              <p class="mb-0 opacity-75">Bersama membangun kampus yang lebih baik</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wave-bottom"></div>
</section>

<!-- Statistik Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold mb-2">Statistik Pengaduan</h2>
      <p class="text-muted">Data pengaduan yang masuk ke sistem kami</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card border-0 shadow-sm hover-lift-card h-100">
          <div class="card-body text-center p-4">
            <div class="icon-box mb-3 mx-auto" style="width: 70px; height: 70px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-file-earmark-text text-white" style="font-size: 2rem;"></i>
            </div>
            <h3 class="fw-bold mb-2 counter" data-target="150" style="color: #6B21A8; font-size: 2.5rem;">0</h3>
            <h5 class="mb-2">Total Pengaduan</h5>
            <p class="text-muted small mb-0">Pengaduan yang telah masuk</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm hover-lift-card h-100">
          <div class="card-body text-center p-4">
            <div class="icon-box mb-3 mx-auto" style="width: 70px; height: 70px; background: linear-gradient(135deg, #ef4444, #dc2626); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-hourglass-split text-white" style="font-size: 2rem;"></i>
            </div>
            <h3 class="fw-bold mb-2 counter" data-target="23" style="color: #ef4444; font-size: 2.5rem;">0</h3>
            <h5 class="mb-2">Belum Diproses</h5>
            <p class="text-muted small mb-0">Menunggu tindak lanjut</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm hover-lift-card h-100">
          <div class="card-body text-center p-4">
            <div class="icon-box mb-3 mx-auto" style="width: 70px; height: 70px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-check-circle text-white" style="font-size: 2rem;"></i>
            </div>
            <h3 class="fw-bold mb-2 counter" data-target="127" style="color: #10b981; font-size: 2.5rem;">0</h3>
            <h5 class="mb-2">Selesai</h5>
            <p class="text-muted small mb-0">Telah ditindaklanjuti</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Jenis Pengaduan Section -->
<section id="jenis-pengaduan" class="py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold mb-2">Jenis Pengaduan</h2>
      <p class="text-muted">Pilih kategori pengaduan sesuai dengan keluhan Anda</p>
    </div>
    <div class="row g-4">
      <!-- Card 1: Akademik -->
      <div class="col-md-6 col-lg-4">
        <a href="{{ route('pengaduan.create') }}?kategori=1" class="text-decoration-none">
          <div class="card border-0 shadow-sm hover-scale h-100" style="transition: all 0.3s ease;">
            <div class="card-body text-center p-4">
              <div class="icon-box mb-3 mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-book text-white" style="font-size: 2.5rem;"></i>
              </div>
              <h5 class="fw-bold mb-2">Akademik</h5>
              <p class="text-muted small mb-0">Masalah perkuliahan, kurikulum, nilai, dll.</p>
            </div>
          </div>
        </a>
      </div>
      
      <!-- Card 2: Fasilitas -->
      <div class="col-md-6 col-lg-4">
        <a href="{{ route('pengaduan.create') }}?kategori=2" class="text-decoration-none">
          <div class="card border-0 shadow-sm hover-scale h-100" style="transition: all 0.3s ease;">
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

      <!-- Card 3: Kekerasan -->
      <div class="col-md-6 col-lg-4">
        <a href="{{ route('pengaduan.create') }}?kategori=3" class="text-decoration-none">
          <div class="card border-0 shadow-sm hover-scale h-100" style="transition: all 0.3s ease;">
            <div class="card-body text-center p-4">
              <div class="icon-box mb-3 mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #ef4444, #dc2626); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-shield-exclamation text-white" style="font-size: 2.5rem;"></i>
              </div>
              <h5 class="fw-bold mb-2">Kekerasan</h5>
              <p class="text-muted small mb-0">Bullying, pelecehan, atau kekerasan lainnya</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Card 4: Kemahasiswaan -->
      <div class="col-md-6 col-lg-4">
        <a href="{{ route('pengaduan.create') }}?kategori=4" class="text-decoration-none">
          <div class="card border-0 shadow-sm hover-scale h-100" style="transition: all 0.3s ease;">
            <div class="card-body text-center p-4">
              <div class="icon-box mb-3 mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-people text-white" style="font-size: 2.5rem;"></i>
              </div>
              <h5 class="fw-bold mb-2">Kemahasiswaan</h5>
              <p class="text-muted small mb-0">Sikap atau pelayanan dari pihak kemahasiswaan</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Card 5: Lainnya -->
      <div class="col-md-6 col-lg-4">
        <a href="{{ route('pengaduan.create') }}?kategori=5" class="text-decoration-none">
          <div class="card border-0 shadow-sm hover-scale h-100" style="transition: all 0.3s ease;">
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

<!-- Alur Pengaduan Section -->
<section id="alur" class="py-5" style="background: linear-gradient(135deg, #6B21A8 0%, #7C3AED 50%, #0ea5f0 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-white mb-2">Alur Pengaduan</h2>
      <p class="text-white opacity-75">Proses pengaduan yang mudah dan transparan</p>
    </div>
    <div class="row g-4">
      <div class="col-md-3">
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
      <div class="col-md-3">
        <div class="text-center">
          <div class="alur-circle mx-auto mb-3">
            <i class="bi bi-send" style="font-size: 2.5rem;"></i>
          </div>
          <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
              <div class="badge bg-warning text-dark mb-2">Langkah 2</div>
              <h5 class="fw-bold mb-2">Kirim Pengaduan</h5>
              <p class="text-muted small mb-0">Pengaduan akan masuk ke sistem dan mendapat nomor tiket</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="text-center">
          <div class="alur-circle mx-auto mb-3">
            <i class="bi bi-gear" style="font-size: 2.5rem;"></i>
          </div>
          <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
              <div class="badge bg-warning text-dark mb-2">Langkah 3</div>
              <h5 class="fw-bold mb-2">Diproses Admin</h5>
              <p class="text-muted small mb-0">Tim kami akan menindaklanjuti pengaduan Anda</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="text-center">
          <div class="alur-circle mx-auto mb-3">
            <i class="bi bi-check-circle" style="font-size: 2.5rem;"></i>
          </div>
          <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
              <div class="badge bg-warning text-dark mb-2">Langkah 4</div>
              <h5 class="fw-bold mb-2">Selesai</h5>
              <p class="text-muted small mb-0">Anda akan mendapat notifikasi hasil tindak lanjut</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Kontak Section -->
<section id="kontak" class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h2 class="fw-bold mb-3">Hubungi Kami</h2>
        <p class="text-muted mb-4">Ada pertanyaan atau butuh bantuan? Tim kami siap membantu Anda</p>
        
        <div class="d-flex align-items-start mb-3">
          <div class="icon-box me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-envelope text-white" style="font-size: 1.5rem;"></i>
          </div>
          <div>
            <h6 class="fw-bold mb-1">Email</h6>
            <p class="text-muted mb-0">ftmm@unair.ac.id</p>
          </div>
        </div>

        <div class="d-flex align-items-start mb-3">
          <div class="icon-box me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #0ea5f0, #0284c7); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-telephone text-white" style="font-size: 1.5rem;"></i>
          </div>
          <div>
            <h6 class="fw-bold mb-1">Telepon</h6>
            <p class="text-muted mb-0">(031) 5914042</p>
          </div>
        </div>

        <div class="d-flex align-items-start">
          <div class="icon-box me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-geo-alt text-white" style="font-size: 1.5rem;"></i>
          </div>
          <div>
            <h6 class="fw-bold mb-1">Alamat</h6>
            <p class="text-muted mb-0">Kampus C UNAIR, Mulyorejo, Surabaya</p>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
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

<!-- Pengaduan Anonim Publik Section -->
<section id="pengaduan-anonim" class="py-5" style="background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <div class="mb-3">
        <div class="icon-box mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
          <i class="bi bi-chat-square-dots text-white" style="font-size: 2.5rem;"></i>
        </div>
      </div>
      <h2 class="fw-bold mb-2">Pengaduan Anonim Publik</h2>
      <p class="text-muted">Transparansi pengaduan dari masyarakat kampus</p>
    </div>

    <div class="row g-4">
      <!-- Loop pengaduan anonim dari database -->
      @forelse($pengaduanAnonim ?? [] as $anonim)
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100 hover-lift-card">
          <div class="card-body p-4">
            <!-- Header Card -->
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div>
                <span class="badge mb-2" style="background: linear-gradient(135deg, #6B21A8, #7C3AED);">
                  {{ $anonim->kategori->jenis_komplain ?? 'Umum' }}
                </span>
                <div class="text-muted small">
                  <i class="bi bi-calendar3 me-1"></i>{{ $anonim->created_at->format('d M Y') }}
                </div>
              </div>
              <div class="text-end">
                @if($anonim->status == 'selesai')
                  <span class="badge bg-success">
                    <i class="bi bi-check-circle me-1"></i>Selesai
                  </span>
                @elseif($anonim->status == 'proses')
                  <span class="badge bg-warning">
                    <i class="bi bi-gear me-1"></i>Diproses
                  </span>
                @else
                  <span class="badge bg-secondary">
                    <i class="bi bi-hourglass me-1"></i>Menunggu
                  </span>
                @endif
              </div>
            </div>

            <!-- Isi Pengaduan -->
            <div class="mb-3">
              <h6 class="fw-bold mb-2">Pengaduan:</h6>
              <p class="text-muted mb-0" style="font-size: 0.95rem;">
                {{ Str::limit($anonim->deskripsi_kejadian, 200) }}
              </p>
            </div>

            <!-- Balasan Admin (jika ada) -->
            @if($anonim->tanggapan)
            <div class="mt-3 p-3" style="background: linear-gradient(135deg, rgba(107, 33, 168, 0.05), rgba(14, 165, 240, 0.05)); border-left: 4px solid #6B21A8; border-radius: 8px;">
              <div class="d-flex align-items-center mb-2">
                <i class="bi bi-person-badge me-2" style="color: #6B21A8; font-size: 1.2rem;"></i>
                <strong style="color: #6B21A8;">Tanggapan Admin</strong>
              </div>
              <p class="mb-0" style="font-size: 0.9rem;">{{ $anonim->tanggapan }}</p>
              <small class="text-muted">{{ $anonim->tanggapan_at ? $anonim->tanggapan_at->format('d M Y') : '' }}</small>
            </div>
            @else
            <div class="text-center py-2">
              <small class="text-muted fst-italic">
                <i class="bi bi-clock-history me-1"></i>Menunggu tanggapan admin...
              </small>
            </div>
            @endif

            <!-- Lihat Detail Button -->
            <div class="mt-3">
              <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#detailAnonim{{ $anonim->id }}">
                <i class="bi bi-eye me-1"></i>Lihat Detail Lengkap
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Detail -->
      <div class="modal fade" id="detailAnonim{{ $anonim->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #6B21A8, #7C3AED); color: white;">
              <h5 class="modal-title">
                <i class="bi bi-file-earmark-text me-2"></i>Detail Pengaduan Anonim
              </h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
              <!-- Info -->
              <div class="row mb-3">
                <div class="col-md-6">
                  <small class="text-muted d-block">Kategori</small>
                  <strong>{{ $anonim->kategori->jenis_komplain ?? 'Umum' }}</strong>
                </div>
                <div class="col-md-6">
                  <small class="text-muted d-block">Tanggal Lapor</small>
                  <strong>{{ $anonim->created_at->format('d F Y, H:i') }}</strong>
                </div>
              </div>

              <!-- Deskripsi Full -->
              <div class="mb-4">
                <h6 class="fw-bold mb-2">Deskripsi Kejadian:</h6>
                <p class="text-muted">{{ $anonim->deskripsi_kejadian }}</p>
              </div>

              <!-- Bukti (jika ada) -->
              @if($anonim->bukti)
              <div class="mb-4">
                <h6 class="fw-bold mb-2">Bukti Lampiran:</h6>
                <div class="d-flex gap-2 flex-wrap">
                  @foreach(json_decode($anonim->bukti) as $bukti)
                  <a href="{{ asset('storage/'.$bukti) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-paperclip me-1"></i>Lihat Bukti
                  </a>
                  @endforeach
                </div>
              </div>
              @endif

              <!-- Tanggapan -->
              @if($anonim->tanggapan)
              <div class="p-4" style="background: linear-gradient(135deg, rgba(107, 33, 168, 0.1), rgba(14, 165, 240, 0.1)); border-radius: 12px;">
                <div class="d-flex align-items-center mb-3">
                  <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-person-badge text-white" style="font-size: 1.5rem;"></i>
                  </div>
                  <div class="ms-3">
                    <strong style="color: #6B21A8;">Tanggapan Resmi Admin</strong>
                    <div class="small text-muted">{{ $anonim->tanggapan_at ? $anonim->tanggapan_at->format('d F Y, H:i') : '' }}</div>
                  </div>
                </div>
                <p class="mb-0">{{ $anonim->tanggapan }}</p>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12">
        <div class="text-center py-5">
          <i class="bi bi-inbox" style="font-size: 4rem; color: #d1d5db;"></i>
          <p class="text-muted mt-3 mb-0">Belum ada pengaduan anonim yang ditampilkan</p>
        </div>
      </div>
      @endforelse
    </div>

    <!-- Tombol ke Form Anonim -->
    <div class="text-center mt-5">
      <a href="#form-anonim" class="btn btn-lg text-white px-5" style="background: linear-gradient(135deg, #6B21A8, #7C3AED); border: none;">
        <i class="bi bi-pencil-square me-2"></i>Buat Pengaduan Anonim
      </a>
    </div>
  </div>
</section>

<!-- Form Anonim Section -->
<section id="form-anonim" class="py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #e5e7eb 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <div class="mb-3">
        <div class="icon-box mx-auto" style="width: 80px; height: 80px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
          <i class="bi bi-incognito text-white" style="font-size: 2.5rem;"></i>
        </div>
      </div>
      <h2 class="fw-bold mb-2">Pengaduan Anonim</h2>
      <p class="text-muted">Laporkan tanpa harus login. Identitas Anda akan dirahasiakan</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-lg">
          <div class="card-body p-5">
            <form action="#" method="POST" enctype="multipart/form-data" onsubmit="alert('Form ini masih dummy, belum tersambung ke backend'); return false;">
              @csrf
              
              <!-- Kategori -->
              <div class="mb-4">
                <label class="form-label fw-semibold">Kategori Pengaduan <span class="text-danger">*</span></label>
                <select name="kategori_komplain_id" required class="form-select form-select-lg">
                  <option value="">-- Pilih Kategori --</option>
                  <option value="1">Akademik</option>
                  <option value="2">Fasilitas</option>
                  <option value="3">Kekerasan</option>
                  <option value="4">Kemahasiswaan</option>
                  <option value="5">Lainnya</option>
                </select>
              </div>

              <!-- Deskripsi -->
              <div class="mb-4">
                <label class="form-label fw-semibold">Deskripsi Kejadian <span class="text-danger">*</span></label>
                <textarea name="deskripsi_kejadian" rows="6" required class="form-control form-control-lg" placeholder="Jelaskan detail pengaduan Anda..."></textarea>
                <small class="text-muted">Minimal 50 karakter</small>
              </div>

              <!-- Tanggal Kejadian -->
              <div class="mb-4">
                <label class="form-label fw-semibold">Tanggal Kejadian</label>
                <input type="date" name="tanggal_kejadian" value="{{ date('Y-m-d') }}" class="form-control form-control-lg" max="{{ date('Y-m-d') }}">
              </div>

              <!-- Status Pelapor -->
              <div class="mb-4">
                <label class="form-label fw-semibold">Status Pelapor <span class="text-danger">*</span></label>
                <select name="status_pelapor" required class="form-select form-select-lg">
                  <option value="">-- Pilih Status --</option>
                  <option value="Korban">Korban</option>
                  <option value="Keluarga">Keluarga Korban</option>
                  <option value="Teman">Teman/Kenalan</option>
                  <option value="Saksi">Saksi Mata</option>
                </select>
              </div>

              <!-- Upload Bukti -->
              <div class="mb-4">
                <label class="form-label fw-semibold">Upload Bukti (Opsional)</label>
                <input type="file" name="bukti[]" multiple class="form-control form-control-lg" accept="image/*,.pdf">
                <small class="text-muted">Format: JPG, PNG, PDF • Maksimal 2MB per file</small>
              </div>

              <!-- Info Anonim -->
              <div class="alert alert-info d-flex align-items-center mb-4">
                <i class="bi bi-info-circle me-3" style="font-size: 1.5rem;"></i>
                <div>
                  <strong>Pengaduan Anonim:</strong> Identitas Anda tidak akan disimpan atau ditampilkan. Kami akan memproses laporan tanpa mengetahui siapa pelapor.
                </div>
              </div>

              <!-- Persetujuan -->
              <div class="mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="agreementAnonim" required>
                  <label class="form-check-label" for="agreementAnonim">
                    Saya menyatakan bahwa informasi yang saya berikan adalah <strong>benar</strong>
                  </label>
                </div>
              </div>

              <button type="submit" class="btn btn-lg w-100 text-white" style="background: linear-gradient(135deg, #6B21A8, #7C3AED); border: none;">
                <i class="bi bi-send me-2"></i>Kirim Pengaduan Anonim
              </button>
            </form>
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
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fadeIn 0.8s ease-out;
}

.animate-fade-in-delay {
  animation: fadeIn 0.8s ease-out 0.2s both;
}

.animate-fade-in-delay-2 {
  animation: fadeIn 0.8s ease-out 0.4s both;
}

.animate-fade-in-delay-3 {
  animation: fadeIn 0.8s ease-out 0.6s both;
}

.floating-animation {
  animation: float 3s ease-in-out infinite;
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
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 20px 40px rgba(107, 33, 168, 0.25) !important;
}

.hover-scale {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-scale:hover {
  transform: scale(1.05);
  box-shadow: 0 15px 35px rgba(0,0,0,0.2) !important;
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

/* Wave */
.wave-bottom {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  overflow: hidden;
  line-height: 0;
}

.wave-bottom svg {
  position: relative;
  display: block;
  width: calc(100% + 1.3px);
  height: 60px;
}

.wave-bottom .shape-fill {
  fill: #f8f9fa;
}

/* Smooth Scroll */
html {
  scroll-behavior: smooth;
}

/* Card Animation on Load */
.card {
  animation: slideInUp 0.6s ease-out;
}

/* Counter Animation */
.counter {
  transition: all 0.3s ease;
}

/* Icon Box Pulse */
@keyframes pulse-glow {
  0%, 100% {
    box-shadow: 0 0 10px rgba(107, 33, 168, 0.3);
  }
  50% {
    box-shadow: 0 0 20px rgba(107, 33, 168, 0.6);
  }
}

.icon-box {
  animation: pulse-glow 3s ease-in-out infinite;
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
// Counter Animation
document.addEventListener('DOMContentLoaded', function() {
  const counters = document.querySelectorAll('.counter');
  
  const animateCounter = (counter) => {
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
  };
  
  // Intersection Observer for Counter
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  
  counters.forEach(counter => observer.observe(counter));
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

<!-- Add Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection