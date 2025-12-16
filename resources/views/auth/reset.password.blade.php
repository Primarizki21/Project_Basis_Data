<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - VOIZ FTMM</title>
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
        <a href="{{ route('login.form') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary bg-white px-4 py-2 rounded-xl shadow-sm hover:shadow-md hover:-translate-x-1 transition-all duration-300 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali</span>
        </a>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-[24px] shadow-[0_20px_60px_rgba(0,0,0,0.08)] overflow-hidden w-full max-w-[450px] animate-[slideUp_0.6s_ease-out]">
            <!-- Header -->
            <div class="relative bg-gradient-to-br from-primary via-[#7C3AED] to-secondary p-8 text-center overflow-hidden">
                <div class="absolute top-[-50%] left-[-50%] w-[200%] h-[200%] animate-[float_6s_ease-in-out_infinite] bg-[radial-gradient(circle,rgba(255,255,255,0.1)_0%,transparent_70%)]"></div>
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 relative z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
                <h1 class="relative z-10 text-white font-bold text-2xl m-0">Reset Password</h1>
                <p class="relative z-10 text-white/90 mt-2 m-0">Buat password baru untuk akun Anda</p>
            </div>

            <!-- Body -->
            <div class="p-8 lg:p-10">
                @if(session('success'))
                <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 flex items-start border-l-4 border-green-500 animate-[slideIn_0.5s_ease-out]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mr-3 flex-shrink-0 mt-0.5">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <strong class="block font-bold">Berhasil!</strong>
                        <p class="text-sm mt-1">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6 flex items-center border-l-4 border-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    {{ $errors->first() }}
                </div>
                @endif

                <div class="bg-gradient-to-br from-[#0ea5f0]/5 to-blue-500/5 rounded-xl p-4 mb-6 text-[#0284c7] text-sm flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <p>Masukkan password baru Anda, lalu konfirmasi untuk menyelesaikan reset.</p>
                </div>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-4">
                        <label for="email" class="block font-semibold text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5 pointer-events-none">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <input type="email"
                                   class="w-full border-2 border-gray-200 rounded-xl py-3 pl-12 pr-4 text-gray-700 focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300 @error('email') border-red-500 @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $email) }}"
                                   placeholder="nama@ftmm.unair.ac.id"
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block font-semibold text-gray-700 mb-2">Password Baru</label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5 pointer-events-none">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <input type="password"
                                   class="w-full border-2 border-gray-200 rounded-xl py-3 pl-12 pr-4 text-gray-700 focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300 @error('password') border-red-500 @enderror"
                                   id="password"
                                   name="password"
                                   placeholder="Minimal 6 karakter"
                                   required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5 pointer-events-none">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <input type="password"
                                   class="w-full border-2 border-gray-200 rounded-xl py-3 pl-12 pr-4 text-gray-700 focus:outline-none focus:border-[#7C3AED] focus:ring-4 focus:ring-[#7C3AED]/10 transition-all duration-300"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Ulangi password baru"
                                   required>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-[#6B21A8] to-[#7C3AED] text-white font-semibold py-3.5 px-6 rounded-xl shadow-[0_4px_12px_rgba(107,33,168,0.3)] hover:shadow-[0_8px_20px_rgba(107,33,168,0.4)] hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Reset Password
                    </button>

                    <div class="text-center">
                        <span class="text-gray-500">Ingat password lama?</span>
                        <a href="{{ route('login.form') }}" class="text-[#7C3AED] hover:text-[#6B21A8] hover:underline font-medium ml-1">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
