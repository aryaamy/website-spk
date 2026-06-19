@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Tambah Data Mahasiswa</h1>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Form Input Mahasiswa</h4>
          </div>
          <div class="card-body">
            
            <form action="{{ url('/mahasiswa') }}" method="POST">
              @csrf 
              
              <div class="form-group">
                <label>NIM Mahasiswa</label>
                <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') }}" placeholder="Masukkan NIM..." required>
                @error('nim')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukkan Nama..." required>
                @error('nama')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas') }}" placeholder="Contoh: IF-A Pagi" required>
                @error('kelas')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary">Simpan Data</button>
              <a href="{{ url('/mahasiswa') }}" class="btn btn-secondary">Batal</a>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection