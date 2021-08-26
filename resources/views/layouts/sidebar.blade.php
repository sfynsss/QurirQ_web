<!-- sidebar menu -->
<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{url('/')}}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{url('images/LarissoApps.png')}}" srcset="./images/logo2x.png 2x" alt="logo">
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
                            <span class="nk-menu-icon"><em class="icon ni ni-elementor"></em></span>
                            <span class="nk-menu-text">Barang</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('kategori_barang')}}" class="nk-menu-link"><span class="nk-menu-text">Kategori</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('barang')}}" class="nk-menu-link"><span class="nk-menu-text">Barang</span></a>
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
                                <a href="{{url('outlet')}}" class="nk-menu-link"><span class="nk-menu-text">Outlet</span></a>
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
                            <li class="nk-menu-item">
                                <a href="{{url('customerGrosir')}}" class="nk-menu-link"><span class="nk-menu-text">Customer Grosir</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="nk-menu-item has-sub">
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
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">Users</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('user/admin/')}}/{{Auth::user()->kd_outlet}}" class="nk-menu-link"><span class="nk-menu-text">Admin</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('user/sales/all')}}" class="nk-menu-link"><span class="nk-menu-text">Sales</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Transaksi</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-wallet-out"></em></span>
                            <span class="nk-menu-text">Penjualan</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('penjualan')}}" class="nk-menu-link"><span class="nk-menu-text">Semua Penjualan</span></a>
                            </li>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('orderPenjualan')}}" class="nk-menu-link"><span class="nk-menu-text">Order Penjualan</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('laporanPenjualan')}}" class="nk-menu-link"><span class="nk-menu-text">Laporan Penjualan</span></a>
                            </li>
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
                                <a href="{{url('gambarPromo')}}" class="nk-menu-link"><span class="nk-menu-text">Gambar Promo</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('promo')}}" class="nk-menu-link"><span class="nk-menu-text">Periode Promo</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-bell-fill"></em></span>
                            <span class="nk-menu-text">Notifikasi</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('notification')}}" class="nk-menu-link"><span class="nk-menu-text">Notifikasi</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-send"></em></span>
                            <span class="nk-menu-text">Ongkir COD</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('ongkircod')}}" class="nk-menu-link"><span class="nk-menu-text">Ongkir COD</span></a>
                            </li>
                        </ul>
                    </li>


                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
<!-- /sidebar menu -->