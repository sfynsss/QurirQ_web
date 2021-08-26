@extends('layouts.app')

@section('content')

<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-between">
    <div class="nk-block-head-content">
      <h3 class="nk-block-title page-title">Selamat Datang di Web Admin LaRisso </h3>
      <div class="nk-block-des text-soft">
        <p>Kelola segala pengaturan untuk LaRisso Mobile Apps</p>
      </div>
    </div><!-- .nk-block-head-content -->
  </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
  <div class="nk-block">
      <div class="row g-gs">
          <div class="col-md-3">
              <div class="card card-bordered card-full">
                  <div class="card-inner">
                      <div class="card-title-group align-start mb-0">
                          <div class="card-title">
                              <h6 class="subtitle">Total Member Terdaftar</h6>
                          </div>
                          <div class="card-tools">
                              <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Seluruh Member Retail & Grosir"></em>
                          </div>
                      </div>
                      <div class="card-amount">
                          <span class="amount">{{$retail + $grosir}}<span class="currency currency-usd"> Member</span>
                          </span>
                      </div>
                      <div class="invest-data">
                          <div class="invest-data-amount g-2">
                              <div class="invest-data-history">
                                  <div class="title">Retail</div>
                                  <div class="amount">{{$retail}}</div>
                              </div>
                              <div class="invest-data-history">
                                  <div class="title">Grosir</div>
                                  <div class="amount">{{$grosir}}</div>
                              </div>
                          </div>
                          <div class="invest-data-ck">
                              <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                          </div>
                      </div>
                  </div>
              </div><!-- .card -->
          </div><!-- .col -->
          <div class="col-md-3">
              <div class="card card-bordered card-full">
                  <div class="card-inner">
                      <div class="card-title-group align-start mb-0">
                          <div class="card-title">
                              <h6 class="subtitle">Total Seluruh Barang</h6>
                          </div>
                          <div class="card-tools">
                              <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total barang di retail & grosir"></em>
                          </div>
                      </div>
                      <div class="card-amount">
                          <span class="amount">{{$barang}}<span class="currency currency-usd"> Item</span>
                          </span>
                      </div>
                      <div class="invest-data">
                          <div class="invest-data-amount g-2">
                              <div class="invest-data-history">
                                  <div class="title">Kategori</div>
                                  <div class="amount">{{$kategori}}</div>
                              </div>
                              <div class="invest-data-history">
                                  <div class="title">Outlet Aktif</div>
                                  <div class="amount">{{$outlet}}</div>
                              </div>
                          </div>
                          <div class="invest-data-ck">
                              <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                          </div>
                      </div>
                  </div>
              </div><!-- .card -->
          </div><!-- .col -->
                    <div class="col-md-6 ">
              <div class="card card-bordered  card-full">
                  <div class="card-inner">
                      <div class="card-title-group align-start mb-0">
                          <div class="card-title">
                              <h6 class="subtitle">Seluruh Transaksi</h6>
                          </div>
                          <div class="card-tools">
                              <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total transaksi di semua penjualan"></em>
                          </div>
                      </div>
                      <div class="card-amount">
                          <span class="amount">@currency($total_retail + $total_grosir)</span>
                      </div>
                      <div class="invest-data">
                          <div class="invest-data-amount g-2">
                              <div class="invest-data-history">
                                  <div class="title">Retail</div>
                                  <span class="amount">@currency($total_retail)</span>
                              </div>
                              <div class="invest-data-history">
                                  <div class="title">Grosir</div>
                                   <span class="amount">@currency($total_grosir)</span>
                              </div>
                              <!-- <div class="invest-data-history">
                                  <div class="title">Offline</div>
                                   <span class="amount">@currency($total_offline)</span>
                              </div> -->
                          </div>
                          <div class="invest-data-ck">
                              <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                          </div>
                      </div>
                  </div>
              </div><!-- .card -->
          </div><!-- .col -->
      </div>
  </div>

@endsection
