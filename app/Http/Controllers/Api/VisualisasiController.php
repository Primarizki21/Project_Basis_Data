<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VisualisasiController extends Controller
{
    public function summary()
    {
        $count = DB::connection('mysql_olap')
            ->table('fact_interaksi_tiket')
            ->count();

        return response()->json([
            'total_pengaduan' => $count
        ]);
    }

    public function kategori()
    {
        $data = DB::connection('mysql_olap')
            ->table('fact_interaksi_tiket as f')
            ->join('dim_kategori as k', 'k.sk_kategori', '=', 'f.sk_kategori')
            ->selectRaw('k.jenis_komplain as label, COUNT(*) as value')
            ->groupBy('k.jenis_komplain')
            ->get();

        return response()->json($data);
    }

    public function status()
    {
        $data = DB::connection('mysql_olap')
            ->table('fact_interaksi_tiket')
            ->selectRaw('status_pengaduan as label, COUNT(*) as value')
            ->groupBy('status_pengaduan')
            ->get();

        return response()->json($data);
    }

    public function responseTime()
    {
        $data = DB::connection('mysql_olap')
            ->table('fact_interaksi_tiket as f')
            ->join('dim_kategori as k', 'k.sk_kategori', '=', 'f.sk_kategori')
            ->selectRaw('k.jenis_komplain as label, AVG(durasi_penanganan) as value')
            ->groupBy('k.jenis_komplain')
            ->get();

        return response()->json($data);
    }

    public function trendBulanan()
    {
        $data = DB::connection('mysql_olap')
            ->table('fact_interaksi_tiket as f')
            ->join('dim_waktu as w', 'f.sk_waktu', '=', 'w.sk_waktu')
            ->selectRaw('
                w.tahun,
                w.bulan,
                COUNT(*) as total,
                SUM(f.status_pengaduan = "Selesai") as selesai
            ')
            ->groupBy('w.tahun', 'w.bulan')
            ->orderBy('w.tahun')
            ->orderBy('w.bulan')
            ->get();

        return response()->json($data);
    }

    public function avgWaktuProses()
    {
        $avg = DB::connection('mysql_olap')
            ->table('fact_interaksi_tiket')
            ->where('status_pengaduan', 'Selesai')
            ->avg('durasi_penanganan');

        return response()->json([
            'avg_hari' => $avg ? round($avg / 24, 2) : null
        ]);
    }

    public function performaAdminBulanan()
    {
        $rows = DB::connection('mysql_olap')
            ->table('fact_performa_admin_bulanan as f')
            ->join('dim_admin as a', 'a.sk_admin', '=', 'f.sk_admin')
            ->join('dim_waktu as w', 'w.sk_waktu', '=', 'f.sk_waktu')
            ->selectRaw('
                a.nama as admin,
                w.tahun,
                w.bulan,
                f.total_tiket_ditangani as total,
                f.jumlah_komplain_selesai as selesai,
                f.total_aktivitas as aktivitas
            ')
            ->orderBy('w.tahun')
            ->orderBy('w.bulan')
            ->get();

        return response()->json($rows);
    }
}