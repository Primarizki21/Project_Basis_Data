@extends('layouts.app')

@section('content')
<div class="container-fluid animate-fade-in">
  <!-- Page Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h2 class="fw-bold mb-2">Kelola User</h2>
          <p class="text-muted mb-0">Manajemen akun pengguna sistem</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
          <i class="bi bi-person-plus me-2"></i>Tambah User Baru
        </button>
      </div>
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-lift">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="icon-box me-3" style="width: 55px; height: 55px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-people text-white" style="font-size: 1.5rem;"></i>
            </div>
            <div>
              <small class="text-muted d-block">Total User</small>
              <h4 class="fw-bold mb-0 counter" data-target="342" style="color: #6B21A8;">0</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-lift">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="icon-box me-3" style="width: 55px; height: 55px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-person-check text-white" style="font-size: 1.5rem;"></i>
            </div>
            <div>
              <small class="text-muted d-block">Mahasiswa</small>
              <h4 class="fw-bold mb-0 counter" data-target="318" style="color: #10b981;">0</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-lift">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="icon-box me-3" style="width: 55px; height: 55px; background: linear-gradient(135deg, #0ea5f0, #0284c7); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-person-badge text-white" style="font-size: 1.5rem;"></i>
            </div>
            <div>
              <small class="text-muted d-block">Staff</small>
              <h4 class="fw-bold mb-0 counter" data-target="19" style="color: #0ea5f0;">0</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card border-0 shadow-sm hover-lift">
        <div class="card-body p-4">
          <div class="d-flex align-items-center">
            <div class="icon-box me-3" style="width: 55px; height: 55px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="bi bi-shield-check text-white" style="font-size: 1.5rem;"></i>
            </div>
            <div>
              <small class="text-muted d-block">Admin</small>
              <h4 class="fw-bold mb-0 counter" data-target="5" style="color: #f59e0b;">0</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Filter & Search -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label fw-semibold small">Cari User</label>
              <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                  <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Nama, NIM, atau email...">
              </div>
            </div>

            <div class="col-md-3">
              <label class="form-label fw-semibold small">Role</label>
              <select class="form-select">
                <option value="">Semua Role</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label fw-semibold small">Program Studi</label>
              <select class="form-select">
                <option value="">Semua Prodi</option>
                <option value="tsd">Teknologi Sains Data</option>
                <option value="rk">Rekayasa Keselamatan</option>
                <option value="rn">Rekayasa Nanoteknologi</option>
                <option value="smb">Studi Manajemen Bencana</option>
              </select>
            </div>

            <div class="col-md-2">
              <label class="form-label fw-semibold small">&nbsp;</label>
              <button class="btn btn-primary w-100">
                <i class="bi bi-funnel me-1"></i>Filter
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- User Table -->
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">Daftar User</h5>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead style="background: #f8f9fa;">
                <tr>
                  <th class="px-4 py-3">Nama</th>
                  <th class="py-3">NIM/NIP</th>
                  <th class="py-3">Email</th>
                  <th class="py-3">Prodi/Unit</th>
                  <th class="py-3">Role</th>
                  <th class="py-3">Bergabung</th>
                  <th class="py-3 text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- User 1 - Mahasiswa -->
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center">
                      <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #6B21A8, #0ea5f0); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 12px;">A</div>
                      <div>
                        <div class="fw-semibold">Ahmad Rizki Pratama</div>
                        <small class="text-muted">Mahasiswa Aktif</small>
                      </div>
                    </div>
                  </td>
                  <td class="py-3">164231001</td>
                  <td class="py-3">ahmad.rizki@ftmm.unair.ac.id</td>
                  <td class="py-3">Teknologi Sains Data</td>
                  <td class="py-3">
                    <span class="badge bg-success">Mahasiswa</span>
                  </td>
                  <td class="py-3">
                    <small>15 Jan 2024</small>
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary" title="Edit">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-outline-info" title="Detail">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-outline-danger" title="Hapus">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- User 2 - Mahasiswa -->
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center">
                      <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #6B21A8, #0ea5f0); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 12px;">S</div>
                      <div>
                        <div class="fw-semibold">Siti Nurhaliza</div>
                        <small class="text-muted">Mahasiswa Aktif</small>
                      </div>
                    </div>
                  </td>
                  <td class="py-3">164231045</td>
                  <td class="py-3">siti.nurhaliza@ftmm.unair.ac.id</td>
                  <td class="py-3">Rekayasa Keselamatan</td>
                  <td class="py-3">
                    <span class="badge bg-success">Mahasiswa</span>
                  </td>
                  <td class="py-3">
                    <small>20 Jan 2024</small>
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-outline-info">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- User 3 - Staff -->
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center">
                      <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #0ea5f0, #0284c7); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 12px;">D</div>
                      <div>
                        <div class="fw-semibold">Dr. Dewi Kusuma</div>
                        <small class="text-muted">Dosen</small>
                      </div>
                    </div>
                  </td>
                  <td class="py-3">199012201502</td>
                  <td class="py-3">dewi.kusuma@ftmm.unair.ac.id</td>
                  <td class="py-3">TSD Department</td>
                  <td class="py-3">
                    <span class="badge bg-info">Staff</span>
                  </td>
                  <td class="py-3">
                    <small>10 Des 2023</small>
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-outline-info">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- User 4 - Admin -->
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center">
                      <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #f59e0b, #d97706); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 12px;">A</div>
                      <div>
                        <div class="fw-semibold">Administrator Utama</div>
                        <small class="text-muted">Super Admin</small>
                      </div>
                    </div>
                  </td>
                  <td class="py-3">-</td>
                  <td class="py-3">admin@ftmm.unair.ac.id</td>
                  <td class="py-3">IT & Admin</td>
                  <td class="py-3">
                    <span class="badge bg-warning text-dark">Admin</span>
                  </td>
                  <td class="py-3">
                    <small>01 Jan 2024</small>
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-outline-info">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-outline-secondary" disabled>
                        <i class="bi bi-shield-lock"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- User 5 - Mahasiswa -->
                <tr class="table-row-hover">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center">
                      <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #6B21A8, #0ea5f0); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; margin-right: 12px;">B</div>
                      <div>
                        <div class="fw-semibold">Budi Santoso</div>
                        <small class="text-muted">Mahasiswa Aktif</small>
                      </div>
                    </div>
                  </td>
                  <td class="py-3">164231062</td>
                  <td class="py-3">budi.santoso@ftmm.unair.ac.id</td>
                  <td class="py-3">Rekayasa Nanoteknologi</td>
                  <td class="py-3">
                    <span class="badge bg-success">Mahasiswa</span>
                  </td>
                  <td class="py-3">
                    <small>22 Feb 2024</small>
                  </td>
                  <td class="py-3 text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-outline-info">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pagination -->
        <div class="card-footer bg-white border-0 p-4">
          <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">Menampilkan 1-5 dari 342 user</small>
            <nav>
              <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled">
                  <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">69</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Next</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add User -->
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(135deg, #6B21A8, #0ea5f0); color: white;">
        <h5 class="modal-title">
          <i class="bi bi-person-plus me-2"></i>Tambah User Baru
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <form>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Nama Lengkap</label>
              <input type="text" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" class="form-control" placeholder="@ftmm.unair.ac.id" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">NIM/NIP</label>
              <input type="text" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">No. Telepon</label>
              <input type="tel" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Role</label>
              <select class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="mahasiswa">Mahasiswa</option>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Program Studi</label>
              <select class="form-select">
                <option value="">-- Pilih Prodi --</option>
                <option value="tsd">Teknologi Sains Data</option>
                <option value="rk">Rekayasa Keselamatan</option>
                <option value="rn">Rekayasa Nanoteknologi</option>
                <option value="smb">Studi Manajemen Bencana</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Password</label>
              <input type="password" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Konfirmasi Password</label>
              <input type="password" class="form-control" required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">
          <i class="bi bi-save me-2"></i>Simpan User
        </button>
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

.hover-lift {
  transition: all 0.3s ease;
}

.hover-lift:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.table-row-hover {
  transition: all 0.2s ease;
}

.table-row-hover:hover {
  background: #f9fafb;
  transform: scale(1.005);
}
</style>

<script>
// Counter Animation
document.addEventListener('DOMContentLoaded', function() {
  const counters = document.querySelectorAll('.counter');
  
  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute('data-target'));
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;
    
    const updateCounter = ()
    => {
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
});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection