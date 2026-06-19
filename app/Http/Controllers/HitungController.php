<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\NilaiStudi;
use App\Models\Mahasiswa;
use App\Models\Alternatif;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    // ==========================================================
    // FUNGSI RAHASIA: NGITUNG IPK REAL BERDASARKAN SKS & INDEKS
    // ==========================================================
    private function hitungIpkAsli($nilai_mhs)
    {
        $total_nxk = 0;
        $total_sks = 0;

        foreach ($nilai_mhs as $n) {
            $angka = $n->nilai_angka;
            $sks = $n->sks; // Ngambil SKS dari tabel matakuliah

            // Konversi nilai angka (0-100) ke Indeks Huruf Kampus Lu
            if ($angka >= 80) { $idx = 4.0; }       // A
            elseif ($angka >= 75) { $idx = 3.5; }   // AB
            elseif ($angka >= 70) { $idx = 3.0; }   // B
            elseif ($angka >= 65) { $idx = 2.5; }   // BC
            elseif ($angka >= 60) { $idx = 2.0; }   // C
            elseif ($angka >= 50) { $idx = 1.0; }   // D
            else { $idx = 0.0; }                    // E

            $total_nxk += ($idx * $sks);
            $total_sks += $sks;
        }

        // Rumus IPK = Total (Nilai x SKS) / Total SKS
        return $total_sks > 0 ? round($total_nxk / $total_sks, 2) : 0;
    }

    public function index()
    {
        $alternatif = Alternatif::all();
        $mahasiswaIds = NilaiStudi::select('mahasiswa_id')->distinct()->pluck('mahasiswa_id');
        $mahasiswaList = Mahasiswa::whereIn('id', $mahasiswaIds)->get();

        if ($mahasiswaList->isEmpty()) {
            return redirect('/nilaistudi')->with('success', 'Data masih kosong!');
        }

        // 1. Ekstrak Data Mentah & Hitung IPK Asli
        $dataMentah = [];
        foreach ($mahasiswaList as $m) {
            $nilai_mhs = NilaiStudi::join('matakuliah', 'nilai_studi.matakuliah_id', '=', 'matakuliah.id')
                ->where('nilai_studi.mahasiswa_id', $m->id)
                ->select('matakuliah.*', 'nilai_studi.nilai_angka')
                ->get();

            $dataMentah[$m->id] = [
                'jaringan' => $nilai_mhs->where('kategori', 'jaringan')->avg('nilai_angka') ?? 0,
                'pemrograman' => $nilai_mhs->where('kategori', 'pemrograman')->avg('nilai_angka') ?? 0,
                'ipk' => $this->hitungIpkAsli($nilai_mhs), // <--- IPK DIHITUNG PAKAI RUMUS SKS DI SINI
                'tes_minat' => $m->nilai_tes_minat,           
                'portofolio' => $m->nilai_portofolio          
            ];
        }

        // 2. Cari Nilai Max buat Normalisasi SAW
        $maxData = [
            'jaringan' => max(array_column($dataMentah, 'jaringan')) ?: 1,
            'pemrograman' => max(array_column($dataMentah, 'pemrograman')) ?: 1,
            'ipk' => max(array_column($dataMentah, 'ipk')) ?: 1,
            'tes_minat' => max(array_column($dataMentah, 'tes_minat')) ?: 1,
            'portofolio' => max(array_column($dataMentah, 'portofolio')) ?: 1,
        ];

        // 3. Proses SAW
        $hasilAkhir = [];
        foreach ($mahasiswaList as $m) {
            foreach ($alternatif as $alt) {
                if ($alt->kode_alternatif == 'A1') { 
                    $c1_asli = $dataMentah[$m->id]['jaringan'];
                } else { 
                    $c1_asli = $dataMentah[$m->id]['pemrograman'];
                }
                $c1_max = $alt->kode_alternatif == 'A1' ? $maxData['jaringan'] : $maxData['pemrograman'];

                $c1_norm = $c1_asli / $c1_max;
                $c2_norm = $dataMentah[$m->id]['ipk'] / $maxData['ipk'];
                $c3_norm = $dataMentah[$m->id]['tes_minat'] / $maxData['tes_minat'];
                $c4_norm = $dataMentah[$m->id]['portofolio'] / $maxData['portofolio'];

                $total_nilai = ($c1_norm * 0.40) + ($c2_norm * 0.20) + ($c3_norm * 0.30) + ($c4_norm * 0.10);

                $hasilAkhir[] = [
                    'mahasiswa' => $m->nama,
                    'konsentrasi' => $alt->nama_konsentrasi,
                    'total' => round($total_nilai, 4)
                ];
            }
        }

        $hasilPerMahasiswa = collect($hasilAkhir)->groupBy('mahasiswa')->map(function ($item) {
            return $item->sortByDesc('total')->values()->all();
        });

        return view('perhitungan.index', compact('hasilPerMahasiswa'));
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        // Tarik data mentah dulu buat ngitung IPK
        $transkrip_flat = NilaiStudi::join('matakuliah', 'nilai_studi.matakuliah_id', '=', 'matakuliah.id')
            ->where('nilai_studi.mahasiswa_id', $id)
            ->select('matakuliah.*', 'nilai_studi.nilai_angka')
            ->orderBy('matakuliah.semester') // Urutin dari semester 1
            ->get();
            
        $ipk_mahasiswa = $this->hitungIpkAsli($transkrip_flat);

        // Terus kita kelompokkin per semester buat dilempar ke View/PDF
        $transkrip = $transkrip_flat->groupBy('semester');
        
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $mahasiswaList = Mahasiswa::whereIn('id', NilaiStudi::select('mahasiswa_id')->distinct()->pluck('mahasiswa_id'))->get();
        
        $dataMentah = [];
        foreach ($mahasiswaList as $m) {
            $nilai_mhs = NilaiStudi::join('matakuliah', 'nilai_studi.matakuliah_id', '=', 'matakuliah.id')
                ->where('nilai_studi.mahasiswa_id', $m->id)->select('matakuliah.*', 'nilai_studi.nilai_angka')->get();
            $dataMentah[$m->id] = [
                'jaringan' => $nilai_mhs->where('kategori', 'jaringan')->avg('nilai_angka') ?? 0,
                'pemrograman' => $nilai_mhs->where('kategori', 'pemrograman')->avg('nilai_angka') ?? 0,
                'ipk' => $this->hitungIpkAsli($nilai_mhs),
                'tes_minat' => $m->nilai_tes_minat,
                'portofolio' => $m->nilai_portofolio
            ];
        }

        $maxData = [
            'jaringan' => max(array_column($dataMentah, 'jaringan')) ?: 1,
            'pemrograman' => max(array_column($dataMentah, 'pemrograman')) ?: 1,
            'ipk' => max(array_column($dataMentah, 'ipk')) ?: 1,
            'tes_minat' => max(array_column($dataMentah, 'tes_minat')) ?: 1,
            'portofolio' => max(array_column($dataMentah, 'portofolio')) ?: 1,
        ];

        $hasilAkhir = [];
        foreach ($alternatif as $alt) {
            $c1_asli = $alt->kode_alternatif == 'A1' ? $dataMentah[$id]['jaringan'] : $dataMentah[$id]['pemrograman'];
            $c1_max = $alt->kode_alternatif == 'A1' ? $maxData['jaringan'] : $maxData['pemrograman'];

            $c1_norm = $c1_asli / $c1_max;
            $c2_norm = $dataMentah[$id]['ipk'] / $maxData['ipk'];
            $c3_norm = $dataMentah[$id]['tes_minat'] / $maxData['tes_minat'];
            $c4_norm = $dataMentah[$id]['portofolio'] / $maxData['portofolio'];

            $total_nilai = ($c1_norm * 0.40) + ($c2_norm * 0.20) + ($c3_norm * 0.30) + ($c4_norm * 0.10);
            $hasilAkhir[] = ['konsentrasi' => $alt->nama_konsentrasi, 'total' => round($total_nilai, 4)];
        }
        $hasilAkhir = collect($hasilAkhir)->sortByDesc('total')->values()->all();

        return view('perhitungan.show', compact('mahasiswa', 'transkrip', 'hasilAkhir', 'ipk_mahasiswa'));
    }

    public function cetakPdf($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        // 1. Tarik transkrip buat PDF (biar datanya sama persis sama yang di layar show)
        $transkrip_flat = NilaiStudi::join('matakuliah', 'nilai_studi.matakuliah_id', '=', 'matakuliah.id')
            ->where('nilai_studi.mahasiswa_id', $id)
            ->select('matakuliah.*', 'nilai_studi.nilai_angka')
            ->orderBy('matakuliah.semester')
            ->get();
            
        $ipk_mahasiswa = $this->hitungIpkAsli($transkrip_flat);
        $transkrip = $transkrip_flat->groupBy('semester');

        // 2. Tarik data SAW supaya nilainya sama dengan yang tampil di layar
        $alternatif = Alternatif::all();
        $mahasiswaList = Mahasiswa::whereIn('id', NilaiStudi::select('mahasiswa_id')->distinct()->pluck('mahasiswa_id'))->get();
        
        $dataMentah = [];
        foreach ($mahasiswaList as $m) {
            $nilai_mhs = NilaiStudi::join('matakuliah', 'nilai_studi.matakuliah_id', '=', 'matakuliah.id')
                ->where('nilai_studi.mahasiswa_id', $m->id)->select('matakuliah.*', 'nilai_studi.nilai_angka')->get();
            $dataMentah[$m->id] = [
                'jaringan' => $nilai_mhs->where('kategori', 'jaringan')->avg('nilai_angka') ?? 0,
                'pemrograman' => $nilai_mhs->where('kategori', 'pemrograman')->avg('nilai_angka') ?? 0,
                'ipk' => $this->hitungIpkAsli($nilai_mhs),
                'tes_minat' => $m->nilai_tes_minat,
                'portofolio' => $m->nilai_portofolio
            ];
        }

        $maxData = [
            'jaringan' => max(array_column($dataMentah, 'jaringan')) ?: 1,
            'pemrograman' => max(array_column($dataMentah, 'pemrograman')) ?: 1,
            'ipk' => max(array_column($dataMentah, 'ipk')) ?: 1,
            'tes_minat' => max(array_column($dataMentah, 'tes_minat')) ?: 1,
            'portofolio' => max(array_column($dataMentah, 'portofolio')) ?: 1,
        ];

        $hasilAkhir = [];
        foreach ($alternatif as $alt) {
            $c1_asli = $alt->kode_alternatif == 'A1' ? $dataMentah[$id]['jaringan'] : $dataMentah[$id]['pemrograman'];
            $c1_max = $alt->kode_alternatif == 'A1' ? $maxData['jaringan'] : $maxData['pemrograman'];

            $c1_norm = $c1_asli / $c1_max;
            $c2_norm = $dataMentah[$id]['ipk'] / $maxData['ipk'];
            $c3_norm = $dataMentah[$id]['tes_minat'] / $maxData['tes_minat'];
            $c4_norm = $dataMentah[$id]['portofolio'] / $maxData['portofolio'];

            $total_nilai = ($c1_norm * 0.40) + ($c2_norm * 0.20) + ($c3_norm * 0.30) + ($c4_norm * 0.10);
            $hasilAkhir[] = ['konsentrasi' => $alt->nama_konsentrasi, 'total' => round($total_nilai, 4)];
        }
        $hasilAkhir = collect($hasilAkhir)->sortByDesc('total')->values()->all();

        // 3. Generate PDF
        $pdf = Pdf::loadView('perhitungan.pdf', compact('mahasiswa', 'transkrip', 'hasilAkhir', 'ipk_mahasiswa'));
        return $pdf->stream('Rapor_Hasil_Analisis_'.$mahasiswa->nim.'.pdf');
    }
}