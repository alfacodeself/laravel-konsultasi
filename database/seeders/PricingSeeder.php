<?php

namespace Database\Seeders;

use App\Models\Pricing;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paket = [
            'Paket Murah',
            'Paket Biasa',
            'Paket Profesional',
        ];
        
        foreach ($paket as $key => $p) {
            $sesi = ($key + 1)**2;
            Pricing::create([
                'uuid' => Str::uuid(),
                'nama_paket' => $p,
                'sesi' => $sesi,
                'harga_paket' => $sesi * 5000,
                'fitur_paket' => 'Lorem, ipsum dolor|Lorem ipsum dolor sit|Lorem ipsum dolor sit|Lorem ipsum dolor sit amet|Lorem, ipsum dolor',
                'status' => 'aktif'
            ]);
        }
    }
}
