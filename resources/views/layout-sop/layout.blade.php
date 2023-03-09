<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="short icon" href="img/sop.png" type="image/png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="vendor/adminlte.min.css">
  <link rel="stylesheet" href="css/btn-hover.css">
  
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="/" class="navbar-brand">
        <span class="tomtop brand-text font-weight-dark">Beranda</span>
      </a>
      
      <a href="/sop" class="navbar-brand">
        <span class="tomtop brand-text font-weight-dark">SOP</span>
      </a>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          @guest
            <a class="nav-link" data-toggle="dropdown" href="/login" title="login">
          @else
            <a href="/home" style="color:grey" title="ke halaman admin">{{ Auth::user()->name }} 
          @endguest
        
            <i class="me-3 fas fa-street-view fa-fw" aria-hidden="true"></i>
            </a>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper">
    @yield('konten')
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      <span class="text-white">renprog creative</span> 
    </div>
    <strong>Copyright &copy; 2021 <a href="https://pta-padang.go.id" target="_blank">Pengadilan Tinggi Agama Padang</a></strong>
  </footer>
</div>
</body>
</html>
