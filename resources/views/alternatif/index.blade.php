@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Kelola Data Konsentrasi</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Daftar Pilihan Konsentrasi Studi</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Alternatif</th>
                <th>Nama Konsentrasi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($alternatif as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kode_alternatif }}</td>
                <td>{{ $item->nama_konsentrasi }}</td>
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