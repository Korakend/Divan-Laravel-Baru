<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    // Menampilkan semua biodata
    public function index()
    {
        $biodata = Biodata::latest()->get();

        return view('biodata.index', compact('biodata'));
    }

    // Menampilkan formulir tambah biodata
    public function create()
    {
        return view('biodata.create');
    }

    // Menyimpan biodata baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:30',
            'jurusan' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'tentang_saya' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('foto', 'public');
        }

        Biodata::create($data);

        return redirect()->route('biodata.index')
            ->with('success', 'Biodata berhasil ditambahkan!');
    }

    // Melihat detail CV
    public function show(Biodata $biodata)
    {
        $biodata->load(['pendidikan', 'keahlian']);

        return view('biodata.show', [
            'data' => $biodata
        ]);
    }

    // Menampilkan formulir edit
    public function edit(Biodata $biodata)
    {
        return view('biodata.edit', [
            'data' => $biodata
        ]);
    }

    // Memperbarui biodata
    public function update(Request $request, Biodata $biodata)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:30',
            'jurusan' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'tentang_saya' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($biodata->foto) {
                Storage::disk('public')->delete($biodata->foto);
            }

            $data['foto'] = $request->file('foto')
                ->store('foto', 'public');
        }

        $biodata->update($data);

        return redirect()->route('biodata.index')
            ->with('success', 'Biodata berhasil diperbarui!');
    }

    // Menghapus biodata
    public function destroy(Biodata $biodata)
    {
        if ($biodata->foto) {
            Storage::disk('public')->delete($biodata->foto);
        }

        $biodata->delete();

        return redirect()->route('biodata.index')
            ->with('success', 'Biodata berhasil dihapus!');
    }
}
