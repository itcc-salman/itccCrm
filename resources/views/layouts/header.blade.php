<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="{{ asset('assets/dist/img/ico/favicon.png') }}" type="image/x-icon">
      <!-- Start Global Mandatory Style
         =====================================================================-->

      <!-- lobicard tather css -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/lobipanel/css/tether.min.css') }}" />
      <!-- Bootstrap -->
      <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
       <!-- lobicard tather css -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/lobipanel/css/jquery-ui.min.css') }}" />
      <!-- lobicard min css -->
      <link href="{{ asset('assets/plugins/lobipanel/css/lobicard.min.css') }}" rel="stylesheet" />
      <!-- lobicard github css -->
      <link href="{{ asset('assets/plugins/lobipanel/css/github.css') }}" rel="stylesheet" />
      <!-- Pace css -->
      <link href="{{ asset('assets/plugins/pace/flash.css') }}" rel="stylesheet" />
      <!-- Font Awesome -->
      <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
      <!-- Pe-icon -->
      <link href="{{ asset('assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
      <!-- Themify icons -->
      <link href="{{ asset('assets/themify-icons/themify-icons.css') }}" rel="stylesheet" />
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start page Label Plugins
         =====================================================================-->
      <!-- Emojionearea -->
      <link href="{{ asset('assets/plugins/emojionearea/emojionearea.min.css') }}" rel="stylesheet" />
      <!-- Monthly css -->
      <link href="{{ asset('assets/plugins/monthly/monthly.css') }}" rel="stylesheet" />
      <link href="{{ asset('assets/plugins/toaster/jquery.toast.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
      <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
      <!-- End page Label Plugins
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="{{ asset('assets/dist/css/stylecrm.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/mystyles.css') }}" rel="stylesheet" />
      @yield('styles')

</head>
<body>
    <div class="hold-transition sidebar-mini">
        <!--preloader-->
      <div id="preloader">
         <div id="status"></div>
      </div>
      <!-- Site wrapper -->
      <div class="wrapper">
        <header class="main-header">
          <a href="{{ route('home') }}" class="logo">
             <!-- Logo -->
             <span class="logo-mini">
             <img src="{{ asset('assets/dist/img/mini-logo.png') }}" alt="">
             </span>
             <span class="logo-lg">
             <img src="{{ asset('assets/dist/img/itcc-logo.png') }}" alt="">
             </span>
          </a>
          <!-- Header Navbar -->
          <nav class="navbar navbar-expand py-0">
             <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <!-- Sidebar toggle button-->
                <span class="sr-only">Toggle navigation</span>
                <span class="pe-7s-angle-left-circle"></span>
             </a>
             <!-- searchbar-->
             {{-- <a href="#search"><span class="pe-7s-search"></span></a>
             <div id="search">
                <button type="button" class="close">×</button>
                <form>
                   <input type="search" value="" placeholder="Search.." />
                   <button type="submit" class="btn btn-add">Search...</button>
                </form>
             </div> --}}
             <div class="collapse navbar-collapse navbar-custom-menu" >
               <ul class="navbar-nav ml-auto">
                <!-- Messages -->
                 <li class="nav-item dropdown messages-menu">
                   <a class="nav-link admin-notification" href="#"  role="button" data-toggle="dropdown">
                      <i class="pe-7s-mail"></i>
                      <span class="label bg-success">5</span>
                   </a>
                   <div class="dropdown-menu drop_drop custom_drop_scroll">
                     <a class="dropdown-item" href="#">
                        <div class="menue">
                           <div class="left_item">
                               <img src="{{ asset('assets/dist/img/avatar.png') }}"  class="rounded-circle" alt="User Image"/>
                           </div>
                           <div class="right_item">
                               <h4>Ronaldo</h4>
                               <p>Please oreder 10 pices of kits..</p>
                               <span class="badge badge-success badge-massege"><small>15 hours ago</small>
                               </span>
                           </div>
                        </div>
                     </a>
                     <a class="dropdown-item" href="#">
                        <div class="menue">
                           <div class="left_item pull-left">
                               <img src="{{ asset('assets/dist/img/avatar2.png') }}"  class="rounded-circle" alt="User Image"/>
                           </div>
                           <div class="right_item">
                               <h4>Leo messi</h4>
                               <p>Please oreder 10 pices of Sheos..</p>
                               <span class="badge badge-info badge-massege"><small>6 days ago</small>
                               </span>
                           </div>
                        </div>
                     </a>
                     <a class="dropdown-item" href="#">
                        <div class="menue">
                           <div class="left_item">
                               <img src="{{ asset('assets/dist/img/avatar3.png') }}"  class="rounded-circle" alt="User Image"/>
                           </div>
                           <div class="right_item">
                               <h4>Modric</h4>
                               <p>Please oreder 6 pices of bats..</p>
                               <span class="badge badge-info badge-massege"><small>1 hour ago</small>
                               </span>
                           </div>
                        </div>
                     </a>
                   </div>
                 </li>
                <!-- Notifications -->
                 <li class="nav-item dropdown notifications-menu">
                   <a class="nav-link admin-notification" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="pe-7s-bell"></i>
                      <span class="label bg-warning">5</span>
                   </a>
                   <div class="dropdown-menu drop_drops custom_drop_scroll">
                     <a class="dropdown-item" href="#">
                        <div class="menues">
                            <p>
                            <i class="fa fa-dot-circle-o color-red"></i>
                            Change Your font style</p>
                        </div>
                     </a>
                     <a class="dropdown-item" href="#">
                      <div class="menues">
                         <p>
                         <i class="fa fa-dot-circle-o color-red"></i>
                         check the system ststus..</p>
                     </div>
                     </a>
                     <a class="dropdown-item" href="#">
                      <div class="menues">
                         <p>
                         <i class="fa fa-dot-circle-o color-red"></i>
                         Add more admin...</p>
                     </div>
                     </a>
                     <a class="dropdown-item" href="#">
                      <div class="menues">
                         <p>
                         <i class="fa fa-dot-circle-o color-red"></i>
                         Add more clients and order</p>
                     </div>
                     </a>
                     <a class="dropdown-item" href="#">
                      <div class="menues">
                         <p>
                         <i class="fa fa-dot-circle-o color-red"></i>
                         Add more admin...</p>
                     </div>
                     </a>
                     <a class="dropdown-item" href="#">
                      <div class="menues">
                         <p>
                         <i class="fa fa-dot-circle-o color-red"></i>
                         Add more clients and order</p>
                     </div>
                     </a>
                   </div>
                 </li>
                <!-- Tasks -->
                 <li class="nav-item dropdown tasks-menu">
                   <a class="nav-link admin-notification" href="#"  role="button" data-toggle="dropdown">
                      <i class="pe-7s-note2"></i>
                      <span class="label bg-danger">5</span>
                   </a>
                   <div class="dropdown-menu drop_dropr custom_drop_scroll">
                     <a class="dropdown-item" href="#">
                        <div class="menuers">
                            <div class="single_menuers_item">
                               <h3><i class="fa fa-check-circle"></i> Theme color should be <span><span class="label label-success float-right">50%</span></span></h3>
                            </div>
                        </div>
                     </a>
                     <a class="dropdown-item" href="#">
                        <div class="menuers">
                            <div class="single_menuers_item">
                               <h3><i class="fa fa-check-circle"></i> Fix Error and bugs <span><span class="label label-warning float-right">90%</span></span></h3>
                            </div>
                        </div>
                     </a>
                     <a class="dropdown-item" href="#">
                        <div class="menuers">
                            <div class="single_menuers_item">
                               <h3><i class="fa fa-check-circle"></i> Sidebar color change <span><span class="label label-danger float-right">80%</span></span></h3>
                            </div>
                        </div>
                     </a>
                     <a class="dropdown-item" href="#">
                        <div class="menuers">
                            <div class="single_menuers_item">
                               <h3><i class="fa fa-check-circle"></i> font-family should be  <span><span class="label label-info float-right">30%</span></span></h3>
                            </div>
                        </div>
                     </a>
                     <a class="dropdown-item" href="#">
                        <div class="menuers">
                            <div class="single_menuers_item">
                               <h3><i class="fa fa-check-circle"></i> Fix the database Error <span><span class="label label-success float-right">60%</span></span></h3>
                            </div>
                        </div>
                     </a>
                     <a class="dropdown-item" href="#">
                        <div class="menuers">
                            <div class="single_menuers_item">
                               <h3><i class="fa fa-check-circle"></i> data table data missing <span><span class="label label-info float-right">20%</span></span></h3>
                            </div>
                        </div>
                     </a>
                   </div>
                 </li>
                <!-- Help -->
                 <li class="nav-item dropdown  dropdown-help">
                   <a class="nav-link hidden_hidden" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="pe-7s-settings"></i></a>

                   <div class="dropdown-menu drop_down">
                      <div class="menus">
                            <a class="dropdown-item" href="#"><i class="fa fa-bar-chart"></i> Settings</a>
                      </div>
                   </div>
                 </li>
                <!-- User -->
                 <li class="nav-item dropdown dropdown-user">
                   <a class="nav-link" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <img src="{{ asset('assets/dist/img/avatar5.png') }}" class="rounded-circle" width="50" height="50" alt="user"></a>

                   <div class="dropdown-menu drop_down">
                        <div class="menus">
                            <a class="dropdown-item" href="#"><i class="fa fa-user"></i> User Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Signout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                   </div>
                 </li>
               </ul>
             </div>
           </nav>
          </header>
        <!-- =============================================== -->
        <!-- Left side column. contains the sidebar -->
