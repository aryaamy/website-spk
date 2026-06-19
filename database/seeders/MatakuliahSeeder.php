<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihin data matkul yang lama biar nggak numpuk pas di-seed
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('matakuliah')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $matakuliah = [
            // ================= SEMESTER 1 =================
            ['kode_mk' => 'IF-U01', 'nama_mk' => 'Agama', 'sks' => 2, 'semester' => 1, 'kategori' => 'umum'],
            ['kode_mk' => 'IF-U02', 'nama_mk' => 'Pancasila', 'sks' => 2, 'semester' => 1, 'kategori' => 'umum'],
            ['kode_mk' => 'IF-011', 'nama_mk' => 'Matematika Dasar', 'sks' => 3, 'semester' => 1, 'kategori' => 'umum'],
            ['kode_mk' => 'IF-032', 'nama_mk' => 'Fisika Dasar', 'sks' => 3, 'semester' => 1, 'kategori' => 'umum'],
            ['kode_mk' => 'IF-001', 'nama_mk' => 'Algoritma & Pemrograman I', 'sks' => 3, 'semester' => 1, 'kategori' => 'pemrograman'],
            ['kode_mk' => 'IF-007', 'nama_mk' => 'Pengantar Teknologi Informasi', 'sks' => 2, 'semester' => 1, 'kategori' => 'umum'],
            ['kode_mk' => 'IF-003', 'nama_mk' => 'Struktur Data', 'sks' => 3, 'semester' => 1, 'kategori' => 'pemrograman'],
            ['kode_mk' => 'IF-U04', 'nama_mk' => 'Bahasa Inggris I', 'sks' => 2, 'semester' => 1, 'kategori' => 'umum'],

            // ================= SEMESTER 2 =================
            ['kode_mk' => 'IF-002', 'nama_mk' => 'Algoritma & Pemrograman II', 'sks' => 3, 'semester' => 2, 'kategori' => 'pemrograman'],
            ['kode_mk' => 'IF-004', 'nama_mk' => 'Sistem Basis Data', 'sks' => 3, 'semester' => 2, 'kategori' => 'pemrograman'],
            ['kode_mk' => 'IF-U05', 'nama_mk' => 'Bahasa Inggris II', 'sks' => 2, 'semester' => 2, 'kategori' => 'umum'],
            ['kode_mk' => 'IF-013', 'nama_mk' => 'Matematika Informatika', 'sks' => 3, 'semester' => 2, 'kategori' => 'umum'],
            ['kode_mk' => 'IF-009', 'nama_mk' => 'Organisasi & Arsitektur Komputer', 'sks' => 2, 'semester' => 2, 'kategori' => 'jaringan'],
            ['kode_mk' => 'IF-033', 'nama_mk' => 'Literasi Digital', 'sks' => 2, 'semester' => 2, 'kategori' => 'umum'],
            ['kode_mk' => 'IF-U03', 'nama_mk' => 'Kewarganegaraan', 'sks' => 2, 'semester' => 2, 'kategori' => 'umum'],
            ['kode_mk' => 'IF-012', 'nama_mk' => 'Metode Numerik', 'sks' => 3, 'semester' => 2, 'kategori' => 'umum'],

            // ================= SEMESTER 3 =================
            ['kode_mk' => 'IF-014', 'nama_mk' => 'Statistika', 'sks' => 3, 'semester' => 3, 'kategori' => 'umum'],
            ['kode_mk' => 'IF-021', 'nama_mk' => 'Teori Bahasa Otomata', 'sks' => 3, 'semester' => 3, 'kategori' => 'pemrograman'],
            ['kode_mk' => 'IF-010', 'nama_mk' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'kategori' => 'jaringan'],
            ['kode_mk' => 'IF-019', 'nama_mk' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 3, 'kategori' => 'pemrograman'],
            ['kode_mk' => 'IF-015', 'nama_mk' => 'Object Oriented Programming I', 'sks' => 3, 'semester' => 3, 'kategori' => 'pemrograman'],
            ['kode_mk' => 'IF-005', 'nama_mk' => 'Basis Data Terdistribusi', 'sks' => 3, 'semester' => 3, 'kategori' => 'pemrograman'],
            ['kode_mk' => 'IF-017', 'nama_mk' => 'Jaringan Komputer 1', 'sks' => 3, 'semester' => 3, 'kategori' => 'jaringan'],
        ];

        foreach ($matakuliah as $mk) {
            Matakuliah::create($mk);
        }
    }
}