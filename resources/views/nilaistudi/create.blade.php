@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Input Nilai Transkrip</h1>
  </div>

  <div class="section-body">
    <form action="{{ url('/nilaistudi') }}" method="POST">
      @csrf 
      
      <div class="card">
        <div class="card-body">
          <div class="form-group col-md-6 px-0">
            <label>Pilih Mahasiswa</label>
            <select name="mahasiswa_id" class="form-control" required>
              <option value="">-- Pilih Mahasiswa --</option>
              @foreach($mahasiswa as $m)
                <option value="{{ $m->id }}">{{ $m->nim }} - {{ $m->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      @foreach($matakuliah as $semester => $mk_list)
      <div class="card">
        <div class="card-header">
          <h4>Mata Kuliah Semester {{ $semester }}</h4>
        </div>
        <div class="card-body">
          <div class="row">
            @foreach($mk_list as $mk)
            <div class="col-md-4">
              <div class="form-group">
                <label>{{ $mk->nama_mk }} <br> <small class="text-muted">Kategori: {{ ucfirst($mk->kategori) }}</small></label>
                <input type="number" step="any" name="nilai[{{ $mk->id }}]" class="form-control" placeholder="Nilai angka (contoh: 85)...">
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      @endforeach

      <div class="card">
        <div class="card-header bg-primary text-white">
          <h4 class="text-white"><i class="fas fa-star"></i> Penilaian Tambahan (Sesuai Laporan)</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nilai Tes Minat (C3) <br> <small class="text-muted">Skala 0 - 100</small></label>
                <input type="number" step="any" name="nilai_tes_minat" class="form-control" placeholder="Contoh: 85" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Nilai Portofolio/Sertifikasi (C4) <br> <small class="text-muted">Skala 0 - 100</small></label>
                <input type="number" step="any" name="nilai_portofolio" class="form-control" placeholder="Contoh: 80" required>
              </div>
            </div>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-lg btn-block mb-5">Simpan Transkrip Nilai</button>
    </form>
  </div>
</section>
@endsection