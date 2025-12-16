<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - VOIZ FTMM</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-200 relative overflow-x-hidden">
    <!-- Background Patterns -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-[20%] left-[20%] w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[20%] right-[20%] w-96 h-96 bg-secondary/5 rounded-full blur-3xl"></div>
    </div>

    <!-- Back to Home -->
    <div class="absolute top-4 left-4 lg:top-8 lg:left-8 z-10">
        <a href="{{ route('welcome') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary bg-white px-4 py-2 rounded-xl shadow-sm hover:shadow-md hover:-translate-x-1 transition-all duration-300 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali</span>
        </a>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-[24px] shadow-[0_20px_60px_rgba(0,0,0,0.08)] overflow-hidden w-full max-w-[550px] animate-[slideUp_0.6s_ease-out] my-8">
            <!-- Header -->
            <div class="relative bg-gradient-to-br from-primary via-[#7C3AED] to-secondary p-8 text-center overflow-hidden">
                <div class="absolute top-[-50%] left-[-50%] w-[200%] h-[200%] animate-[float_6s_ease-in-out_infinite] bg-[radial-gradient(circle,rgba(255,255,255,0.1)_0%,transparent_70%)]"></div>
                <h1 class="relative z-10 text-white font-bold text-2xl m-0">Daftar Akun Baru</h1>
                <p class="relative z-10 text-white/90 mt-2 m-0 text-sm">Bergabunglah dengan VOIZ FTMM</p>
            </div>

            <!-- Body -->
            <div class="p-8 lg:p-10 max-h-[70vh] overflow-y-auto scrollbar-thin scrollbar-thumb-[#7C3AED] scrollbar-track-gray-100">
                @if($errors->any())
                <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6 text-sm">
                    <div class="flex items-center mb-2 font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        Terjadi kesalahan:
                    </div>
                    <ul class="list-disc pl-9 m-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- NIM/NIP -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="nim" class="block font-semibold text-gray-700 mb-2 text-sm">NIM/NIP <span class="text-red-500 text-base">*</span></label>
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5 pointer-events-none">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-1.294-1.51l-1.294 1.51c-.139.162-.355.195-.533.097-1.403-.769-3.08-1.574-3.553-1.85-.357-.208-.432-.69-.175-1.026.47-.615.913-1.272 1.32-1.956.143-.242.42-.365.688-.293 1.05.275 2.05.275 3.099 0 .269-.071.545.05.688.293.407.684.85 1.341 1.32 1.956.257.337.182.818-.175 1.026-.473.276-2.15.881-3.553 1.85-.178.098-.394.065-.533-.097z" />
                                </svg>
                                <input type="text" class="w-full border-2 border-gray-200 rounded-xl py-2.5 pl-12 pr-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="nim" name="nim" value="{{ old('nim') }}" placeholder="162011233078" required>
                            </div>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="nama" class="block font-semibold text-gray-700 mb-2 text-sm">Nama Lengkap <span class="text-red-500 text-base">*</span></label>
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5 pointer-events-none">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <input type="text" class="w-full border-2 border-gray-200 rounded-xl py-2.5 pl-12 pr-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Ahmad Zainul" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="email" class="block font-semibold text-gray-700 mb-2 text-sm">Email FTMM <span class="text-red-500 text-base">*</span></label>
                            <div class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5 pointer-events-none">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <input type="email" class="w-full border-2 border-gray-200 rounded-xl py-2.5 pl-12 pr-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="email" name="email" value="{{ old('email') }}" placeholder="nama@ftmm.unair.ac.id" required>
                            </div>
                            <small class="text-gray-500 text-xs mt-1 block">Gunakan email @ftmm.unair.ac.id</small>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block font-semibold text-gray-700 mb-2 text-sm">Jenis Kelamin <span class="text-red-500 text-base">*</span></label>
                            <select class="w-full border-2 border-gray-200 rounded-xl py-2.5 px-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- No. Telepon -->
                        <div>
                            <label for="nomor_telepon" class="block font-semibold text-gray-700 mb-2 text-sm">No. Telepon <span class="text-red-500 text-base">*</span></label>
                            <input type="tel" class="w-full border-2 border-gray-200 rounded-xl py-2.5 px-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="081234567890" required>
                        </div>

                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir" class="block font-semibold text-gray-700 mb-2 text-sm">Tempat Lahir <span class="text-red-500 text-base">*</span></label>
                            <input type="text" class="w-full border-2 border-gray-200 rounded-xl py-2.5 px-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Surabaya" required>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block font-semibold text-gray-700 mb-2 text-sm">Tanggal Lahir <span class="text-red-500 text-base">*</span></label>
                            <input type="date" class="w-full border-2 border-gray-200 rounded-xl py-2.5 px-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        </div>

                        <!-- Alamat -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="alamat" class="block font-semibold text-gray-700 mb-2 text-sm">Alamat <span class="text-red-500 text-base">*</span></label>
                            <textarea class="w-full border-2 border-gray-200 rounded-xl py-2.5 px-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="alamat" name="alamat" rows="2" placeholder="Jl. Mulyorejo..." required>{{ old('alamat') }}</textarea>
                        </div>

                        <!-- Jenis Pekerjaan -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="jenis_pekerjaan_id" class="block font-semibold text-gray-700 mb-2 text-sm">Status <span class="text-red-500 text-base">*</span></label>
                            <select class="w-full border-2 border-gray-200 rounded-xl py-2.5 px-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="jenis_pekerjaan_id" name="jenis_pekerjaan_id" required>
                                <option value="">Pilih Status</option>
                                @foreach($listPekerjaan ?? [] as $pekerjaan)
                                <option value="{{ $pekerjaan->jenis_pekerjaan_id }}" {{ old('jenis_pekerjaan_id') == $pekerjaan->jenis_pekerjaan_id ? 'selected' : '' }}>
                                    {{ $pekerjaan->nama_pekerjaan }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Prodi (Conditional) -->
                        <div class="col-span-1" id="prodiField" style="display: none;">
                                <label for="prodi" class="block font-semibold text-gray-700 mb-2 text-sm" id="prodiLabel">Program Studi</label>
                                <select class="w-full border-2 border-gray-200 rounded-xl py-2.5 px-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="prodi" name="prodi">
                                <option value="">Pilih Prodi</option>
                                @foreach($listProdi ?? [] as $prodi)
                                <option value="{{ $prodi->prodi_id }}" {{ old('prodi') == $prodi->prodi_id ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Angkatan (Conditional) -->
                        <div class="col-span-1" id="angkatanField" style="display: none;">
                            <label for="angkatan" class="block font-semibold text-gray-700 mb-2 text-sm">Angkatan</label>
                            <input type="text" class="w-full border-2 border-gray-200 rounded-xl py-2.5 px-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="angkatan" name="angkatan" value="{{ old('angkatan') }}" placeholder="2023">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block font-semibold text-gray-700 mb-2 text-sm">Password <span class="text-red-500 text-base">*</span></label>
                            <input type="password" class="w-full border-2 border-gray-200 rounded-xl py-2.5 px-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="password" name="password" placeholder="Min. 6 karakter" required>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block font-semibold text-gray-700 mb-2 text-sm">Konfirmasi Password <span class="text-red-500 text-base">*</span></label>
                            <input type="password" class="w-full border-2 border-gray-200 rounded-xl py-2.5 px-4 text-gray-700 text-sm focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-[#6B21A8] to-[#7C3AED] text-white font-semibold py-3.5 px-6 rounded-xl shadow-[0_4px_12px_rgba(107,33,168,0.3)] hover:shadow-[0_8px_20px_rgba(107,33,168,0.4)] hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center mt-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                        Daftar Sekarang
                    </button>

                    <div class="text-center mt-4 text-sm">
                        <span class="text-gray-500">Sudah punya akun?</span>
                        <a href="{{ route('login.form') }}" class="text-[#7C3AED] hover:text-[#6B21A8] hover:underline font-medium ml-1">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pekerjaanSelect = document.getElementById('jenis_pekerjaan_id');
            const prodiField = document.getElementById('prodiField');
            const angkatanField = document.getElementById('angkatanField');
            const prodiLabel = document.getElementById('prodiLabel');

            function toggleFields() {
                const selectedValue = pekerjaanSelect.value;

                if (selectedValue === '1') {
                    // Mahasiswa
                    prodiField.style.display = 'block';
                    angkatanField.style.display = 'block';
                    prodiLabel.textContent = 'Program Studi';

                    // Add col-span to adjust grid layout if needed
                    prodiField.classList.remove('col-span-2');
                    prodiField.classList.add('col-span-1');

                } else if (selectedValue === '2' || selectedValue === '3') {
                    // Dosen / Tendik
                    prodiField.style.display = 'block';
                    angkatanField.style.display = 'none';
                    prodiLabel.textContent = 'Unit / Program Studi';

                    // Make it full width since angkatan is hidden
                    prodiField.classList.remove('col-span-1');
                    prodiField.classList.add('col-span-1'); // Keep as is or make full width
                     // Actually better to keep grid consistent or span 2 if alone?
                     // Let's make it span 2 if alone
                     prodiField.classList.remove('col-span-1');
                     prodiField.classList.add('col-span-2');
                
                } else {
                    prodiField.style.display = 'none';
                    angkatanField.style.display = 'none';
                }
            }

            if(pekerjaanSelect) {
                pekerjaanSelect.addEventListener('change', toggleFields);
                toggleFields();
            }
        });
    </script>
</body>
</html>
