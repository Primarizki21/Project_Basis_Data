# ✨ VOIZ-FTMM - Sistem E-Complaint Fakultas Teknologi Maju dan Multidisiplin

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-000000?style=for-the-badge&logo=mysql&logoColor=white)

---

## 👥 Identitas Kelompok

**Judul Project:** PENGEMBANGAN WEB APP SISTEM E-COMPLAINT FAKULTAS TEKNOLOGI MAJU DAN MULTIDISIPLIN
**Nama Aplikasi:** VOIZ-FTMM
**Nomor Kelompok:** [Isi Nomor Kelompok]

### Anggota Tim:
1. **ATIKA NUR FITRI** (164231010)
2. **SEMAYA DAVID PETROES PUTRA** (164231048)
3. **PRIMARIZKI AHMAD HARIYONO** (164231062)
4. **SAFINA AURORA ANDRIANI** (164231102)
5. **PERMATA NABILA BALQIS** (164231109)

---

## 📖 Deskripsi Aplikasi

**VOIZ-FTMM** adalah sistem layanan pengaduan elektronik (*e-complaint*) yang dirancang khusus untuk Fakultas Teknologi Maju dan Multidisiplin (FTMM) Universitas Airlangga.

Aplikasi ini hadir sebagai jembatan komunikasi yang efektif antara civitas akademika dan pihak fakultas. Melalui VOIZ-FTMM, mahasiswa, dosen, tenaga kependidikan, maupun pihak anonim dapat menyampaikan aspirasi, kritik, dan saran demi kemajuan bersama dengan lebih transparan, cepat, dan terukur.

---

## 🛠 Teknologi yang Digunakan

Proyek ini dibangun menggunakan teknologi web modern untuk memastikan performa dan pengalaman pengguna yang optimal:

*   **Backend Framework:** [Laravel 12](https://laravel.com)
*   **Frontend Framework:** [Bootstrap 5](https://getbootstrap.com) (via CDN)
*   **Programming Language:** PHP 8.2+
*   **Database:** MySQL
*   **Dependency Manager:** Composer

---

## 💻 Prasyarat Sistem

Sebelum menjalankan aplikasi ini di komputer lokal Anda, pastikan Anda telah menginstal software berikut:

1.  **PHP** (Minimal versi 8.2)
2.  **Composer** (Manajer dependensi PHP)
3.  **MySQL** (Database server, bisa menggunakan XAMPP/Laragon)
4.  **Git** (Untuk cloning repository)
5.  **Web Browser** (Chrome, Firefox, Edge, dll)

---

## 🚀 Alur Penggunaan (Instalasi)

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer Anda:

### 1. Clone Repository
Unduh source code project ke dalam komputer Anda.
```bash
git clone https://github.com/username/voiz-ftmm.git
cd voiz-ftmm
```

### 2. Install Dependencies
Install seluruh library PHP yang dibutuhkan oleh Laravel.
```bash
composer install
```

### 3. Konfigurasi Environment
Duplikasi file konfigurasi `.env.example` menjadi `.env`.
```bash
cp .env.example .env
```
*Atau jika menggunakan Windows Command Prompt:*
```cmd
copy .env.example .env
```

### 4. Generate Application Key
Generate key enkripsi aplikasi Laravel.
```bash
php artisan key:generate
```

### 5. Konfigurasi Database
Buat database baru di MySQL (misalnya bernama `voiz_ftmm`). Kemudian buka file `.env` dan sesuaikan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=voiz_ftmm  # Sesuaikan dengan nama database Anda
DB_USERNAME=root       # Sesuaikan dengan username database Anda
DB_PASSWORD=           # Sesuaikan dengan password database Anda
```

### 6. Migrasi Database & Seeding
Jalankan migrasi untuk membuat tabel dan mengisi data awal (dummy data) agar aplikasi siap digunakan.
```bash
php artisan migrate:fresh --seed
```

### 7. Setup Storage Link
Buat symbolic link untuk folder storage agar file yang diupload bisa diakses oleh publik.
```bash
php artisan storage:link
```

### 8. Jalankan Server
Jalankan server pengembangan lokal Laravel.
```bash
php artisan serve
```

Akses aplikasi melalui browser di alamat: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔐 Akun Demo

Gunakan akun berikut untuk mencoba fitur-fitur di dalam aplikasi:

### 👤 Akun User (Mahasiswa)
*   **Email:** `oki@ftmm.unair.ac.id`
*   **Password:** `123456`

### 🛡️ Akun Admin
*   **Email:** `admin1@ftmm.unair.ac.id`
*   **Password:** `admin123`

---

Built with ❤️ by **Kelompok VOIZ-FTMM**
