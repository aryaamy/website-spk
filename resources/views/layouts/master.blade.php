<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SPK Minat Studi</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/collage.png') }}">
</head>

<!-- 1. KELAS DINAMIS: Kalau Admin = normal, Kalau Mahasiswa = layout ke tengah -->
<body class="{{ Auth::check() ? '' : 'layout-3' }}">
  <div id="app">
    
    <!-- 2. WRAPPER DINAMIS -->
    <div class="main-wrapper {{ Auth::check() ? '' : 'container' }}">
      <div class="navbar-bg"></div>
      
      <nav class="navbar navbar-expand-lg main-navbar">
        
        <!-- 3. NAVBAR KHUSUS ADMIN (Tampil kalau udah Login) -->
        @auth
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Admin Prodi</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Menu Sistem</div>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        </ul>
        @endauth

      </nav>
      
      <!-- 5. SIDEBAR UTAMA (Hanya tampil kalau Admin login) -->
      @auth
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ url('/dashboard') }}">SPK STUDI</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/dashboard') }}">SPK</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Menu Utama</li>
              <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('/dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
              </li>

              <li class="menu-header">Master Data</li>
              <li class="{{ Request::is('kriteria*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('/kriteria') }}"><i class="fas fa-columns"></i> <span>Data Kriteria</span></a>
              </li>
              <li class="{{ Request::is('alternatif*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('/alternatif') }}"><i class="fas fa-th"></i> <span>Data Konsentrasi</span></a>
              </li>
              <li class="{{ Request::is('mahasiswa*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('/mahasiswa') }}"><i class="fas fa-users"></i> <span>Data Mahasiswa</span></a>
              </li>

              <li class="menu-header">Proses SPK</li>
              <li class="{{ Request::is('nilaistudi*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('/nilaistudi') }}"><i class="fas fa-book"></i> <span>Input Transkrip</span></a>
              </li>
              <li class="{{ Request::is('perhitungan*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ url('/perhitungan') }}"><i class="fas fa-calculator"></i> <span>Hasil Keputusan</span></a>
              </li>
          </ul>
        </aside>
      </div>
      @endauth

      <!-- Konten Utama (Dikasih jarak atas kalau yang buka Mahasiswa) -->
      <div class="main-content" @if(!Auth::check()) style="padding-top: 100px;" @endif>
        @yield('content')
      </div>
      
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2026 <div class="bullet"></div> Sistem Pendukung Keputusan
        </div>
      </footer>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html>