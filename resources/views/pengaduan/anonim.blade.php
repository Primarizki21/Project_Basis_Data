@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <!-- Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex align-items-center">
        <a href="{{ route('beranda') }}" class="btn btn-outline-secondary me-3">
          <i class="bi bi-arrow-left"></i>
        </a>
        <div>
          <h2 class="fw-bold mb-1">Pengaduan Anonim</h2>
          <p class="text-muted mb-0">Sampaikan laporan tanpa mencantumkan identitas pribadi Anda</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <form action="{{ route('pengaduan.storeAnonim') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Kategori -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Kategori Pengaduan <span class="text-danger">*</span></label>
              <select name="kategori_komplain_id" required class="form-select form-select-lg">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                  <option value="{{ $k->kategori_komplain_id }}" @if(old('kategori_komplain_id') == $k->kategori_komplain_id) selected @endif>
                    {{ $k->kategori_komplain_id }}
                  </option>
                @endforeach
              </select>
              <small class="text-muted">Pilih kategori yang paling sesuai dengan isi pengaduan Anda.</small>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Deskripsi Kejadian <span class="text-danger">*</span></label>
              <textarea name="deskripsi_kejadian" rows="6" required class="form-control form-control-lg" placeholder="Jelaskan kronologi kejadian secara lengkap...">{{ old('deskripsi_kejadian') }}</textarea>
              <small class="text-muted">Minimal 50 karakter. Tidak perlu mencantumkan identitas pribadi.</small>
            </div>

            <!-- Tanggal Kejadian -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Tanggal Kejadian</label>
              <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', date('Y-m-d')) }}" class="form-control form-control-lg" max="{{ date('Y-m-d') }}">
              <small class="text-muted">Isi tanggal jika diketahui.</small>
            </div>

            <!-- Lokasi Kejadian -->
            <div class="mb-4">
              <label class="form-label fw-semibold">Lokasi Kejadian</label>
              <input type="text" name="lokasi_kejadian" value="{{ old('lokasi_kejadian') }}" class="form-control form-control-lg" placeholder="Contoh: Gedung A, Ruang 101">
              <small class="text-muted">Boleh dikosongkan jika tidak ingin disebut.</small>
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
                    <p class="text-muted small mt-2 mb-0">Format: JPG, PNG, PDF • Maks 2MB per file</p>
                  </div>
                </label>
              </div>
              <div id="filePreview" class="mt-3"></div>
            </div>

            <!-- Persetujuan -->
            <div class="mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="agreement" required>
                <label class="form-check-label" for="agreement">
                  Saya memahami bahwa laporan ini akan dikirim secara <strong>anonim</strong> dan informasi yang diberikan adalah benar.
                </label>
              </div>
            </div>

            <!-- Tombol -->
            <div class="d-flex gap-3">
              <button type="submit" class="btn btn-lg text-white px-5" style="background: linear-gradient(135deg, #6B21A8, #7C3AED); border: none;">
                <i class="bi bi-send me-2"></i>Kirim Anonim
              </button>
              <a href="{{ route('beranda') }}" class="btn btn-lg btn-outline-secondary px-4">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 p-4">
          <h5 class="fw-bold mb-0">
            <i class="bi bi-shield-lock me-2" style="color: #6B21A8;"></i>Privasi Terjamin
          </h5>
        </div>
        <div class="card-body p-4">
          <p class="text-muted mb-3">Laporan Anda tidak akan menyertakan nama, email, atau data pribadi apa pun. Identitas pelapor sepenuhnya disembunyikan.</p>
          <ul class="ps-3 mb-0">
            <li class="text-muted mb-2">Gunakan bahasa sopan dan jelas</li>
            <li class="text-muted mb-2">Sertakan bukti jika tersedia</li>
            <li class="text-muted mb-2">Pastikan informasi faktual</li>
            <li class="text-muted">Jangan menyebut nama orang secara langsung tanpa bukti</li>
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
}

#filePreview .file-item i {
  font-size: 1.5rem;
  margin-right: 10px;
  color: #6B21A8;
}

#filePreview .remove-file {
  margin-left: auto;
  cursor: pointer;
  color: #ef4444;
}
</style>

<script>
// File upload preview
document.getElementById('buktiInput').addEventListener('change', function(e) {
  const filePreview = document.getElementById('filePreview');
  filePreview.innerHTML = '';
  
  Array.from(e.target.files).forEach((file, index) => {
    const fileItem = document.createElement('div');
    fileItem.className = 'file-item';
    fileItem.innerHTML = `
      <i class="bi bi-file-earmark"></i>
      <div class="flex-grow-1">
        <div class="fw-semibold">${file.name}</div>
        <small class="text-muted">${(file.size / 1024).toFixed(2)} KB</small>
      </div>
      <i class="bi bi-x-circle remove-file" onclick="removeFile(${index})"></i>
    `;
    filePreview.appendChild(fileItem);
  });
});

// Drag & drop
const uploadArea = document.getElementById('uploadArea');
const buktiInput = document.getElementById('buktiInput');

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
  
  // Trigger change event
  const event = new Event('change');
  buktiInput.dispatchEvent(event);
});

// Remove file function
function removeFile(index) {
  const dt = new DataTransfer();
  const files = buktiInput.files;
  
  for (let i = 0; i < files.length; i++) {
    if (i !== index) {
      dt.items.add(files[i]);
    }
  }
  
  buktiInput.files = dt.files;
  
  // Refresh preview
  const event = new Event('change');
  buktiInput.dispatchEvent(event);
}
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
@endsection
