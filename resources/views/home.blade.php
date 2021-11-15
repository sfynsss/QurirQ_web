@extends('layouts.app')

@section('content')

<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Selamat Datang di Web Admin QurirQ </h3>
            <div class="nk-block-des text-soft">
                <p>Kelola segala pengaturan untuk QurirQ Mobile Apps</p>
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
                            <h6 class="subtitle">Customer Terdaftar</h6>
                        </div>
                        <div class="card-tools">
                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Seluruh Member Retail & Grosir"></em>
                        </div>
                    </div>
                    <div class="card-amount">
                        <span class="amount"><span class="currency currency-usd"> Member</span>
                    </span>
                </div>
                <div class="invest-data">
                    <div class="invest-data-amount g-2">
                        <div class="invest-data-history">
                            <div class="title">Total</div>
                            <div class="amount">100</div>
                        </div>
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
