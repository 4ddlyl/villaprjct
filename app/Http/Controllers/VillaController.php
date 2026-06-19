<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\VillaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VillaController extends Controller
{
    public function index()
    {
        $villas = Villa::with('images')->get();
        return view('admin.kelola_villa', compact('villas'));
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
        'gambar.*'        => 'nullable|image|mimes:jpg,jpeg,png|max:20480', // perhatikan .*
    ]);

    $validated['status'] = $validated['status'] ?? 'tersedia';
    
    $villa = Villa::create($validated);
    
    // Upload multiple gambar
    if ($request->hasFile('gambar')) {
        $isPrimary = true;
        foreach ($request->file('gambar') as $file) {
            $path = $file->store('villa_images', 'public');
            \App\Models\VillaImage::create([
                'villa_id'    => $villa->id,
                'image_path'  => $path,
                'is_primary'  => $isPrimary,
                'sort_order'  => 0,
            ]);
            $isPrimary = false;
        }
    }
    
    return redirect()->route('admin.villa')->with('success', 'Villa ditambahkan');
}
   
public function edit($id)
{
    $villa = Villa::with('images')->findOrFail($id);
    return response()->json($villa);
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
            'gambar'          => 'nullable|array',
            'gambar.*'        => 'image|mimes:jpg,jpeg,png|max:20480',
        ]);
        
        $villa->update($validated);
        
        // Upload gambar baru (tambah, bukan replace)
        if ($request->hasFile('gambar')) {
            $lastSortOrder = $villa->images()->max('sort_order') ?? -1;
            foreach ($request->file('gambar') as $index => $file) {
                $path = $file->store('villa_images', 'public');
                VillaImage::create([
                    'villa_id'    => $villa->id,
                    'image_path'  => $path,
                    'is_primary'  => false,
                    'sort_order'  => $lastSortOrder + $index + 1,
                ]);
            }
        }
        
        return redirect()->route('admin.villa')->with('success', 'Villa diupdate');
    }
    
    // Hapus gambar satu per satu (opsional)
    public function deleteImage($villaId, $imageId)
{
    try {
        // Cari image
        $image = \App\Models\VillaImage::where('villa_id', $villaId)->findOrFail($imageId);
        
        // Hapus file dari storage
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        // Hapus record dari database
        $image->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}


    public function destroy($id)
    {
        $villa = Villa::findOrFail($id);
        
        // Hapus semua gambar dari storage
        foreach ($villa->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        if ($villa->reservasis()->count() > 0) {
            return back()->with('error', 'Villa sedang memiliki reservasi, tidak bisa dihapus.');
        }
        
        $villa->delete();
        return redirect()->route('admin.villa')->with('success', 'Villa dihapus');
    }
    
    public function show($id)
{
    $villa = Villa::with('images')->findOrFail($id);
    return view('villa_detail', compact('villa'));
}
}