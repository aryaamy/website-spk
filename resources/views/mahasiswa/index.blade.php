@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Kelola Data Mahasiswa</h1>
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
          <a href="{{ url('/mahasiswa/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <thead>
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Kelas</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($mahasiswa as $index => $m)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->nim }}</td>
                <td>{{ $m->nama }}</td>
                <td>{{ $m->kelas ?? '-' }}</td>
                <td>
                    <a href="{{ url('/mahasiswa/'.$m->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    
                    <form action="{{ url('/mahasiswa/'.$m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus mahasiswa ini? Semua nilai transkripnya juga bakal ilang loh!');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="text-center">Data Mahasiswa masih kosong nih, bro. Yuk ditambah!</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection