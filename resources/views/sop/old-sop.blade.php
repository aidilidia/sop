<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SOP</title>
  <link rel="short icon" href="img/sop.png" type="image/png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="vendor/adminlte.min.css">
  <link rel="stylesheet" href="css/btn-hover.css">

</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="./" class="navbar-brand">
        <span class="brand-text font-weight-light">SOP</span>
      </a>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Dropdown Menu -->
        <li class="nav-item dropdown">
          
        @guest
          <a class="nav-link" data-toggle="dropdown" href="login">
        @else
          {{ Auth::user()->name }} 
        @endguest
        <i class="me-3 fas fa-street-view fa-fw" aria-hidden="true"></i>
        </a>

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">Login Form</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> username
              <span class="float-right text-muted text-sm">
                <input type="text" name="" value="">
              </span>
            </a>
            <!-- <div class="dropdown-divider"></div> -->
            <a href="#" class="dropdown-item">
              <i class="fas fa-lock mr-2"></i> password
              <span class="float-right text-muted text-sm">
                <input type="password" name="" value="">
              </span>
            </a>

            <input type="submit" name="" class="button btn-sm btn-info" value="Login">
          </div>

        </li>

      </ul>
    </div>
  </nav>

  <div class="content-wrapper">

    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cari SOP Pengadilan Tinggi Agama Padang? </h1>
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control " type="search" placeholder="Ketik kata kunci pencarian" >
              
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>

          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="content">
      <div class="container">

        <div class="row">
          <div class="col-lg-4">
            <h4>SOP Terbaru</h4>
            <!-- <div class="card"> -->
              @foreach($sops as $sop)
                <a class="card card-primary card-outline text-dark" href="/detail-{{$sop->slug}}" target="_parent">
                  <div class="card-body">
                    <h5 class="card-title">{{$sop->nomor}}</h5>
                    <p class="card-text">
                      {{$sop->nama}}
                    </p>
                    <span class="text-grey">
                      <i class="far fa-calendar-alt"></i> {{date('d F Y', strtotime($sop->tglnomor))}}
                    </span>
                    &emsp;
                    <span class="text-grey">
                      <!-- <i class="fas fa-mouse-pointer"></i> 20 -->
                    </span>
                  </div>
                </a>
              @endforeach
              
            <!-- tidak ############ berlaku -->
            <!-- <div class="card position-relative bg-warning" style="height: 130px">
              <div class="ribbon-wrapper ribbon-lg">
                <div class="ribbon bg-danger">
                  Tidak berlaku
                </div>
              </div>

              <div class="card-body">
                <h5 class="card-title">SOP/232/2000</h5>
                <p class="card-text">
                  SOP  tiap bulan Pemeliharan Peyusunan SOP tiap bulan
                </p>
                <span>
                  <i class="far fa-calendar-alt"></i> 29 April 2021
                </span>
                &emsp;
                <span class="text-grey">
                  <i class="fas fa-mouse-pointer"></i> 2
                </span>
              </div>
            </div> -->

          </div>

          <div class="col-lg-4">
            <h4 style="color:#f4f6f9">SOP Terbaru</h4>
              @foreach($sopos as $sop)
                <a class="card card-primary card-outline text-dark" href="/detail-{{$sop->slug}}" target="_parent">
                  <div class="card-body">
                    <h5 class="card-title">{{$sop->nomor}}</h5>
                    <p class="card-text">
                      {{$sop->nama}}
                    </p>
                    <span class="text-grey">
                      <i class="far fa-calendar-alt"></i> {{date('d F Y', strtotime($sop->tglnomor))}}
                    </span>
                    &emsp;
                    <span class="text-grey">
                      <!-- <i class="fas fa-mouse-pointer"></i> 20 -->
                    </span>
                  </div>
                </a>
              @endforeach
          </div>

          <div class="col-lg-4">
            <h4>Kategori</h4>
            
            @foreach($kategoris as $kategori)
            <a href="/kategori-{{$kategori->kategori}}">
              <div class="callout 
                @if($kategori->id % 4 == 1)
                callout-info
                @elseif($kategori->id % 4 == 2)
                callout-danger
                @elseif($kategori->id % 4 == 3)
                callout-success
                @elseif($kategori->id % 4 == 0)
                callout-warning
                @endif                
                text-dark info-box">
                <div class="info-box-content">
                  <h5>{{$kategori->kategori}}</h5>
                  <p>terkait laporan perkara</p>
                </div>
                <span class="info-box-icon 
                
                  @if($kategori->id % 4 == 1)
                  bg-info
                  @elseif($kategori->id % 4 == 2)
                  bg-danger
                  @elseif($kategori->id % 4 == 3)
                  bg-success
                  @elseif($kategori->id % 4 == 0)
                  bg-warning
                  @endif
                
                  elevation-1 ">35
                </span>
              </div>
            </a>
            @endforeach

            <button class="tomcoret"><span>Lihat Semua</span></button>

          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      <span class="text-white">renprog creative</span> 
    </div>
    <strong>Copyright &copy; 2021 <a href="https://pta-padang.go.id">Pengadilan Tinggi Agama Padang</a></strong>
  </footer>
</div>
</body>
</html>
