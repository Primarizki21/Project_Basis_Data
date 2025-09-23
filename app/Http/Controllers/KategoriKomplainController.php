<?php

namespace App\Http\Controllers;

use App\Models\KategoriKomplain;
use Illuminate\Http\Request;

class KategoriKomplainController extends Controller
{
    public function index()
    {
        $kategori = KategoriKomplain::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_komplain' => 'required|string|max:50',
            'deskripsi_komplain' => 'nullable|string|max:100',
        ]);

        KategoriKomplain::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }
}
