<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\BuktiPengaduan;
use App\Models\TindakLanjut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\KategoriKomplain;

class PengaduanController extends Controller
{
    // Admin page: list all pengaduan// Admin page: list all pengaduan
    public function index()
    {
        $pengaduanQuery = Pengaduan::with('pelapor', 'kategoriKomplain');
        $warnaKategori = [
            'Akademik' => '#0d6efd',
            'Fasilitas' => '#198754',
            'Kekerasan' => '#dc3545',
            'Kemahasiswaan' => '#ffc107',
            'Lainnya' => '#6c757d',
        ];
        if (Auth::guard('admin')->check()) {
            $pengaduan = $pengaduanQuery->latest()->get();
        } else {
            $pengaduan = $pengaduanQuery->where('user_id', Auth::id())->latest()->get();
        }
        return view('pages.riwayat', compact(
            'warnaKategori', 
            'pengaduan'
        ));
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
            'bukti'                => 'nullable|array',
            'bukti.*'              => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Simpan pengaduan
        $pengaduan = new Pengaduan();
        $pengaduan->user_id             = Auth::id();
        $pengaduan->kategori_komplain_id = $request->kategori_komplain_id;
        $pengaduan->deskripsi_kejadian   = $request->deskripsi_kejadian;
        $pengaduan->tanggal_kejadian     = $request->tanggal_kejadian;
        $pengaduan->status_pelapor       = $request->status_pelapor;
        $pengaduan->status_pengaduan     = 'Menunggu';
        $pengaduan->save();

        // Simpan bukti (multi-file)
        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('bukti_pengaduan', 'public');

                    BuktiPengaduan::create([
                        'pengaduan_id' => $pengaduan->pengaduan_id,
                        'file_path'    => $path,
                        'jenis_bukti'  => 'Bukti Digital',
                        'user_id'      => Auth::id(),
                    ]);
                }
            }
        }

        return redirect()->route('riwayat')->with('success', 'Pengaduan berhasil dikirim.');
    }
    
    // Admin input tindak lanjut
    public function tindakLanjut(Request $request, $id)
    {
        $request->validate([
            'jenis_tindak_lanjut' => 'required|string|max:30',
            'deskripsi'           => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

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

    public function edit(Pengaduan $pengaduan)
    {
        if (Auth::guard('web')->check() && $pengaduan->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        $kategori_komplain = KategoriKomplain::all();
        return view('pengaduan.edit', compact('pengaduan', 'kategori_komplain'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        if (Gate::denies('update', $pengaduan)) {
            abort(403);
        }

        $validated = $request->validate([
            'deskripsi_kejadian' => 'sometimes|required|string',
            'tanggal_kejadian' => 'sometimes|required|date',
            'kategori_komplain_id' => 'sometimes|required|exists:kategori_komplain,kategori_komplain_id',
        ]);
        
        if (!Auth::guard('admin')->check()) {
            $pengaduan->update($validated);
        }

        if (Auth::guard('admin')->check()) {
            $adminValidated = $request->validate([
                'status_pengaduan' => 'required|string|in:Menunggu,Diproses,Selesai,Ditolak',
                'deskripsi_tindak_lanjut' => 'required|string|min:10' // Deskripsi tindak lanjut wajib diisi
            ]);

            $pengaduan->tindakLanjut()->create([
                'jenis_tindak_lanjut' => 'Penanganan oleh Admin',
                'deskripsi'           => $adminValidated['deskripsi_tindak_lanjut'],
                'admin_id'            => Auth::guard('admin')->id(),
            ]);
            
            $pengaduan->status_pengaduan = $adminValidated['status_pengaduan'];
            $pengaduan->save();
        }

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.kelola-pengaduan')->with('success', 'Pengaduan berhasil diperbarui!');
        } else {
            return redirect()->route('riwayat')->with('success', 'Pengaduan berhasil diperbarui!');
        }
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if (Auth::guard('web')->check() && $pengaduan->user_id !== Auth::id()) {
            abort(403);
        }

        $pengaduan->delete();

        return redirect()->route('riwayat')->with('success', 'Pengaduan berhasil dihapus!');
    }

    public function createAnonim() {
        $kategori = KategoriKomplain::all();
        return view('pengaduan.anonim', compact('kategori'));
    }
    
    public function storeAnonim(Request $request)
    {
        $request->validate([
            'kategori_komplain_id' => 'required|exists:kategori_komplain,kategori_komplain_id',
            'deskripsi_kejadian'   => 'required|string',
            'tanggal_kejadian'     => 'nullable|date',
            'lokasi_kejadian'      => 'nullable|string|max:255',
            'bukti'                => 'nullable|array',
            'bukti.*'              => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Simpan pengaduan anonim
        $pengaduan = new Pengaduan();
        $pengaduan->user_id              = null; // Tidak ada user login
        $pengaduan->kategori_komplain_id = $request->kategori_komplain_id;
        $pengaduan->deskripsi_kejadian   = $request->deskripsi_kejadian;
        $pengaduan->tanggal_kejadian     = $request->tanggal_kejadian;
        $pengaduan->status_pengaduan     = 'Menunggu';
        $pengaduan->is_anonim            = true;
        $pengaduan->save();

        // Simpan bukti (multi-file)
        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('bukti_pengaduan', 'public');

                    BuktiPengaduan::create([
                        'pengaduan_id' => $pengaduan->pengaduan_id,
                        'file_path'    => $path,
                        'jenis_bukti'  => 'Bukti Digital',
                        'user_id'      => null, // Anonim, jadi tidak diisi
                    ]);
                }
            }
        }

        return redirect()->route('beranda')->with('success', 'Pengaduan anonim berhasil dikirim.');
    }
}
