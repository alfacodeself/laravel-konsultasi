<?php

namespace Database\Seeders;

use App\Models\Psycholog;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PsychologSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Daftar Tes Psikolog
        $psy1 = Psycholog::create([
            'uuid' => Str::uuid(),
            'gambar' => 'no-pict',
            'judul' => 'Tes Psikologi Pertama',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora vero quaerat magnam nam excepturi unde nemo eveniet dolores esse numquam ut facere ducimus eaque voluptatem suscipit ab, distinctio omnis dicta.',
            'status' => 'aktif',
            'harga' => 40000
        ]);
        $psy2 = Psycholog::create([
            'uuid' => Str::uuid(),
            'gambar' => 'no-pict',
            'judul' => 'Tes Psikologi Kedua',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora vero quaerat magnam nam excepturi unde nemo eveniet dolores esse numquam ut facere ducimus eaque voluptatem suscipit ab, distinctio omnis dicta.',
            'status' => 'aktif',
            'harga' => 55000
        ]);
        $psy3 = Psycholog::create([
            'uuid' => Str::uuid(),
            'gambar' => 'no-pict',
            'judul' => 'Tes Psikologi Ketiga',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora vero quaerat magnam nam excepturi unde nemo eveniet dolores esse numquam ut facere ducimus eaque voluptatem suscipit ab, distinctio omnis dicta.',
            'status' => 'aktif',
            'harga' => 60000
        ]);
        // Hasil tes psikolog
        for ($i = 1; $i <= 4; $i++) {
            $poin_minimum = (($i * 40) - 40) + 1;
            $poin_maksimum = ($poin_minimum + 40) - 1;
            if ($poin_maksimum <= 50) {
                $ket = 'anda tidak sedih';
            } elseif ($poin_maksimum <= 100) {
                $ket = 'anda agak sedih';
            } elseif ($poin_maksimum <= 150) {
                $ket = 'anda lumayan sedih';
            } elseif ($poin_maksimum <= 200) {
                $ket = 'anda sangat sedih';
            }
            $psy1->psychological_test_results()->create([
                'uuid' => Str::uuid(),
                'poin_minimum' => $poin_minimum,
                'poin_maksimum' => $poin_maksimum,
                'keterangan' => $ket
            ]);
            $psy2->psychological_test_results()->create([
                'uuid' => Str::uuid(),
                'poin_minimum' => $poin_minimum,
                'poin_maksimum' => $poin_maksimum,
                'keterangan' => $ket
            ]);
            $psy3->psychological_test_results()->create([
                'uuid' => Str::uuid(),
                'poin_minimum' => $poin_minimum,
                'poin_maksimum' => $poin_maksimum,
                'keterangan' => $ket
            ]);
        }
        // Soal dan Jawaban Tes
        for ($i = 0; $i < 5; $i++) {
            // Soal
            $q1 = $psy1->questions()->create([
                'uuid' => Str::uuid(),
                'soal' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores excepturi quam aliquam? Cum optio, adipisci eum enim tempora dolores praesentium?'
            ]);
            $q2 = $psy2->questions()->create([
                'uuid' => Str::uuid(),
                'soal' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores excepturi quam aliquam? Cum optio, adipisci eum enim tempora dolores praesentium?'
            ]);
            $q3 = $psy3->questions()->create([
                'uuid' => Str::uuid(),
                'soal' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores excepturi quam aliquam? Cum optio, adipisci eum enim tempora dolores praesentium?'
            ]);
            // Jawaban
            for ($j = 1; $j <= 4; $j++) {
                $q1->answers()->create([
                    'uuid' => Str::uuid(),
                    'jawaban' => 'Lorem ipsum dolor sit amet consectetur.',
                    'poin' => $j * 10
                ]);
                $q2->answers()->create([
                    'uuid' => Str::uuid(),
                    'jawaban' => 'Lorem ipsum dolor sit amet consectetur.',
                    'poin' => $j * 10
                ]);
                $q3->answers()->create([
                    'uuid' => Str::uuid(),
                    'jawaban' => 'Lorem ipsum dolor sit amet consectetur.',
                    'poin' => $j * 10
                ]);
            }
        }
    }
}
