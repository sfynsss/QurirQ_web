<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Admin Press Admin Template - The Ultimate Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{url('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{url('assets/css/colors/blue.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border logo-center">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="">
                            <!-- Logo icon --><b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <img src="{{url('assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="{{url('assets/images/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text --><span>
                               <!-- dark Logo text -->
                               <img src="{{url('assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                               <!-- Light Logo text -->    
                               <img src="{{url('assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" /></span> </a>
                           </div>
                           <!-- ============================================================== -->
                           <!-- End Logo -->
                           <!-- ============================================================== -->
                           <div class="navbar-collapse">
                            <!-- ============================================================== -->
                            <!-- toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav mr-auto mt-md-0">

                            </ul>
                            <!-- ============================================================== -->
                            <!-- User profile and search -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav my-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @php
                                        $a = '';
                                        if (strcasecmp(substr(Auth::user()->name, 0, 1), 'a') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-a-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'b') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-b-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'c') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-c-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'd') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-d-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'e') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-e-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'f') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-f-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'g') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-g-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'h') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-h-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'i') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-i-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'j') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-j-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'k') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-k-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'l') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-l-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'm') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-m-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'n') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-n-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'o') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-o-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'p') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-p-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'q') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-q-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'r') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-r-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 's') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-s-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 't') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-t-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'u') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-u-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'v') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-v-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'w') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-w-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'x') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-x-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'y') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-y-icon.png';
                                        } elseif(strcasecmp(substr(Auth::user()->name, 0, 1), 'z') == 0 && is_null(Auth::user()->foto)) {
                                            $a = 'assets/images/icon/Letter-z-icon.png';
                                        }
                                        @endphp
                                        <img src="{{url($a)}}" alt="user" class="profile-pic" /></a>
                                        <div class="dropdown-menu dropdown-menu-right scale-up">
                                            <ul class="dropdown-user">
                                                <li>
                                                    <div class="dw-user-box">
                                                        <div class="u-img"><img src="{{url($a)}}" alt="user"></div>
                                                        <div class="u-text">
                                                            <h4>{{Auth::user()->name}}</h4>
                                                            <p class="text-muted">{{Auth::user()->email}}</p><a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                                        </div>
                                                    </li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="#"><i class="ti-settings"></i> Account Settings</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('form1').submit();"><i class="fa fa-power-off"></i> Logout</a></li>
                                                    <form id="form1" action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </header>
                        <!-- ============================================================== -->
                        <!-- End Topbar header -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Left Sidebar - style you can find in sidebar.scss  -->
                        <!-- ============================================================== -->
                        <aside class="left-sidebar">
                            <!-- Sidebar scroll-->
                            <div class="scroll-sidebar">
                                <!-- Sidebar navigation-->
                                <nav class="sidebar-nav">
                                    <ul id="sidebarnav">
                                        <li> <a class="has-arrow waves-effect waves-dark" href="{{url('home')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a></li>

                                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Master</span></a>
                                            <ul aria-expanded="false" class="collapse">
                                                <li><a href="{{url('kabupaten')}}">Kabupaten </a></li>
                                                <li><a href="{{url('kecamatan')}}">Kecamatan</a></li>
                                                <li><a href="{{url('desa')}}">Desa</a></li>
                                            </ul>
                                        </li>

                                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu">Metode
                                        </span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="{{url('kriteria')}}">Kriteria</a></li>
                                            <li><a href="{{url('subkriteria')}}">Sub Kriteria</a></li>
                                            <li><a href="{{url('alternatif')}}">Alternatif</a></li>
                                        </ul>
                                    </li>

                                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">User</span></a></li>

                                </ul>
                            </nav>
                            <!-- End Sidebar navigation -->
                        </div>
                        <!-- End Sidebar scroll-->
                    </aside>
                    <!-- ============================================================== -->
                    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Page wrapper  -->
                    <!-- ============================================================== -->
                    <div class="page-wrapper">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block" style="margin: 10px;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif


                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block" style="margin: 10px;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif


                        @if ($message = Session::get('warning'))
                        <div class="alert alert-warning alert-block" style="margin: 10px;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif


                        @if ($message = Session::get('info'))
                        <div class="alert alert-info alert-block" style="margin: 10px;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif


                        @if ($errors->any())
                        <div class="alert alert-danger" style="margin: 10px;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            Please check the form below for errors
                        </div>
                        @endif
                        <!-- ============================================================== -->
                        <!-- Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->
                        <div class="row page-titles">
                            @yield('breadcrumb')
                        </div>

                        <!-- Container fluid  -->
                        <!-- ============================================================== -->
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Container fluid  -->
                    <!-- ============================================================== -->

                    <footer class="footer"> © 2019 Moh Sofyan Saury </footer>
                    <!-- ============================================================== -->
                    <!-- End footer -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Page wrapper  -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Wrapper -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- All Jquery -->
            <!-- ============================================================== -->
            <script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>
            <!-- Bootstrap tether Core JavaScript -->
            <script src="{{url('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
            <script src="{{url('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
            <!-- slimscrollbar scrollbar JavaScript -->
            <script src="{{url('assets/js/jquery.slimscroll.js')}}"></script>
            <!--Wave Effects -->
            <script src="{{url('assets/js/waves.js')}}"></script>
            <!--Menu sidebar -->
            <script src="{{url('assets/js/sidebarmenu.js')}}"></script>
            <!--stickey kit -->
            <script src="{{url('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
            <!--Custom JavaScript -->
            <script src="{{url('assets/js/custom.min.js')}}"></script>
            <!-- ============================================================== -->
            <!-- This page plugins -->
            <!-- ============================================================== -->
            <!--sparkline JavaScript -->
            <script src="{{url('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
            <!--morris JavaScript -->
            <script src="{{url('assets/plugins/raphael/raphael-min.js')}}"></script>
            <script src="{{url('assets/plugins/morrisjs/morris.min.js')}}"></script>
            <!-- Chart JS -->
            <script src="{{url('assets/js/dashboard1.js')}}"></script>
            <!-- This is data table -->
            <script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
            <!-- ============================================================== -->
            <script src="{{url('assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
            <script src="{{url('https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>
            <script src="{{url('https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>
            <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')}}"></script>
            <script src="{{url('https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js')}}"></script>
            <script src="{{url('https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js')}}"></script>
            <script src="{{url('https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')}}"></script>
            <script src="{{url('https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js')}}"></script>

            <!-- end - This is for export functionality only -->
            <script>
                $(document).ready(function() {
                    $('#myTable').DataTable();
                    $(document).ready(function() {
                        var table = $('#example').DataTable({
                            "columnDefs": [{
                                "visible": false,
                                "targets": 2
                            }],
                            "order": [
                            [2, 'asc']
                            ],
                            "displayLength": 25,
                            "drawCallback": function(settings) {
                                var api = this.api();
                                var rows = api.rows({
                                    page: 'current'
                                }).nodes();
                                var last = null;
                                api.column(2, {
                                    page: 'current'
                                }).data().each(function(group, i) {
                                    if (last !== group) {
                                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                        last = group;
                                    }
                                });
                            }
                        });
                        // Order by the grouping
                        $('#example tbody').on('click', 'tr.group', function() {
                            var currentOrder = table.order()[0];
                            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                                table.order([2, 'desc']).draw();
                            } else {
                                table.order([2, 'asc']).draw();
                            }
                        });
                    });
                });
                $('#example23').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            </script>
            <!-- ============================================================== -->
            <!-- Style switcher -->
            <!-- ============================================================== -->
            <script src="{{url('assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
        </body>
        </html>