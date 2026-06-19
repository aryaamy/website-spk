<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Alternatif;
use App\Models\Matakuliah;
use App\Models\NilaiStudi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data langsung dari database
        $totalMahasiswa = Mahasiswa::count();
        $totalKonsentrasi = Alternatif::count();
        $totalMatkul = Matakuliah::count();
        
        // Hitung berapa mahasiswa yang udah ngisi transkrip (biar tau yang udah siap dihitung)
        $totalTranskrip = NilaiStudi::select('mahasiswa_id')->distinct()->count();

        return view('dashboard.index', compact('totalMahasiswa', 'totalKonsentrasi', 'totalMatkul', 'totalTranskrip'));
    }
}