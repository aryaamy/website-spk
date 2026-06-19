<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rapor Rekomendasi Konsentrasi</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2, .header h3 { margin: 0; padding: 2px; }
        .identitas { margin-bottom: 20px; }
        .identitas td { padding: 3px 0; }
        table.data { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.data th, table.data td { border: 1px solid #000; padding: 8px; text-align: left; }
        table.data th { background-color: #f2f2f2; }
        .kesimpulan { border: 1px solid #28a745; padding: 15px; background-color: #d4edda; margin-bottom: 20px; }
        .footer { text-align: right; margin-top: 40px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>PROGRAM STUDI TEKNIK INFORMATIKA</h2>
        <h3>HASIL ANALISIS SISTEM PENDUKUNG KEPUTUSAN</h3>
        <p>Rekomendasi Pemilihan Konsentrasi Studi (Metode SAW)</p>
    </div>

    <table class="identitas">
        <tr>
            <td width="150">Nama Mahasiswa</td>
            <td width="10">:</td>
            <td><strong>{{ $mahasiswa->nama }}</strong></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>:</td>
            <td><strong>{{ $mahasiswa->nim }}</strong></td>
        </tr>
    </table>

    <h4>1. Kesimpulan Rekomendasi</h4>
    <div class="kesimpulan">
        Berdasarkan hasil analisis rekam jejak akademik, mahasiswa yang bersangkutan <strong>sangat direkomendasikan</strong> untuk mengambil konsentrasi: <br>
        <h3 style="margin: 5px 0;">{{ $hasilAkhir[0]['konsentrasi'] }}</h3>
    </div>

    <h4>2. Rincian Skor Kecocokan</h4>
    <table class="data">
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Pilihan Konsentrasi</th>
                <th>Skor Akhir (V)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasilAkhir as $index => $hasil)
            <tr>
                <td>Rank {{ $index + 1 }}</td>
                <td>{{ $hasil['konsentrasi'] }}</td>
                <td>{{ $hasil['total'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>3. Lampiran Riwayat Transkrip (Basis Analisis)</h4>
        <p>Rincian nilai akademik yang diekstraksi dari Semester 1 hingga Semester 3:</p>

    @foreach($transkrip as $semester => $mk_list)
    <h5 style="margin-bottom: 5px; margin-top: 15px;">Semester {{ $semester }}</h5>
    <table class="data">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode MK</th>
                <th width="45%">Mata Kuliah</th>
                <th width="20%">Kategori Analisis</th>
                <th width="15%">Nilai Input</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mk_list as $index => $t)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $t->kode_mk }}</td>
                <td>{{ $t->nama_mk }}</td>
                <td>{{ ucfirst($t->kategori) }}</td>
                <td style="text-align: center;"><strong>{{ $t->nilai_angka }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach

    <div class="footer">
        <p>Katapang, {{ date('d F Y') }}</p>
        <br><br><br>
        <p><strong>( Admin Prodi / Kaprodi )</strong></p>
    </div>

</body>
</html>

</body>
</html>