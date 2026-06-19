<?php

namespace Database\Seeders;

use App\Models\Villa;
use App\Models\VillaImage;
use Illuminate\Database\Seeder;

class VillaSeeder extends Seeder
{
    public function run()
    {
        $villas = [
            [
                'nama_villa' => 'Villa Sunset',
                'lokasi' => 'Bali, Indonesia',
                'harga_per_malam' => 2500000,
                'kapasitas' => 4,
                'jumlah_kamar' => 2,
                'fasilitas' => 'Kolam renang, WiFi, AC, TV, Dapur',
                'status' => 'tersedia',
                'gambar' => ['img/g1.jpg', 'img/g2.jpg', 'img/g3.jpg'],
            ],
            
        ];

        foreach ($villas as $data) {
            $gambarList = $data['gambar'];
            unset($data['gambar']);
            
            $villa = Villa::create($data);
            
            foreach ($gambarList as $order => $gambar) {
                VillaImage::create([
                    'villa_id' => $villa->id,
                    'image_path' => $gambar,
                    'is_primary' => $order === 0,
                    'sort_order' => $order,
                ]);
            }
        }
    }
}