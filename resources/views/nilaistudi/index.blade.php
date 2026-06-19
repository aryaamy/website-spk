@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Data Transkrip Nilai</h1>
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
        <h4>Daftar Mahasiswa</h4>
        <div class="card-header-action">
          <a href="{{ url('/nilaistudi/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Input Transkrip Baru</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Status Transkrip</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mahasiswa_dinilai as $index => $md)
              @php $mhs = \App\Models\Mahasiswa::find($md->mahasiswa_id); @endphp
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->nim }}</td>
                <td><span class="badge badge-success">Sudah Diisi</span></td>
                <td>
                  <form action="{{ url('/nilaistudi/reset/'.$mhs->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset transkrip nilai mahasiswa ini? Semua data nilai akan dihapus.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset Transkrip</button>
                  </form>
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