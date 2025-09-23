<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\BuktiPengaduan;
use App\Models\TindakLanjut;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriKomplain;

class PengaduanController extends Controller
{
    // Admin page: list all pengaduan// Admin page: list all pengaduan
    public function index()
    {
        $pengaduan = Pengaduan::all(); // get all complaints
        return view('admin', compact('pengaduan')); // pass variable to view
    }

    // Form pengaduan
    public function create()
    {
        $kategori = KategoriKomplain::all();
        return view('pengaduan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_komplain_id' => 'required|exists:kategori_komplain,kategori_komplain_id',
            'deskripsi_kejadian'   => 'required|string',
            'tanggal_kejadian'     => 'nullable|date',
            'status_pelapor'       => 'required|in:Korban,Keluarga,Teman,Saksi',
            'bukti.*'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Simpan pengaduan
        $pengaduan = new Pengaduan();
        $pengaduan->user_id = Auth::id();
        $pengaduan->kategori_komplain_id = $request->kategori_komplain_id;
        $pengaduan->deskripsi_kejadian = $request->deskripsi_kejadian;
        $pengaduan->tanggal_kejadian = $request->tanggal_kejadian;
        $pengaduan->status_pelapor = $request->status_pelapor;
        $pengaduan->status_pengaduan = 'Menunggu'; 
        $pengaduan->save();

        // Simpan bukti bila ada
        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                $path = $file->store('bukti_pengaduan', 'public');

                BuktiPengaduan::create([
                    'pengaduan_id' => $pengaduan->pengaduan_id,
                    'file_path'    => $path,
                    'jenis_bukti'  => 'Bukti Digital',
                    'user_id'      => Auth::id(),
                ]);
            }
        }

        return redirect()->route('riwayat.index')->with('success', 'Pengaduan berhasil dikirim.');
    }


    // Detail pengaduan (user & admin)
    public function show($id)
    {
        $pengaduan = Pengaduan::with(['bukti', 'tindakLanjut'])->findOrFail($id);
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function riwayat()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();

        $pengaduan = Pengaduan::with('kategoriKomplain')
                              ->where('user_id', $userId)
                              ->latest() // Mengurutkan dari created_at terbaru
                              ->get();

        // Kirim data ke view 'riwayat'
        return view('pages.riwayat', ['pengaduan' => $pengaduan]);
    }
    
    // Admin input tindak lanjut
    public function tindakLanjut(Request $request, $id)
    {
        $request->validate([
            'jenis_tindak_lanjut' => 'required|string|max:30',
            'deskripsi'           => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        // Pastikan hanya admin yang bisa input
        // if (!Auth::user()->hasRole('admin')) {
        //     abort(403, 'Unauthorized');
        // }

        // Jika sudah ada tindak lanjut, update
        if ($pengaduan->tindakLanjut) {
            $pengaduan->tindakLanjut->update([
                'jenis_tindak_lanjut' => $request->jenis_tindak_lanjut,
                'deskripsi'           => $request->deskripsi,
                'admin_id'          => Auth::id(),
            ]);
        } else {
            TindakLanjut::create([
                'pengaduan_id'        => $pengaduan->pengaduan_id,
                'jenis_tindak_lanjut' => $request->jenis_tindak_lanjut,
                'deskripsi'           => $request->deskripsi,
                'admin_id'          => Auth::id(),
            ]);
        }

        $pengaduan->update(['status_pengaduan' => 'Diproses']);

        return redirect()->route('pengaduan.show', $pengaduan->pengaduan_id)
                         ->with('success', 'Tindak lanjut berhasil ditambahkan');
    }

}
