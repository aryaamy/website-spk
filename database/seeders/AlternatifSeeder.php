<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alternatif; // Ini wajib dipanggil biar Laravel kenal tabelnya

class AlternatifSeeder extends Seeder
{
    public function run(): void
    {
        Alternatif::create([
            'kode_alternatif' => 'A1',
            'nama_konsentrasi' => 'Cyber Network Security'
        ]);

        Alternatif::create([
            'kode_alternatif' => 'A2',
            'nama_konsentrasi' => 'Creative Information Development'
        ]);
    }
}