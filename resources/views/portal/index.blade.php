<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Portal Mahasiswa - SPK Minat Studi</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/collage.png') }}">

  <style>
    /* Bikin background abu-abu kalem biar kartunya lebih nonjol */
    body {
      background-color: #f4f6f9;
    }
  </style>
</head>

<body>
  <div id="app">
    <!-- flexbox buat bikin posisinya center persis di tengah layar -->
    <section class="section d-flex align-items-center justify-content-center min-vh-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6">
            
            <div class="card card-primary shadow-lg">
              <div class="card-header d-flex justify-content-center pt-5 pb-0 border-bottom-0">
                 <h3 class="text-primary"><i class="fas fa-search-location mr-2"></i> Cek Rekomendasi</h3>
              </div>
              <div class="card-body pt-3 pb-5 px-4 px-md-5 text-center">
                <p class="text-muted mb-4">Masukkan Nomor Induk Mahasiswa (NIM) Anda untuk melihat hasil analisis algoritma SAW.</p>

                @if(session('error'))
                  <div class="alert alert-danger alert-dismissible show fade text-left">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert"><span>&times;</span></button>
                      {{ session('error') }}
                    </div>
                  </div>
                @endif

                <form action="{{ url('/cari-nim') }}" method="POST">
                  @csrf
                  <div class="input-group input-group-lg shadow-sm rounded">
                    <input type="text" name="nim" class="form-control" placeholder="Ketik NIM Anda di sini..." required autofocus autocomplete="off">
                    <div class="input-group-append">
                      <button class="btn btn-primary px-4" type="submit"><i class="fas fa-search"></i> Cari</button>
                    </div>
                  </div>
                </form>
                
                <div class="mt-5 text-muted text-small">
                    Copyright &copy; 2026 &mdash; SPK Minat Studi
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>