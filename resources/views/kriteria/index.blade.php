@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Kelola Data Kriteria</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Daftar Kriteria SAW</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
                <th>Tipe Atribut</th>
              </tr>
            </thead>
            <tbody>
              <!-- Looping data dari database -->
              @foreach($kriteria as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kode_kriteria }}</td>
                <td>{{ $item->nama_kriteria }}</td>
                <td>{{ $item->bobot }}</td>
                <td>
                  @if($item->tipe_atribut == 'benefit')
                    <span class="badge badge-success">Benefit</span>
                  @else
                    <span class="badge badge-warning">Cost</span>
                  @endif
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