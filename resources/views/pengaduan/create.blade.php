@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <!-- Page Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center">
        <a href="{{ route('beranda') }}" class="btn btn-outline-secondary me-3">
          <i class="bi bi-arrow-left"></i>
        </a>
        <div>
          <h2 class="fw-bold mb-1">Buat Pengaduan Baru</h2>
          <p class="text-muted mb-0">Sampaikan keluhan atau aspirasi Anda dengan jelas dan lengkap</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <!-- Form Card -->
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
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
                <div class="alert alert-danger">
                    <strong>Input Gagal, mohon periksa kembali:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
              <!-- Show selected kategori from landing -->
              <div class="mb-4">
                <label class="form-label fw-semibold">Kategori Pengaduan</label>
                <div class="card border-2" style="border-color: #6B21A8;">
                  <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="d-flex align-items-center">
                        <div class="icon-box me-3" style="width: 45px; height: 45px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                          <i class="bi bi-bookmark text-white"></i>
                        </div>
                        <div>
                          <h6 class="fw-bold mb-0">{{ $preKategoriObj->jenis_komplain }}</h6>
                          <small class="text-muted">{{ Str::limit($preKategoriObj->keterangan ?? 'Kategori dipilih dari landing page', 80) }}</small>
                        </div>
                      </div>
                      <a href="{{ url('/') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-pencil me-1"></i>Ubah
                      </a>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="kategori_komplain_id" value="{{ $preKategoriObj->kategori_komplain_id }}">
              </div>
            @else
              <!-- Fallback: Show select dropdown -->
              <div class="mb-4">
                <label class="form-label fw-semibold">Kategori Pengaduan <span class="text-danger">*</span></label>
                <select name="kategori_komplain_id" required class="form-select form-select-lg">
                  <option value="">-- Pilih Kategori --</option>
                  @foreach($kategori as $k)
                    <option value="{{ $k->kategori_komplain_id }}" @if(old('kategori_komplain_id') == $k->kategori_komplain_id) selected @endif>
                      {{ $k->jenis_komplain }}
                    </option>
                  @endforeach
                </select>
                <small class="text-muted">Pilih kategori yang sesuai dengan pengaduan Anda</small>
              </div>
            @endif

            <!-- Deskripsi Kejadian -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Deskripsi Kejadian <span class="text-danger">*</span></label>
              <textarea name="deskripsi_kejadian" rows="6" required class="form-control form-control-lg" placeholder="Jelaskan detail pengaduan Anda dengan jelas dan lengkap...">{{ old('deskripsi_kejadian') }}</textarea>
              <small class="text-muted">Minimal 50 karakter. Semakin detail, semakin mudah kami memproses pengaduan Anda.</small>
            </div>

            <!-- Tanggal Kejadian -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Tanggal Kejadian</label>
              <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', date('Y-m-d')) }}" class="form-control form-control-lg" max="{{ date('Y-m-d') }}">
              <small class="text-muted">Kapan kejadian ini terjadi?</small>
            </div>

            <!-- TAMBAH INI: Status Pelapor -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Status Pelapor <span class="text-danger">*</span></label>
              <select name="status_pelapor" required class="form-select form-select-lg">
              <option value="">-- Pilih Status --</option>
              <option value="Korban" {{ old('status_pelapor') == 'Korban' ? 'selected' : '' }}>Korban</option>
              <option value="Keluarga" {{ old('status_pelapor') == 'Keluarga' ? 'selected' : '' }}>Keluarga Korban</option>
              <option value="Teman" {{ old('status_pelapor') == 'Teman' ? 'selected' : '' }}>Teman/Kenalan</option>
              <option value="Saksi" {{ old('status_pelapor') == 'Saksi' ? 'selected' : '' }}>Saksi Mata</option>
              </select>
              <small class="text-muted">Anda sebagai apa dalam kejadian ini?</small>
            </div>

            <!-- Upload Bukti -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Upload Bukti (Opsional)</label>
              <div class="upload-area" id="uploadArea">
                <input type="file" name="bukti[]" multiple class="form-control d-none" id="buktiInput" accept="image/*,.pdf">
                <label for="buktiInput" class="upload-label">
                  <div class="text-center py-4">
                    <i class="bi bi-cloud-upload" style="font-size: 3rem; color: #6B21A8;"></i>
                    <p class="fw-semibold mb-1">Klik untuk upload file</p>
                    <small class="text-muted">atau drag & drop file di sini</small>
                    <p class="text-muted small mt-2 mb-0">Format: JPG, PNG, PDF • Maksimal 2MB per file • Bisa upload lebih dari satu</p>
                  </div>
                </label>
              </div>
              <div id="filePreview" class="mt-3"></div>
            </div>

            <!-- Modal Preview Gambar -->
            <div id="imageModal" class="image-preview-modal" onclick="closeImageModal()">
              <span class="close-modal-btn" onclick="closeImageModal(event)">&times;</span>
              <div class="modal-image-container" onclick="event.stopPropagation()">
                <img class="modal-content" id="modalImage">
              </div>
            </div>

            <!-- Persetujuan -->
            <div class="mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="agreement" required>
                <label class="form-check-label" for="agreement">
                  Saya menyatakan bahwa informasi yang saya berikan adalah <strong>benar dan dapat dipertanggungjawabkan</strong>
                </label>
              </div>
            </div>

            <!-- Buttons -->
            <div class="d-flex gap-3">
              <button type="submit" class="btn btn-lg text-white px-5" style="background: linear-gradient(135deg, #6B21A8, #7C3AED); border: none;">
                <i class="bi bi-send me-2"></i>Kirim Pengaduan
              </button>
              <a href="{{ route('beranda') }}" class="btn btn-lg btn-outline-secondary px-4">
                Batal
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-lg-4">
      <!-- Panduan -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">
            <i class="bi bi-info-circle me-2" style="color: #6B21A8;"></i>Panduan Pengaduan
          </h5>
        </div>
        <div class="card-body p-4">
          <div class="d-flex mb-3">
            <div class="me-3">
              <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.85rem;">1</div>
            </div>
            <div>
              <h6 class="fw-semibold mb-1">Pilih Kategori</h6>
              <small class="text-muted">Pilih kategori yang sesuai dengan pengaduan Anda</small>
            </div>
          </div>

          <div class="d-flex mb-3">
            <div class="me-3">
              <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.85rem;">2</div>
            </div>
            <div>
              <h6 class="fw-semibold mb-1">Jelaskan Detail</h6>
              <small class="text-muted">Berikan penjelasan yang lengkap dan jelas</small>
            </div>
          </div>

          <div class="d-flex mb-3">
            <div class="me-3">
              <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.85rem;">3</div>
            </div>
            <div>
              <h6 class="fw-semibold mb-1">Upload Bukti</h6>
              <small class="text-muted">Lampirkan foto atau dokumen pendukung jika ada</small>
            </div>
          </div>

          <div class="d-flex">
            <div class="me-3">
              <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #6B21A8, #7C3AED); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.85rem;">4</div>
            </div>
            <div>
              <h6 class="fw-semibold mb-1">Kirim & Lacak</h6>
              <small class="text-muted">Pengaduan akan diproses dan Anda dapat melacak statusnya</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Tips -->
      <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #0ea5f0, #0284c7);">
        <div class="card-body p-4 text-white">
          <h6 class="fw-bold mb-3">
            <i class="bi bi-lightbulb me-2"></i>Tips Pengaduan Efektif
          </h6>
          <ul class="mb-0 ps-3" style="font-size: 0.9rem;">
            <li class="mb-2">Gunakan bahasa yang sopan dan jelas</li>
            <li class="mb-2">Sertakan bukti foto jika memungkinkan</li>
            <li class="mb-2">Sebutkan lokasi dan waktu kejadian</li>
            <li class="mb-0">Cantumkan nama jika diperlukan</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.upload-area {
  border: 2px dashed #d1d5db;
  border-radius: 12px;
  transition: all 0.3s ease;
  cursor: pointer;
}

.upload-area:hover {
  border-color: #6B21A8;
  background: #f9fafb;
}

.upload-area.dragover {
  border-color: #6B21A8;
  background: #f3f4f6;
}

.upload-label {
  cursor: pointer;
  width: 100%;
  margin: 0;
}
#filePreview .file-item {
    display: flex;
    align-items: center;
    padding: 10px;
    background: #f9fafb;
    border-radius: 8px;
    margin-bottom: 8px;
    gap: 10px;
    border: 1px solid #eee;
    margin-top: 8px;
}
#filePreview .remove-file {
  margin-left: auto;
  cursor: pointer;
  color: #ef4444;
  font-size: 1.25rem;
}
.file-thumbnail {
  width: 40px;
  height: 40px;
  object-fit: cover;
  border-radius: 4px;
  cursor: pointer;
}

/* Style untuk Ikon (Non-gambar) */
.file-item > .bi {
  font-size: 1.5rem;
  color: #6c757d;
  width: 40px;
  text-align: center;
}

.file-item .flex-grow-1 {
  overflow: hidden;
}

.file-item .flex-grow-1 .fw-semibold {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.remove-file:hover {
  color: #a71d2a;
}
/* Style untuk Modal Popup Gambar */
.image-preview-modal {
  display: none;
  position: fixed; 
  z-index: 1001;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto; 
  background-color: rgba(0, 0, 0, 0.85);
  align-items: center;
  justify-content: center;
}

.modal-image-container {
  border-radius: 5px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2), 0 6px 20px rgba(0,0,0,0.19);
  background-color: transparent;
  line-height: 0; 
}
.modal-content {
  display: block; 
  object-fit: contain;
  max-width: 90%;
  max-height: 90vh; 
  animation-name: zoom;
  animation-duration: 0.3s;
}
@keyframes zoom {
  from {transform: scale(0.8)}
  to {transform: scale(1)}
}
.close-modal-btn {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
  cursor: pointer;
}
.close-modal-btn:hover,
.close-modal-btn:focus {
  color: #bbb;
  text-decoration: none;
}
.image-preview-modal {
    cursor: pointer;
}
.modal-content {
    cursor: default;
}
</style>

<script>
const buktiInput = document.getElementById('buktiInput');
const filePreview = document.getElementById('filePreview');
const modal = document.getElementById('imageModal');
const modalImage = document.getElementById('modalImage');

let allFiles = []; 

buktiInput.addEventListener('change', function(e) {
  const newFiles = Array.from(e.target.files);
  allFiles = allFiles.concat(newFiles);
  const dt = new DataTransfer();
  allFiles.forEach(file => dt.items.add(file));
  buktiInput.files = dt.files;
  renderFilePreview(allFiles);
});

function renderFilePreview(files) {
  filePreview.innerHTML = ''; 
    Array.from(files).forEach((file, index) => {
    const fileItem = document.createElement('div');
    fileItem.className = 'file-item';
        if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const imageUrl = e.target.result;
        fileItem.innerHTML = `
          <img src="${imageUrl}" alt="${file.name}" class="file-thumbnail" onclick="showImageModal('${imageUrl}')">
          <div class="flex-grow-1">
            <div class="fw-semibold">${file.name}</div>
            <small class="text-muted">${(file.size / 1024).toFixed(2)} KB</small>
          </div>
          <i class="bi bi-x-circle remove-file" onclick="removeFile(${index})"></i>
        `;
      };
      reader.readAsDataURL(file);
    } else {
      fileItem.innerHTML = `
        <i class="bi bi-file-earmark-text"></i>
        <div class="flex-grow-1">
          <div class="fw-semibold">${file.name}</div>
          <small class="text-muted">${(file.size / 1024).toFixed(2)} KB</small>
        </div>
        <i class="bi bi-x-circle remove-file" onclick="removeFile(${index})"></i>
      `;
    }
    filePreview.appendChild(fileItem);
  });
}

function removeFile(index) {
  allFiles.splice(index, 1);
  const dt = new DataTransfer();
  allFiles.forEach(file => dt.items.add(file));
  buktiInput.files = dt.files;
  renderFilePreview(allFiles);
}
function showImageModal(src) {
  modal.style.display = "flex";
  modalImage.src = src;
}

function closeImageModal(event) {
  if (event) {
    event.stopPropagation(); 
  }
  modal.style.display = "none";
}

// Drag & drop
const uploadArea = document.getElementById('uploadArea');

uploadArea.addEventListener('dragover', (e) => {
  e.preventDefault();
  uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', () => {
  uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop',
(e) => {
  e.preventDefault();
  uploadArea.classList.remove('dragover');
  buktiInput.files = e.dataTransfer.files;
  const event = new Event('change');
  buktiInput.dispatchEvent(event);
});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection