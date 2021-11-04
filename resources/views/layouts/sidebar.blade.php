<!-- sidebar menu -->
<div class="nk-sidebar nk-sidebar-fixed is-dark" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head" style="background-color:#00874D;">
        <div class="nk-sidebar-brand">
            <a href="{{url('/')}}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{url('assets/login/images/icons/logo_panjang.png')}}" srcset="./images/logo2x.png 2x" alt="logo">
                {{-- <img class="logo-dark logo-img" src="{{url('images/logo-dark.png')}}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                <span class="nio-version">General</span> --}}
            </a>
        </div>
        <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Master</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-list"></em></span>
                            <span class="nk-menu-text">Kategori Outlet</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('kategori_outlet') }}" class="nk-menu-link"><span class="nk-menu-text">Kategori Outlet</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item --><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-elementor"></em></span>
                            <span class="nk-menu-text">Barang</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('data_barang', 'all')}}" class="nk-menu-link"><span class="nk-menu-text">Barang</span></a>
                                <a href="{{route('kategori_barang')}}" class="nk-menu-link"><span class="nk-menu-text">Kategori Barang</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item --><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                            <span class="nk-menu-text">Outlet</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('data_outlet', 'all')}}" class="nk-menu-link"><span class="nk-menu-text">Outlet</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item --><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-list-fill"></em></span>
                            <span class="nk-menu-text">Customer</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('customer')}}" class="nk-menu-link"><span class="nk-menu-text">Customer</span></a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-cards-fill"></em></span>
                            <span class="nk-menu-text">Voucher</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('settingVoucher')}}" class="nk-menu-link"><span class="nk-menu-text">Setting Voucher</span></a>
                                <a href="{{url('voucherGlobal')}}" class="nk-menu-link"><span class="nk-menu-text">Voucher</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-coin-alt-fill"></em></span>
                            <span class="nk-menu-text">Point</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <a href="{{url('pointCustomer')}}" class="nk-menu-link"><span class="nk-menu-text">Perolehan Point</span></a>
                            <a href="{{url('settingPoint')}}" class="nk-menu-link"><span class="nk-menu-text">Setting Point</span></a>
                            <a href="{{url('recordPointEdit')}}" class="nk-menu-link"><span class="nk-menu-text">Record Perubahan Point</span></a>
                        </ul>
                    </li> --}}

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">Users</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('user/admin/')}}" class="nk-menu-link"><span class="nk-menu-text">Admin</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('user/driver')}}" class="nk-menu-link"><span class="nk-menu-text">Driver</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('user/resto')}}" class="nk-menu-link"><span class="nk-menu-text">Resto</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Transaksi</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-pie-alt"></em></span>
                            <span class="nk-menu-text">Q-Food</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('penjualan')}}" class="nk-menu-link"><span class="nk-menu-text">Penjualan</span></a>
                            </li>
                            {{-- <li class="nk-menu-item">
                                <a href="{{url('laporanPenjualan')}}" class="nk-menu-link"><span class="nk-menu-text">Laporan Penjualan</span></a>
                            </li> --}}
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-wallet-out"></em></span>
                            <span class="nk-menu-text">Q-Send</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('qsend')}}" class="nk-menu-link"><span class="nk-menu-text">Data Q-Send</span></a>
                            </li>
                            {{-- <li class="nk-menu-item">
                                <a href="{{url('laporanPenjualan')}}" class="nk-menu-link"><span class="nk-menu-text">Laporan Penjualan</span></a>
                            </li> --}}
                        </ul>
                    </li>


                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Setting</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                            <span class="nk-menu-text">Setting</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('penawaran')}}" class="nk-menu-link"><span class="nk-menu-text">Penawaran</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('penawaran_qsend')}}" class="nk-menu-link"><span class="nk-menu-text">Penawaran Q-Send</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('ongkirFood')}}" class="nk-menu-link"><span class="nk-menu-text">Ongkir Q-Food</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('ongkirSend')}}" class="nk-menu-link"><span class="nk-menu-text">Ongkir Q-Send</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                            <span class="nk-menu-text">Jenis Pembayaran</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('jenis_pembayaran')}}" class="nk-menu-link"><span class="nk-menu-text">Jenis Pembayaran</span></a>
                            </li>
                        </ul>
                    </li>

                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
<!-- /sidebar menu -->