@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Matriks Penilaian Awal</h1>
  </div>

  <div class="section-body">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert"><span>&times;</span></button>
          {{ session('success') }}
        </div>
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Data Matriks Keputusan (X)</h4>
        <div class="card-header-action">
          <a href="{{ url('/penilaian/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Input Nilai</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Mahasiswa</th>
                <th>Konsentrasi</th>
                @foreach($kriteria as $k)
                  <th>{{ $k->kode_kriteria }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($mahasiswa_dinilai as $md)
              <tr>
                <td>{{ \App\Models\Mahasiswa::find($md->mahasiswa_id)->nama }}</td>
                <td>{{ \App\Models\Alternatif::find($md->alternatif_id)->nama_konsentrasi }}</td>
                
                @foreach($kriteria as $k)
                  @php
                    $nilai = \App\Models\Penilaian::where('mahasiswa_id', $md->mahasiswa_id)
                                ->where('alternatif_id', $md->alternatif_id)
                                ->where('kriteria_id', $k->id)
                                ->value('nilai_rating');
                  @endphp
                  <td>{{ $nilai ?? '-' }}</td>
                @endforeach
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