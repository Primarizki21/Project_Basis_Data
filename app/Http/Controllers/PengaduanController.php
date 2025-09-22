<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\BuktiPengaduan;
use App\Models\TindakLanjut;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    // Admin page: list all pengaduan
    public function index()
    {
        $pengaduan = Pengaduan::all(); // get all complaints
        return view('admin', compact('pengaduan')); // pass variable to view
    }

    // Form pengaduan
    public function create()
    {
        return view('pengaduan.create');
    }

    // Simpan pengaduan + bukti
    public function store(Request $request)
    {
        $request->validate([
            'kategori_kekerasan' => 'required|string|max:50',
            'deskripsi_kejadian' => 'required|string',
            'tanggal_kejadian'   => 'required|date',
            'status_pelapor'     => 'required|in:Korban,Keluarga,Teman,Saksi',
            'bukti.*'            => 'nullable|file|max:2048'
        ]);

        // Simpan pengaduan
        $pengaduan = Pengaduan::create([
            'pelapor'           => Auth::id(), // user login
            'kategori_kekerasan'=> $request->kategori_kekerasan,
            'deskripsi_kejadian'=> $request->deskripsi_kejadian,
            'tanggal_kejadian'  => $request->tanggal_kejadian,
            'status_pengaduan'  => 'Menunggu',
            'status_pelapor'    => $request->status_pelapor,
        ]);

        // Upload bukti jika ada
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

        return redirect()->route('pengaduan.show', $pengaduan->pengaduan_id)
                         ->with('success', 'Pengaduan berhasil dibuat');
    }

    // Detail pengaduan (user & admin)
    public function show($id)
    {
        $pengaduan = Pengaduan::with(['bukti', 'tindakLanjut'])->findOrFail($id);
        return view('pengaduan.show', compact('pengaduan'));
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
