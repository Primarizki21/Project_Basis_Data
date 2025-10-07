<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - VOIZ FTMM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(107, 33, 168, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(14, 165, 240, 0.03) 0%, transparent 50%);
            z-index: 0;
        }

        .auth-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .auth-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 550px;
            width: 100%;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-header {
            background: linear-gradient(135deg, #6B21A8 0%, #7C3AED 50%, #0ea5f0 100%);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .auth-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(20px, 20px); }
        }

        .auth-header h1 {
            color: white;
            font-weight: 700;
            margin: 0;
            font-size: 1.75rem;
            position: relative;
            z-index: 1;
        }

        .auth-header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0.5rem 0 0 0;
            position: relative;
            z-index: 1;
            font-size: 0.95rem;
        }

        .auth-body {
            padding: 2.5rem 2rem;
            max-height: 70vh;
            overflow-y: auto;
        }

        .auth-body::-webkit-scrollbar {
            width: 6px;
        }

        .auth-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .auth-body::-webkit-scrollbar-thumb {
            background: #7C3AED;
            border-radius: 10px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-label .text-danger {
            font-size: 1rem;
        }

        .form-control, .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #7C3AED;
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            z-index: 10;
        }

        .form-control.with-icon {
            padding-left: 3rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6B21A8, #7C3AED);
            border: none;
            border-radius: 12px;
            padding: 0.875rem 1.5rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(107, 33, 168, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(107, 33, 168, 0.4);
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1));
            color: #dc2626;
        }

        .link-primary {
            color: #7C3AED;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .link-primary:hover {
            color: #6B21A8;
        }

        .back-to-home {
            position: absolute;
            top: 2rem;
            left: 2rem;
            z-index: 10;
        }

        .back-to-home a {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .back-to-home a:hover {
            transform: translateX(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        @media (max-width: 576px) {
            .auth-body {
                padding: 2rem 1.5rem;
            }

            .back-to-home {
                top: 1rem;
                left: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="back-to-home">
        <a href="{{ route('welcome') }}">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Daftar Akun Baru</h1>
                <p>Bergabunglah dengan VOIZ FTMM</p>
            </div>

            <div class="auth-body">
                @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2 ps-3">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <!-- NIM/NIP -->
                        <div class="col-12">
                            <label for="nim" class="form-label">NIM/NIP <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <i class="bi bi-person-badge input-icon"></i>
                                <input type="text" class="form-control with-icon" id="nim" name="nim" value="{{ old('nim') }}" placeholder="162011233078" required>
                            </div>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="col-12">
                            <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <i class="bi bi-person input-icon"></i>
                                <input type="text" class="form-control with-icon" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Ahmad Zainul" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-12">
                            <label for="email" class="form-label">Email FTMM <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <i class="bi bi-envelope input-icon"></i>
                                <input type="email" class="form-control with-icon" id="email" name="email" value="{{ old('email') }}" placeholder="nama@ftmm.unair.ac.id" required>
                            </div>
                            <small class="text-muted">Gunakan email @ftmm.unair.ac.id</small>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- No. Telepon -->
                        <div class="col-md-6">
                            <label for="nomor_telepon" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="081234567890" required>
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Surabaya" required>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        </div>

                        <!-- Alamat -->
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Jl. Mulyorejo..." required>{{ old('alamat') }}</textarea>
                        </div>

                        <!-- Jenis Pekerjaan -->
                        <div class="col-12">
                            <label for="jenis_pekerjaan_id" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="jenis_pekerjaan_id" name="jenis_pekerjaan_id" required>
                                <option value="">Pilih Status</option>
                                @foreach($listPekerjaan ?? [] as $pekerjaan)
                                <option value="{{ $pekerjaan->jenis_pekerjaan_id }}" {{ old('jenis_pekerjaan_id') == $pekerjaan->jenis_pekerjaan_id ? 'selected' : '' }}>
                                    {{ $pekerjaan->nama_pekerjaan }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Prodi (Conditional) -->
                        <div class="col-md-6" id="prodiField" style="display: none;">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <select class="form-select" id="prodi" name="prodi">
                                <option value="">Pilih Prodi</option>
                                @foreach($listProdi ?? [] as $prodi)
                                <option value="{{ $prodi->nama_prodi }}" {{ old('prodi') == $prodi->nama_prodi ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Angkatan (Conditional) -->
                        <div class="col-md-6" id="angkatanField" style="display: none;">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="text" class="form-control" id="angkatan" name="angkatan" value="{{ old('angkatan') }}" placeholder="2023">
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Min. 6 karakter" required>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </button>

                    <div class="text-center mt-3">
                        <span class="text-muted">Sudah punya akun?</span>
                        <a href="{{ route('login.form') }}" class="link-primary ms-1">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pekerjaanSelect = document.getElementById('jenis_pekerjaan_id');
            const prodiField = document.getElementById('prodiField');
            const angkatanField = document.getElementById('angkatanField');

            function toggleFields() {
                if (pekerjaanSelect.value === '1') {
                    prodiField.style.display = 'block';
                    angkatanField.style.display = 'block';
                } else {
                    prodiField.style.display = 'none';
                    angkatanField.style.display = 'none';
                }
            }

            pekerjaanSelect.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script>
</body>
</html>
