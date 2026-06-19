<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihin data kriteria yang lama
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('kriteria')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $kriteria = [
            ['kode_kriteria' => 'C1', 'nama_kriteria' => 'Nilai Mata Kuliah Prasyarat', 'bobot' => 0.40, 'tipe_atribut' => 'benefit'],
            ['kode_kriteria' => 'C2', 'nama_kriteria' => 'Indeks Prestasi Kumulatif (IPK)', 'bobot' => 0.20, 'tipe_atribut' => 'benefit'],
            ['kode_kriteria' => 'C3', 'nama_kriteria' => 'Hasil Tes Minat', 'bobot' => 0.30, 'tipe_atribut' => 'benefit'],
            ['kode_kriteria' => 'C4', 'nama_kriteria' => 'Portofolio/Sertifikasi', 'bobot' => 0.10, 'tipe_atribut' => 'benefit'],
        ];

        foreach ($kriteria as $k) {
            Kriteria::create($k);
        }
    }
}