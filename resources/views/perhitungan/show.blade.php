@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <!-- Pakai url()->previous() biar otomatis balik ke halaman sebelumnya -->
      <a href="{{ url()->previous() }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Rapor SPK Minat Studi</h1>
    
    <div class="section-header-breadcrumb">
      <a href="{{ url('/perhitungan/cetak_pdf/'.$mahasiswa->id) }}" target="_blank" class="btn btn-danger">
        <i class="fas fa-file-pdf"></i> Cetak PDF
      </a>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">Hasil Keputusan: {{ $mahasiswa->nama }}</h2>
    <p class="section-lead">NIM: {{ $mahasiswa->nim }}</p>
    <p class="section-lead">IPK Akademik: {{ $ipk_mahasiswa }}</p>

    <div class="row">
      <div class="col-12">
        <div class="card card-success">
          <div class="card-header">
            <h4><i class="fas fa-star text-warning"></i> Rekomendasi Konsentrasi</h4>
          </div>
          <div class="card-body">
            <div class="alert alert-success">
              Berdasarkan analisis nilai akademik keseluruhan, Anda sangat disarankan untuk mengambil konsentrasi <strong>{{ $hasilAkhir[0]['konsentrasi'] }}</strong>.
            </div>

            <div class="table-responsive">
              <table class="table table-striped table-md mt-2">
                <thead>
                  <tr>
                    <th>Ranking</th>
                    <th>Pilihan Konsentrasi</th>
                    <th>Skor Kecocokan (V)</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($hasilAkhir as $index => $hasil)
                  <tr>
                    <td>
                      @if($index == 0) <span class="badge badge-success">Rank 1</span>
                      @else <span class="badge badge-dark">Rank {{ $index + 1 }}</span>
                      @endif
                    </td>
                    <td><strong>{{ $hasil['konsentrasi'] }}</strong></td>
                    <td>{{ $hasil['total'] }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4><i class="fas fa-book"></i> Transkrip Nilai Akademik</h4>
          </div>
          <div class="card-body">
            
            <div class="row">
              @foreach($transkrip as $semester => $mk_list)
              <div class="col-12 col-md-4"> <div class="section-title mt-0">Semester {{ $semester }}</div>
                <div class="table-responsive">
                  <table class="table table-sm table-bordered">
                    <thead class="thead-light">
                      <tr>
                        <th>Mata Kuliah</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($mk_list as $t)
                      <tr>
                        <td>
                          {{ $t->nama_mk }} <br>
                          <small class="text-muted">{{ ucfirst($t->kategori) }}</small>
                        </td>
                        <td class="align-middle text-center"><strong>{{ $t->nilai_angka }}</strong></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection