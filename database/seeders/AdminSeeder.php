<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'uuid' => Str::uuid(),
            'nama' => 'Admin Konsultasi',
            'email' => 'admin@konsultasi.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin1234')
        ]);
    }
}
