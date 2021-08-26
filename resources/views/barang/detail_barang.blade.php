@extends('layouts.app')

@section('content')

	<div class="card-inner">
        <div class="preview-block">
            <div class="card card-bordered card-preview">
            	<div class="card-inner card-inner-lg">
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">Detail Barang</h4>
                            </div>
                            <div class="nk-block-head-content align-self-start d-lg-none">
                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="nk-data data-list">
                            <div class="data-head">
                                <h6 class="overline-title">Informasi Barang</h6>
                            </div>
                            @foreach($data as $data)
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Kode Barang</span>
                                    <span class="data-value">{{$data->kd_brg}}</span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Nama Barang</span>
                                    <span class="data-value"><b>{{$data->nm_brg}}</b></span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Jenis Barang</span>
                                    <span class="data-value">{{$data->jns_brg}}</span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Kategori di Android</span>
                                    <span class="data-value">{{$data->nm_kat_android}}</span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Outlet di Android</span>
                                    @if($data->kd_outlet == "OU010001")
                                    	<span class="data-value">Larisso Ambulu</span>
                                    @elseif ($data->kd_outlet == "OU010002")
                                    	<span class="data-value">Larisso Bellio</span>
                                    @elseif ($data->kd_outlet == "OU010003")
                                    	<span class="data-value">Larisso Bahan Kue</span>
                                    @elseif ($data->kd_outlet == "OU010004")
                                    	<span class="data-value">Larisso Balung</span>
                                    @else
                                    	<span class="data-value">{{$data->kd_outlet}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Berat Barang</span>
                                    <span class="data-value">{{$data->berat}} gram</span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Volume</span>
                                    <span class="data-value">{{$data->volume}} m3</span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Harga Beli</span>
                                    <span class="badge badge-primary">@currency($data->harga_bl)</span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Harga Jual</span>
                                    <span class="badge badge-info">@currency($data->harga_jl)</span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Diskon</span>
                                    <span class="data-value">{{$data->disc}}%</span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Potongan Diskon</span>
                                    <span class="data-value">@currency($data->harga_disc)</span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Harga setelah diskon</span>
                                    <span class="badge badge-warning">@currency($data->harga_jl - $data->harga_disc)</span>
                                </div>
                            </div>
                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Gambar Barang</span>
                                    @if($data->gambar == "" or $data->gambar == "kosong")
										<span class="badge badge-danger">Gambar Kosong</span>
									@else
										<img src="{{asset('storage')}}/{{$data->gambar}}" width="100" height="100">
									@endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection