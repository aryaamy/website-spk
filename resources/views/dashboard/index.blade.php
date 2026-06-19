@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard SPK Minat Studi</h1>
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-users"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Mahasiswa</h4>
          </div>
          <div class="card-body">
            {{ $totalMahasiswa }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-th"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Pilihan Konsentrasi</h4>
          </div>
          <div class="card-body">
            {{ $totalKonsentrasi }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-book"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Mata Kuliah</h4>
          </div>
          <div class="card-body">
            {{ $totalMatkul }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="fas fa-file-alt"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Transkrip Terisi</h4>
          </div>
          <div class="card-body">
            {{ $totalTranskrip }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h4>Selamat Datang di Sistem Rekomendasi Konsentrasi Informatika!</h4>
        </div>
        <div class="card-body">
          <p class="lead">
            Sistem Pendukung Keputusan (SPK) ini dibuat untuk membantu mahasiswa dalam menentukan arah konsentrasi studi secara objektif. 
          </p>
          <p>
            Sistem bekerja dengan cara mengekstraksi riwayat nilai transkrip akademik dari semester awal, mengelompokkannya berdasarkan kategori kemampuan dasar (Jaringan, Pemrograman, dll), dan memprosesnya menggunakan algoritma <strong>Simple Additive Weighting (SAW)</strong> untuk menghasilkan rekomendasi yang paling akurat sesuai minat dan bakat.
          </p>
          <a href="{{ url('/nilaistudi') }}" class="btn btn-primary btn-lg mt-3">Mulai Ekstraksi Nilai</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection