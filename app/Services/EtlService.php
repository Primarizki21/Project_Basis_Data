<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EtlService
{
    protected $oltp = 'mysql';// Database OLTP
    protected $olap = 'olap'; // Database Warehouse
    protected $olap_db_name;

    public function __construct()
    {
        $this->olap_db_name = config('database.connections.olap.database');
    }

    public function runAll()
    {
        // 1. Dimensi
        $this->refreshDimProfil();
        $this->refreshDimAdmin();
        $this->refreshDimWaktu();
        $this->refreshDimKategori();
        $this->refreshDimPelapor();
        
        // 2. Tabel Fakta
        $this->refreshFactInteraksiTiket();
        $this->refreshFactPerformaAdmin();
        $this->refreshFactRekapDemografi();
    }

    public function refreshDimPelapor()
    {
        $sourceData = DB::connection($this->oltp)
            ->table('user')
            ->leftJoin('prodi', 'user.prodi_id', '=', 'prodi.prodi_id')
            ->leftJoin('jenis_pekerjaan', 'user.jenis_pekerjaan_id', '=', 'jenis_pekerjaan.jenis_pekerjaan_id')
            ->select(
                'user.user_id as user_id',
                'user.nim',
                'user.nama',
                'user.email',
                'user.angkatan',  
                'user.jenis_kelamin',
                'prodi.nama_prodi',
                'jenis_pekerjaan.nama_pekerjaan'
            )
            ->get();

        // 2. Masukkan ke OLAP (Dimensi Pelapor)
        foreach ($sourceData as $row) {
            DB::connection($this->olap)->table('dim_pelapor')->updateOrInsert(
                ['user_id' => $row->user_id], 
                
                // DATA YANG DI-UPDATE/INSERT
                [
                    'nim'    => $row->nim,
                    'nama'    => $row->nama,
                    'email'    => $row->email,
                    'angkatan'        => $row->angkatan ?? null,
                    'jenis_kelamin'   => $row->jenis_kelamin ?? 'NA',
                    'nama_prodi'           => $row->nama_prodi ?? 'Tidak Diketahui',
                    'nama_pekerjaan' => $row->nama_pekerjaan ?? 'Tidak Diketahui',
                ]
            );
        }
    }

    public function refreshDimAdmin()
    {
        // 1. Ambil Data dari OLTP
        // Ganti 'user' dengan nama tabel admin di aplikasimu (misal: 'admins', 'petugas', atau 'user' dengan where)
        $sourceData = DB::connection($this->oltp)
            ->table('admin') 
            ->select('admin_id', 'nip', 'nama', 'email') // Sesuaikan nama kolom aslinya
            ->get();

        // 2. Masukkan ke OLAP (Dimensi Admin)
        foreach ($sourceData as $row) {
            DB::connection($this->olap)->table('dim_admin')->updateOrInsert(
                // KUNCI PENCARIAN (Natural Key)
                ['admin_id' => $row->admin_id], 
                
                // DATA YANG DI-UPDATE/INSERT
                [
                    'nip'   => $row->nip, 
                    'nama'  => $row->nama,
                    'email' => $row->email,
                    // Pakai operator ?? untuk jaga-jaga kalau NIP kosong
                ]
            );
        }
    }

    public function refreshDimKategori()
    {
        // 1. Ambil Data dari OLTP (Tabel Master Kategori)
        // Asumsi: Nama tabel di database aplikasimu adalah 'kategoris' 
        // dan kolom namanya adalah 'nama_kategori'
        $sourceData = DB::connection($this->oltp)
                        ->table('kategori_komplain')
                        ->select('kategori_komplain_id', 'jenis_komplain', 'deskripsi_komplain') 
                        ->get();

        // 2. Masukkan ke OLAP (Dimensi)
        foreach ($sourceData as $row) {
            DB::connection($this->olap)->table('dim_kategori')->updateOrInsert(
                ['kategori_komplain_id' => $row->kategori_komplain_id], 
                
                [
                    'jenis_komplain'     => $row->jenis_komplain,
                    'deskripsi_komplain' => $row->deskripsi_komplain ?? 'Tidak ada deskripsi', 
                ]
            );
        }
    }

    public function refreshDimProfil()
    {
        $sourceData = DB::connection($this->oltp)
            ->table('user') // Perhatikan nama tabelnya 'user' (singular) sesuai gambarmu
            ->leftJoin('prodi', 'user.prodi_id', '=', 'prodi.prodi_id') // Sesuaikan FK 'prodi_id'
            ->leftJoin('jenis_pekerjaan', 'user.jenis_pekerjaan_id', '=', 'jenis_pekerjaan.jenis_pekerjaan_id') // FK 'jenis_pekerjaan_id'
            ->select(
                'user.angkatan',
                'user.jenis_kelamin',
                'prodi.nama_prodi',
                'jenis_pekerjaan.nama_pekerjaan'
            )
            ->distinct() // MAGIC WORD: Ini yang membuat "Junk Dimension" bekerja
            ->get();

        // 2. Masukkan ke OLAP (Dimensi Profil)
        foreach ($sourceData as $row) {
            // Bersihkan data null (Standardisasi)
            $namaProdi      = $row->nama_prodi ?? 'Tidak Diketahui';
            $namaPekerjaan  = $row->nama_pekerjaan ?? 'Tidak Diketahui';
            $angkatan       = $row->angkatan ?? '0';
            $jenisKelamin   = $row->jenis_kelamin ?? 'Tidak Diketahui';

            DB::connection($this->olap)->table('dim_profil')->updateOrInsert(
                // KUNCI PENCARIAN (4 Kolom Sekaligus)
                // Cek: Apakah kombinasi Prodi A + Pekerjaan B + Angkatan C + JK D sudah ada?
                [
                    'nama_prodi'      => $namaProdi,
                    'nama_pekerjaan'  => $namaPekerjaan,
                    'angkatan'        => $angkatan,
                    'jenis_kelamin'   => $jenisKelamin,
                ],
                
                // DATA YANG DI-UPDATE
                // Karena ini dimensi kombinasi, isinya sama dengan kuncinya.
                [
                    'nama_prodi'      => $namaProdi,
                    'nama_pekerjaan'  => $namaPekerjaan,
                    'angkatan'        => $angkatan,
                    'jenis_kelamin'   => $jenisKelamin,
                ]
            );
        }
    }

    public function refreshFactRekapDemografi()
    {
        DB::connection($this->olap)->table('fact_rekap_demografi')->truncate();

        $dataRekap = DB::connection($this->oltp)->table('pengaduan as p')
            ->join('user as u', 'p.user_id', '=', 'u.id')
            
            ->join($this->olap_db_name . '.dim_profil as dp', function($join) {
                $join->on(DB::raw('COALESCE(u.prodi, "Tidak Diketahui")'), '=', 'dp.nama_prodi')
                     ->on(DB::raw('COALESCE(u.angkatan, "0")'), '=', 'dp.tahun_angkatan')
                     ->on(DB::raw('COALESCE(u.jenis_kelamin, "Tidak Diketahui")'), '=', 'dp.jenis_kelamin')
                     ->on(DB::raw('COALESCE(u.pekerjaan, "Tidak Diketahui")'), '=', 'dp.jenis_pekerjaan');
            })
            
            ->join('kategoris as k_oltp', 'p.kategori_id', '=', 'k_oltp.id')
            ->join($this->olap_db_name . '.dim_kategori as dk', 'k_oltp.nama_kategori', '=', 'dk.jenis_kategori')

            ->select(
                DB::raw("CAST(DATE_FORMAT(p.created_at, '%Y%m01') AS UNSIGNED) as id_waktu"),
                
                'dp.id_profil as id_profil',
                
                'dk.id_kategori as id_kategori',
                
                DB::raw('COUNT(p.id) as jumlah_pengaduan')
            )
            ->groupBy('id_waktu', 'id_profil', 'id_kategori')
            ->get();

        $insertData = [];
        foreach ($dataRekap as $row) {
            $insertData[] = [
                'id_waktu'         => $row->id_waktu,
                'id_profil'        => $row->id_profil,
                'id_kategori'      => $row->id_kategori,
                'jumlah_pengaduan' => $row->jumlah_pengaduan
            ];
        }

        if (!empty($insertData)) {
            DB::connection($this->olap)->table('fact_rekap_demografi')->insert($insertData);
        }
    }
}