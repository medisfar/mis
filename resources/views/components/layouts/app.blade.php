<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Adds MIS</title>
@php
  // Chemin public détecté automatiquement :
  // /public/ sur mis.local et /mis/public/ sur localhost/mis.
  $dir = rtrim(request()->getBasePath(), '/') . '/';
@endphp
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{$dir}}plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{$dir}}dist/css/adminlte.min.css">
  <link rel="stylesheet" href="{{$dir}}dist/css/monstyle.css">
    <!-- Alpine.js for Livewire -->
    
    <style>
/* ============================================
   MIS BANNER - DIRECT EMBED (WILL WORK 100%)
   ============================================ */

/* Force banner to display properly */
.top-header {
  background: linear-gradient(135deg, #0b2b44 0%, #1a4a6f 100%) !important;
  padding: 1rem 2rem !important;
  display: flex !important;
  justify-content: space-between !important;
  align-items: center !important;
  flex-wrap: wrap !important;
  gap: 1rem !important;
  border-bottom: 3px solid #f39c12 !important;
  font-family: 'Source Sans Pro', sans-serif !important;
  width: 100% !important;
  box-sizing: border-box !important;
}

/* Left section */
.header-left {
  display: flex !important;
  align-items: center !important;
  gap: 1rem !important;
}

/* Logo box */
.logo-box {
  width: 52px !important;
  height: 52px !important;
  background: linear-gradient(145deg, #f39c12, #e67e22) !important;
  border-radius: 16px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  font-size: 28px !important;
  font-weight: 800 !important;
  color: #0b2b44 !important;
  box-shadow: 0 4px 10px rgba(0,0,0,0.2) !important;
}

/* Titles */
.header-title {
  font-size: 1.25rem !important;
  font-weight: 600 !important;
  color: white !important;
  margin: 0 !important;
  line-height: 1.3 !important;
}

.header-subtitle {
  font-size: 0.75rem !important;
  color: #cce3f5 !important;
  margin-top: 4px !important;
}

/* Right section */
.header-right {
  display: flex !important;
  align-items: center !important;
  gap: 1rem !important;
}

/* Badges */
.header-badge {
  background: rgba(255, 255, 255, 0.12) !important;
  padding: 0.4rem 1rem !important;
  border-radius: 40px !important;
  font-size: 0.75rem !important;
  color: #fef9e8 !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  border: 1px solid rgba(255, 255, 255, 0.2) !important;
}

/* Live dot */
.dot-live {
  width: 10px !important;
  height: 10px !important;
  background-color: #2ecc71 !important;
  border-radius: 50% !important;
  display: inline-block !important;
  animation: pulseGreen 1.5s infinite !important;
}

@keyframes pulseGreen {
  0% { box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.6); }
  70% { box-shadow: 0 0 0 6px rgba(46, 204, 113, 0); }
  100% { box-shadow: 0 0 0 0 rgba(46, 204, 113, 0); }
}

/* User avatar */
.user-avatar {
  width: 40px !important;
  height: 40px !important;
  background: linear-gradient(135deg, #f39c12, #e67e22) !important;
  border-radius: 50% !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  font-weight: 700 !important;
  color: #0b2b44 !important;
  border: 2px solid rgba(255, 255, 255, 0.6) !important;
}

/* Mobile responsive */
@media (max-width: 768px) {
  .top-header {
    flex-direction: column !important;
    text-align: center !important;
    padding: 1rem !important;
  }
  .header-left, .header-right {
    justify-content: center !important;
  }
  .header-title {
    font-size: 1rem !important;
  }
}
</style>
   
   @stack('mescss')
</head>
<body class="hold-transition sidebar-mini">
  <div class="mis-top-header">
  <div class="mis-header-left">
    <div class="mis-logo-box">ADDS</div>
    <div>
      <div class="mis-header-title">MIS – Système d'Information de Gestion</div>
      <div class="mis-header-subtitle"><b>Agence Djiboutienne de Développement Social. A.D.D.S</b></div>
    </div>
  </div>
  <div class="mis-header-right">
    <div class="mis-header-badge">
      <div class="mis-dot-live"></div>
      En ligne · Mis à jour : 15/06/2026
    </div>
    <div class="mis-header-badge">📁 ADDS-2026</div>
    <div class="mis-user-avatar">AD</div>
  </div>
</div>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
     {{$stitre??''}}
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{$dir}}dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/public/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/public/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fa fa-sign-out-alt"></i>
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar  elevation-4" style="background:#011F5B;color:white!important">
    <!-- Brand Logo -->
    <a href="{{url('/')}}/dashboard" class="brand-link">
      <img src="{{url('')}}/adds.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="color:white">MIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{$dir}}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"  style="color:white">{{\Auth::user()->name??''}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
     @include('components.layouts.sidebar')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8" style="padding-left:30px;">
              
            
           @php $projet = session('projet'); @endphp
@if($projet && is_array($projet))
<h1 style="all: revert; font-size: 24px !important; margin: 0 !important;">
    <span style="all: revert; font-size: 20px !important;">Projet: {{ $projet['libelle'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
    <span style="all: revert; font-size: 16px !important; font-variant: small-caps !important; font-weight: bold !important;">
        {{ $projet['nom_projet'] }}
    </span>
</h1>
@endif
           
          </div>
          <div class="col-sm-4 pull-right">
            <livewire:choisir-projet></livewire:choisir-projet>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
 {{$submenu??''}}
      <!-- Default box -->
      
      <div style="margin-bottom:20px;background:#f49cbb;border-radius:10px;border-left:3px solid blue;padding:14px;margin-bottom:10p">
    <div ><span >{{$titre??''}}</span></div>
   
</div>
      <div class="card">
        
        <div class="card-body" style="background:#CBEEF3">
            
          {{$slot}}
         
         
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2024 <a href="https://appsoor.com">AppSoor</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
     <livewire:calendar/>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery <script src="{{$dir}}plugins/jquery/jquery.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 4 -->
<script src="{{$dir}}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{$dir}}dist/js/adminlte.min.js"></script>

 <script src="https://code.highcharts.com/highcharts.js"></script>

<!-- AdminLTE for demo purposes -->
@livewire('lamodal')
@livewireScripts
  
  @stack('messcripts')     
</body> 
</html>
