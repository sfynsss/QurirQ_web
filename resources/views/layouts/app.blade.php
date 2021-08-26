<!DOCTYPE html>
<html lang="zxx" class="js">

<head id="not-print">
    <base href="{{url('/')}}">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@@page-discription">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{url('images/favicon.png')}}">
    <!-- Page Title  -->
    <title>Larisso Admin</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{url('/assets/css/dashlite.css?ver=1.4.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{url('assets/css/theme.css?ver=1.4.0')}}">

</head>

<body class="nk-body bg-lighter npc-general has-sidebar">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">

            @include('layouts.sidebar')

            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/crypto/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="{{url('images/LarissoApps.png')}}" alt="logo">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">{{Auth::user()->otoritas}}</div>
                                                    <div class="user-name dropdown-indicator">{{Auth::user()->name}}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{Auth::user()->name}}</span>
                                                        <span class="sub-text">{{Auth::user()->email}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a onclick="event.preventDefault(); document.getElementById('form1').submit();"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                    <form id="form1" action="{{ route('logout') }}" method="post">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                    <li class="dropdown notification-dropdown mr-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                            <div class="icon-status icon-status-info">
                                                <em class="icon ni ni-bell"></em>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                                <a href="#">Mark All as Read</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">

                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="#">View All</a>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>

                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif

                                @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif

                                @if ($message = Session::get('warning'))
                                <div class="alert alert-warning alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif

                                @if ($message = Session::get('info'))
                                <div class="alert alert-info alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                    <strong>{{ $message }}</strong>
                                </div>
                                @endif
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-footer" id="not-print">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> 2020 Asa Mutiara Informa
                            </div>
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>

        </div>
    </div>
    <!-- wrap @e -->
</div>
<!-- main @e -->
</div>

<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{url('assets/js/bundle.js?ver=1.4.0')}}"></script>
<script src="{{url('assets/js/scripts.js?ver=1.4.0')}}"></script>
<script src="{{url('assets/js/charts/gd-general.js?ver=1.4.0')}}"></script>

<script>
    function setKategori($a, $b, $c, $d) {
        $('#kd_kategori_edit').val($a);
        $('#nm_kategori_edit').val($b);
        $('#status').select2('val', $c);
        $("#kd_outlet").val($d).trigger('change');
    }

</script>
@yield('script')
</body>

</html>