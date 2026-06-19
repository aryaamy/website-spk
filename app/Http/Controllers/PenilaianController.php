<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        
        // Kita kelompokkan data siapa aja yang udah dinilai biar gampang dibikin tabel matriks
        $mahasiswa_dinilai = Penilaian::select('mahasiswa_id', 'alternatif_id')
            ->groupBy('mahasiswa_id', 'alternatif_id')
            ->get();

        return view('penilaian.index', compact('kriteria', 'mahasiswa_dinilai'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        
        return view('penilaian.create', compact('mahasiswa', 'alternatif', 'kriteria'));
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'mahasiswa_id' => 'required',
            'alternatif_id' => 'required',
            'nilai' => 'required|array'
        ]);

        // Hapus data lama (kalau ada) biar nggak numpuk kalau mahasiswanya diinput ulang
        Penilaian::where('mahasiswa_id', $request->mahasiswa_id)
                 ->where('alternatif_id', $request->alternatif_id)
                 ->delete();

        // Looping sakti: Nyimpen nilai satu-satu sesuai kriteria (C1, C2, dst)
        foreach ($request->nilai as $kriteria_id => $nilai_rating) {
            Penilaian::create([
                'mahasiswa_id' => $request->mahasiswa_id,
                'alternatif_id' => $request->alternatif_id,
                'kriteria_id' => $kriteria_id,
                'nilai_rating' => $nilai_rating
            ]);
        }

        return redirect('/penilaian')->with('success', 'Nilai Matriks berhasil disimpan!');
    }
}