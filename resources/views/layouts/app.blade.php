@include('layouts.header')
@inject('user','App\Models\User')
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper" style="background-color: #3C8DBC; color:#ffffff;">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light"  >
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            @auth()
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                        <img src="{{ asset('adminlte/img/user2-128x128.jpg') }}" class="user-image elevation-1"
                             alt="User Image">
                        <span class="username">{{ Auth::user()->name }}</span>
                    </a>
                    @endauth
                    <div class="dropdown-menu dropdown-menu-right">
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Logout</button>
                                @csrf
                            </form>
                        </li>
                    </div>
                </li>
        </ul>
    </nav>
    <!-- Main Sidebar Container -->
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex" >
                <div class="image">
                    {{--  <img src="{{asset('adminlte/img/blood.png')}}" class="img-circle elevation-3"
                           alt="User Image">
                                  --}}
                    <a href="{{url('/')}}" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <h3 class="logo-mini text-center " >{{ config('app.name') }}</h3>

                        @auth()
                            <a href="#" class="d-flex align-items-center">
                                <img src="{{ asset('adminlte/img/user2-128x128.jpg') }}" class="img-circle elevation-1" alt="User Image">
                                <span class="username" style="margin-left: 10px;">{{ Auth::user()->name }}</span>
                            </a>

                        @endauth
                        {{--   <form id="logout-form" action="{{ route('logout') }}" method="POST">
                               <button type="submit" class="btn btn-sm btn-outline-primary">Logout</button>
                               @csrf
                           </form> --}}
                        <!-- logo for regular state and mobile devices -->
                        {{--         <span class="logo-lg">{{ config('app.name') }}</span>
                                 <span class="logo-lg"><b>تطبيق بنك  </b>الدم</span>  --}}
                    </a>


                </div>

            </div>

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
            <x-nav />


            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            @yield('page_title')
                            <small>@yield('small_title')</small>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @stack('breadcrumb')
                                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        @yield('content')
    </div>
@include ('layouts.footer')


</body>




