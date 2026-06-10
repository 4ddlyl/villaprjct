<?php

namespace App\Http\Controllers;


use App\Models\Villa;
use Illuminate\Http\Request;

class VillaController extends Controller
{
    public function index()
    {
        $villas = Villa::all();
        return view('admin.kelola_villa', compact('villas'));
    }

    public function show($id)
    {
        $villa = Villa::findOrFail($id);
        return view('villa_detail', compact('villa'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_villa'      => 'required|string|max:100',
            'lokasi'          => 'required|string|max:150',
            'harga_per_malam' => 'required|integer|min:0',
            'kapasitas'       => 'required|integer|min:1',
            'jumlah_kamar'    => 'required|integer|min:1',
            'fasilitas'       => 'nullable|string',
            'status'          => 'nullable|in:tersedia,tidak tersedia',
        ]);

        if (!isset($validated['status'])) {
            $validated['status'] = 'tersedia';
        }

        Villa::create($validated);
        return redirect()->route('admin.villa')->with('success', 'Villa ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $villa = Villa::findOrFail($id);

        $validated = $request->validate([
            'nama_villa'      => 'sometimes|string|max:100',
            'lokasi'          => 'sometimes|string|max:150',
            'harga_per_malam' => 'sometimes|integer|min:0',
            'kapasitas'       => 'sometimes|integer|min:1',
            'jumlah_kamar'    => 'sometimes|integer|min:1',
            'fasilitas'       => 'nullable|string',
            'status'          => 'sometimes|in:tersedia,tidak tersedia',
        ]);

        $villa->update($validated);
        return redirect()->route('admin.villa')->with('success', 'Villa diupdate');
    }

    public function destroy($id)
    {
        $villa = Villa::findOrFail($id);

        // Cegah hapus jika ada reservasi
        if ($villa->reservasis()->count() > 0) {
            return back()->with('error', 'Villa sedang memiliki reservasi, tidak bisa dihapus.');
        }

        $villa->delete();
        return redirect()->route('admin.villa')->with('success', 'Villa dihapus');
    }
}
