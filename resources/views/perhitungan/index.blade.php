@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Data Hasil SPK Mahasiswa</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Pilih Mahasiswa untuk Dilihat Rapornya</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($hasilPerMahasiswa as $namaMahasiswa => $dataKonsentrasi)
              <tr>
                <td>{{ $no++ }}</td>
                <td><strong>{{ $namaMahasiswa }}</strong></td>
                <td>
                  @php 
                    $mhsId = \App\Models\Mahasiswa::where('nama', $namaMahasiswa)->first()->id;
                  @endphp
                  <a href="{{ url('/perhitungan/'.$mhsId) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-eye"></i> Lihat Rapor & Rekomendasi
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection