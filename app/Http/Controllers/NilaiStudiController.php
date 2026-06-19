<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\NilaiStudi;
use Illuminate\Http\Request;

class NilaiStudiController extends Controller
{
    public function index()
    {
        // Ambil data mahasiswa yang udah pernah nginput transkrip
        $mahasiswa_dinilai = NilaiStudi::select('mahasiswa_id')->groupBy('mahasiswa_id')->get();
        return view('nilaistudi.index', compact('mahasiswa_dinilai'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        // Kita tarik semua matkul, terus langsung dikelompokkin per semester biar gampang di-looping di HTML
        $matakuliah = Matakuliah::orderBy('semester')->get()->groupBy('semester');
        
        return view('nilaistudi.create', compact('mahasiswa', 'matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required',
            'nilai' => 'required|array',
            'nilai_tes_minat' => 'required',
            'nilai_portofolio' => 'required',
        ]);

        // Simpan nilai C3 dan C4 ke tabel mahasiswa
        $mhs = Mahasiswa::find($request->mahasiswa_id);
        $mhs->update([
            'nilai_tes_minat' => $request->nilai_tes_minat,
            'nilai_portofolio' => $request->nilai_portofolio
        ]);

        // Bersihin nilai transkrip lama
        NilaiStudi::where('mahasiswa_id', $request->mahasiswa_id)->delete();

        // Simpan nilai transkrip per matkul
        foreach ($request->nilai as $mk_id => $nilai_angka) {
            if ($nilai_angka !== null) { 
                NilaiStudi::create([
                    'mahasiswa_id' => $request->mahasiswa_id,
                    'matakuliah_id' => $mk_id,
                    'nilai_angka' => $nilai_angka
                ]);
            }
        }

        return redirect('/nilaistudi')->with('success', 'Transkrip dan nilai tambahan berhasil disimpan!');
    }

    public function destroy($id)
    {
        // Langsung sapu bersih semua nilai milik mahasiswa tersebut
        \App\Models\NilaiStudi::where('mahasiswa_id', $id)->delete();
        
        return redirect('/nilaistudi')->with('success', 'Transkrip nilai berhasil direset! Silakan input ulang jika diperlukan.');
    }
}