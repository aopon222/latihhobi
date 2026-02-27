<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use Illuminate\Http\Request;

class InputAspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inputAspirasis = InputAspirasi::with(['siswa', 'kategori'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.input_aspirasis.index', compact('inputAspirasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswas = \App\Models\Siswa::all();
        $kategoris = \App\Models\Kategori::all();
        return view('admin.input_aspirasis.create', compact('siswas', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_input' => 'required|date',
        ]);

        InputAspirasi::create($validated);

        return redirect()->route('admin.input_aspirasis.index')
            ->with('success', 'Input Aspirasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(InputAspirasi $inputAspirasi)
    {
        $inputAspirasi->load(['siswa', 'kategori', 'aspirasi']);
        return view('admin.input_aspirasis.show', compact('inputAspirasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InputAspirasi $inputAspirasi)
    {
        $siswas = \App\Models\Siswa::all();
        $kategoris = \App\Models\Kategori::all();
        return view('admin.input_aspirasis.edit', compact('inputAspirasi', 'siswas', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InputAspirasi $inputAspirasi)
    {
        $validated = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_input' => 'required|date',
        ]);

        $inputAspirasi->update($validated);

        return redirect()->route('admin.input_aspirasis.index')
            ->with('success', 'Input Aspirasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InputAspirasi $inputAspirasi)
    {
        $inputAspirasi->delete();

        return redirect()->route('admin.input_aspirasis.index')
            ->with('success', 'Input Aspirasi berhasil dihapus!');
    }
}
