@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Input Nilai Mahasiswa</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <form action="{{ url('/penilaian') }}" method="POST">
          @csrf 
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Pilih Mahasiswa</label>
                <select name="mahasiswa_id" class="form-control" required>
                  <option value="">-- Pilih Mahasiswa --</option>
                  @foreach($mahasiswa as $m)
                    <option value="{{ $m->id }}">{{ $m->nim }} - {{ $m->nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Pilih Konsentrasi (Alternatif)</label>
                <select name="alternatif_id" class="form-control" required>
                  <option value="">-- Pilih Konsentrasi --</option>
                  @foreach($alternatif as $a)
                    <option value="{{ $a->id }}">{{ $a->kode_alternatif }} - {{ $a->nama_konsentrasi }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <hr>
          <h5>Masukkan Nilai Kriteria:</h5>
          <div class="row mt-3">
            @foreach($kriteria as $k)
              <div class="col-md-3">
                <div class="form-group">
                  <label>{{ $k->kode_kriteria }} ({{ $k->nama_kriteria }})</label>
                  <input type="number" step="any" name="nilai[{{ $k->id }}]" class="form-control" required placeholder="Nilai...">
                </div>
              </div>
            @endforeach
          </div>

          <button type="submit" class="btn btn-primary mt-3">Simpan Matriks</button>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection