<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="short icon" href="img/sop.png" type="image/png">
    <link rel="stylesheet" href="admin/page/css/style.min.css">
    <link rel="stylesheet" href="multiple-select/plugins/select2/css/select2.min.css">
    <style>
        .bulu:hover {
        background-color: #A2DBFA;
        }

        .table tbody tr:hover td, .table tbody tr:hover th {
        color: #009efb;
        font-weight: bold;
        font-size: 15px;
        }

        .green{
        color: green;
        font-weight: bold;
        }

        .textinputo {
            float: left;
            width: 100%;
            min-height: 75px;
            outline: none;
            resize: none;
            border: 10px solid YELLOWGREEN;
        }
        textarea { display:none; }
    </style>
    <script src="admin/asset/plugins/jquery/dist/jquery.min.js"></script>
    
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="#">
                        <b class="logo-icon">
                            <img src="img/sop.png" height="70" alt="homepage" class="dark-logo" />
                        </b>
                    </a>
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav me-auto mt-md-0 ">
                        <li class="nav-item hidden-sm-down">
                            <form class="app-search ps-3" action="/sop">
                                    <button type="submit" class="form-control">ke halaman publish >></button>
                            </form>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="admin/assets/images/users/d3.jpg" alt="user" class="profile-pic me-2">{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu show" aria-labelledby="navbarDropdown"></ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/home" aria-expanded="false"><i class="me-3 fas fa-street-view fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/input" aria-expanded="false">
                                <i class="me-3 fas fa-i-cursor" aria-hidden="true"></i>
                                <span class="hide-menu">Input </span>
                            </a>
                        </li>
            
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/daftar" aria-expanded="false"><i class="me-3 fa fa-snowflake"
                                    aria-hidden="true"></i><span class="hide-menu">Daftar</span></a></li>
                        
                        @if(Auth::user()->level === 'Admin')
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/daftarpengguna" aria-expanded="false">
                                <i class="me-3 fa fa-id-badge" aria-hidden="true"></i>
                                <span class="hide-menu">Pengguna</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/pengaturan" aria-expanded="false">
                                <i class="me-3 fa fa-balance-scale" aria-hidden="true"></i>
                                <span class="hide-menu">Pengaturan</span>
                            </a>
                        </li>
                        @else
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="/pengaturanuser" aria-expanded="false">
                                <i class="me-3 fa fa-balance-scale" aria-hidden="true"></i>
                                <span class="hide-menu">Pengaturan</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::user()->level === 'Penerbit' || Auth::user()->level === 'Approval')
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="/penerbitan" aria-expanded="false">
                                    <i class="me-3 fa fa-rocket" aria-hidden="true"></i>
                                    <span class="hide-menu">Penerbitan</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="/histori" aria-expanded="false">
                                    <i class="me-3 fa fa-clock" aria-hidden="true"></i>
                                    <span class="hide-menu">Histori</span>
                                </a>
                            </li>
                        
                        @else
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="/издательский" aria-expanded="false">
                                    <i class="me-3 fa fa-rocket" aria-hidden="true"></i>
                                    <span class="hide-menu">Penerbitan</span>
                                </a>
                            </li>
                        @endif
                        

                        <li class="text-center p-20 upgrade-btn">
                            <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                class="btn btn-danger text-white mt-4">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">
            @yield('isi')
            <footer class="footer text-center">
                © 2021 SOP PTA Padang
            </footer>

        </div>

    </div>
    <script src="admin/assets/plugins/jquery/dist/jquery.min.js"></script>
    <script src="admin/assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="admin/js/app-style-switcher.js"></script>
    <script src="admin/page/js/waves.js"></script>
    <script src="admin/page/js/sidebarmenu.js"></script>
    <script src="admin/page/js/custom.js"></script>
    <script src="admin/assets/plugins/flot/jquery.flot.js"></script>
    <script src="admin/assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="admin/page/js/pages/dashboards/dashboard1.js"></script>

    <!-- <script src="multiple-select/plugins/jquery/jquery.min.js"></script> -->
    <script src="multiple-select/plugins/select2/js/select2.full.min.js"></script>
    
    <script>
      $(function () {
        $('.select2').select2()
      })
    </script>


    <script language='javascript'>
      function validAngka(a) {
        if(!/^[0-9.]+$/.test(a.value))
        {
          a.value = a.value.substring(0,a.value.length-1000);
        }
      }
    </script>
    <script type="text/javascript">
        $('input[value=1]').on('change', function() {
            $('textarea[name="keterangan"]').hide(800);
            });
            $('input[value=0]').on('change', function() {
                $('textarea[name="keterangan"]').show(800);
            });
     </script>

    <script>
    function chek() {
    var checkBox = document.getElementById("cebox");
    var text = document.getElementById("tombol");
    if (checkBox.checked == true){
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
    }
    </script>

</body>

</html>
