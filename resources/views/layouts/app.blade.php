<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

  
  <!--SCRIPT UNTUK GOOGLE MAP -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHrdkc90574ADfv6CQcVOOr0Xl5jD1K6k">
    </script>




    <!-- Library - Bootstrap v3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/lib.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/calender/calendar.css') }}">
      <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom - Common CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navigation-menu.css') }}">
    <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- Custom - Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shortcodes.css') }}" />
    
    <!--[if lt IE 9]>
        <script src="js/html5/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
    
/* Shared */
.loginBtn {
  box-sizing: border-box;
  position: relative;
  /* width: 13em;  - apply for fixed size */
  margin: 0.2em;
  padding: 0 15px 0 46px;
  border: none;
  text-align: left;
  line-height: 34px;
  white-space: nowrap;
  border-radius: 0.2em;
  font-size: 16px;
  color: #FFF;
}
.loginBtn:before {
  content: "";
  box-sizing: border-box;
  position: absolute;
  top: 0;
  left: 0;
  width: 34px;
  height: 100%;
}
.loginBtn:focus {
  outline: none;
}
.loginBtn:active {
  box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
}


/* Facebook */
.loginBtn--facebook {
  background-color: #4C69BA;
  background-image: linear-gradient(#4C69BA, #3B55A0);
  /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
  text-shadow: 0 -1px 0 #354C8C;
}
.loginBtn--facebook:before {
  border-right: #364e92 1px solid;
  background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
}
.loginBtn--facebook:hover,
.loginBtn--facebook:focus {
  background-color: #5B7BD5;
  background-image: linear-gradient(#5B7BD5, #4864B1);
}


/* Google */
.loginBtn--google {
  /*font-family: "Roboto", Roboto, arial, sans-serif;*/
  background: #DD4B39;
}
.loginBtn--google:before {
  border-right: #BB3F30 1px solid;
  background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
}
.loginBtn--google:hover,
.loginBtn--google:focus {
  background: #E74B37;
}
.big-checkbox {width: 3000000px; height: 3000000px;}
.

</style>


</head>
<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">

    <!-- Loader -->
    <div id="site-loader" class="load-complete">
        <div class="loader">
            <div class="loader-inner ball-clip-rotate">
                <div></div>
            </div>
        </div>
    </div><!-- Loader /- -->

        <a id="top"></a>
        
    <!-- Header Section -->
    <header id="header" class="header-section header-position container-fluid no-padding">
        <!-- Top Header -->
        <div class="top-header container-fluid no-padding">
            <!-- Container -->
            <div class="container">
                <div class="row">
                    <div class="logo-block col-md-3"><a href="{{ url('/')}}" title="Endeso"><img src="{{ asset('images/logo.png') }}" alt="Logo" /></a></div>
                    <div class="col-md-9 contact-detail">
                        <div class="phone">
                            <img src="{{ asset('images/phone-ic.png') }}" alt="Phone" />
                            <h6>Hubungi Kami</h6>
                            <a href="tell:081234567890" >+62-812-3456-7890</a>
                        </div>
                        
                        <div class="menu-search">
                            <div id="sb-search" class="sb-search">
                                <form>
                                    <input class="sb-search-input" placeholder="Pencarian..." type="text" value="" name="search" id="search" />
                                    <button class="sb-search-submit"><img src="{{ asset('images/search-ic.png') }}" alt="Search" /></button>
                                    <span class="sb-icon-search"></span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Container /- -->
        </div><!-- Top Header /- -->
        <!-- Menu Block -->
        <div class="menu-block">
            <!-- Container -->
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <nav class="navbar navbar-default ow-navigation">
                            <div class="navbar-header">
                                <button aria-controls="navbar" aria-expanded="false" id="btnCollapse" collapse-toogle="1" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="{{ url('/')}}" title="Endeso" class="navbar-brand"><img src="{{ asset('images/logo-mobile.png') }}"></a>
                            </div>
                            <div class="navbar-collapse collapse" id="navbar">
                                <ul class="nav navbar-nav">

                                @if (Auth::guest())
                                    <li class="active">
                                        <a href="{{ url('/home')}}" title="Home" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                                    </li>
                                    <li><a href="{{ url('/tentang-endeso')}}" title="Tentang">Tentang Endeso</a></li>
                                    <li><a href="{{ url('/cara-pesan')}}" title="Tentang">Cara Pesan</a></li>
                                    <li><a href="{{ url('/kontak')}}" title="Contact">Kontak</a></li>

                                    <li class="li-navbar">
                                        <a href="{{ url('/login')}}" title="Book Now">Masuk / Daftar</a>
                                    </li>
                                    
                                @endif

                                @role('member')
                                    <li class="active">
                                        <a href="{{ url('/home')}}" title="Home" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Home</a>

                                    </li>
                                    <li><a href="{{ route('pesanan') }}" title="Contact">Pesanan Saya</a></li>
                                          
                                    <li><a href="{{ url('/cara-pesan')}}" title="Tentang">Cara Pesan</a></li>
                                    
                                    <li><a href="{{ url('/kontak')}}" title="Contact">Kontak</a></li>

                                    <li> <a href="{{ route('profil.edit')}}" title="Profile"> <span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}</a> 
                                    </li>

                                    <li class="li-navbar">
                                        <a href="{{ url('/logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Logout </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                           {{ csrf_field() }}
                                        </form>
                                    </li>
                                    
                                @endrole
                                  
                                @role('admin')
                                    <li><a href="{{ route('destinasi.index')}}" title="Services">Destinasi</a></li>

                                    <li class="dropdown"> 
                                        <a href="#" title="Rooms" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"> Homestay </a> 
                                        <i class="ddl-switch fa fa-angle-down"></i> 
                                        <ul class="dropdown-menu"> 
                                             <li><a href="{{ route('rumah.index') }}" title="Services">Rumah </a></li>
                                             <li><a href="{{ route('kamar.index') }}" title="Services">Kamar</a></li>
                                        </ul> 

                                    </li>

                                    <li class="dropdown"> 
                                        <a href="#" title="Rooms" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"> Culture Experience</a> 
                                        <i class="ddl-switch fa fa-angle-down"></i> 
                                        <ul class="dropdown-menu"> 
                                             <li><a href="{{ route('kategori.index') }}" title="Services">Kategori </a></li>
                                             <li><a href="{{ route('warga.index') }}" title="Services">Warga</a></li>
                                        </ul> 

                                    </li>

                                    <li class="dropdown"> 
                                        <a href="#" title="Rooms" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"> Setting</a> 
                                        <i class="ddl-switch fa fa-angle-down"></i> 
                                        <ul class="dropdown-menu"> 
                                             <li><a href="{{ route('setting-halaman.index')}}" title="Services">Setting Halaman</a></li>
                                             <li><a href="{{ route('rekening.index')}}" title="Services">Rekening</a></li>
                                              <li><a href="{{ route('social_media.index')}}" title="Services">Social Media</a></li>
                                                <li><a href="{{ route('user_admin.index')}}" title="Services">User Admin </a></li>
                                             <li><a href="{{ route('user_member.index')}}" title="Services">User Member</a></li>
                                        </ul> 

                                    </li>
                                     
                                    <li class="dropdown"> 
                                        <a href="#" title="Rooms" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"> Komentar</a> 
                                        <i class="ddl-switch fa fa-angle-down"></i> 
                                        <ul class="dropdown-menu"> 
                                             <li><a href="{{ route('komentar_kamar.index')}}" title="Services">Kamar</a></li>
                                             <li><a href="{{ route('komentar_kategori.index')}}" title="Services">Kategori</a></li>
                                        </ul> 
                                    </li> 

                                     <li class="dropdown"> 
                                        <a href="#" title="Rooms" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"> Pesanan</a> 
                                        <i class="ddl-switch fa fa-angle-down"></i> 
                                        <ul class="dropdown-menu"> 
                                             <li><a href="{{ route('pemesanan.index') }}" title="Services">Pemesanan </a></li>
                                             <li><a href="{{ route('konfirmasi_pembayaran.index') }}" title="Services">Pembayaran </a></li>
                                            
                                        </ul> 

                                    </li>
                                       
                                    <li class="li-navbar">
                                        <a href="{{ url('/logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Logout </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                           {{ csrf_field() }}
                                        </form>
                                    </li>

                                @endrole
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-2 book-now" id="btnLogin">
                        @if (Auth::guest())
                          <a href="{{ url('/login')}}" title="Book Now">Masuk / Daftar</a>
                        @else
                          <a href="{{ url('/logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Logout </a>

                          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                             {{ csrf_field() }}
                          </form>
                        @endif
                  </div>
                </div><!-- Row /- -->
            </div><!-- Container /- -->
        </div><!-- Menu Block /- -->
    </header><!-- Header Section /- -->
      
        @yield('content')
   

     <!-- Footer Section -->
    <div class="footer-section container-fluid no-padding">
        <!-- Top Footer -->
        <div class="top-footer container-fluid no-padding">
            <!-- Container -->
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-sm-6 col-xs-6 widget text_widget">
                        <ul class="social_widget">
                            <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </aside>
                    
                    <aside class="col-md-4 col-sm-6 col-xs-6 widget text_widget">
                        <div style="text-align:center">
                        <a href=#><img src="{{ asset('images/logo.png') }}"></a>
                        </div>
                    </aside>

                    <aside class="col-md-4 col-sm-6 col-xs-6 widget text_widget">
                        <p align="right" color="#fff" style="line-height:20px">
                            &copy; 2017 <span style="color:#faac17">Endeso.id</span><br>
                            Semua hak dilindungi undang-undang
                        </p>
                    </aside>
                </div>
            </div><!-- Container /- -->
        </div><!-- Top Footer -->
    </div><!-- Footer Section /- -->   




    <!-- JQuery v1.11.3 -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    
    <!-- Library JS -->
    <script src="{{ asset('libraries/lib.js') }}"></script>
    <script src="{{ asset('libraries/calender/jquery-ui-datepicker.min.js') }}"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
        
    <!-- Library - Theme JS --> 
    <script src="{{ asset('js/functions.js') }}"></script>

    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
      <script src="{{ asset('js/my.js') }}"></script>



          <script type="text/javascript">

        $(document).ready(function(){

            var pilihan = $("#pilihan").val();

                    //jika pilihan nya CULTUR EXPERIENCE
                    if (pilihan == 2) {

                        $("#span_cultur").hide();
                        $("#datepicker1").attr("placeholder","TANGGAL");
                    }
                    else
                    {

                        $("#span_cultur").show();
                        $("#datepicker1").attr("placeholder","DARI TANGGAL");

                    }

            $(document).on('change','#pilihan',function(e){

                var pilihan = $(this).val();

                    //jika pilihan nya CULTUR EXPERIENCE
                    if (pilihan == 2) {

                        $("#span_cultur").hide();
                        $("#datepicker1").attr("placeholder","TANGGAL");
                    }
                    else
                    {

                        $("#span_cultur").show();
                        $("#datepicker1").attr("placeholder","DARI TANGGAL");

                    }

            });

        });

       </script>


    @yield('scripts')
</body>
</html>
