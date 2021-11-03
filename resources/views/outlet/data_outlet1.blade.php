@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Master Outlet</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    
    <div class="card card-bordered card-preview">
        <table class="table table-orders">
            <thead class="tb-odr-head">
                <tr class="tb-odr-item">
                    <th>No</th>
                    <th>Nama Outlet</th>
                    <th>Keterangan</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Gambar Outlet</th>
                </tr>
            </thead>
            <tbody class="tb-odr-body">
                @foreach($data as $i => $data)
                <tr class="tb-odr-item">
                    <td>{{$i+1}}</td>
                    <td>{{$data->nama_outlet}}</td>
                    <td>{{$data->keterangan}}</td>
                    <td>{{$data->alamat}}</td>
                    @if($data->status == 1)
                    <td>Aktif</td>
                    @else
                    <td>Tidak Aktif</td>
                    @endif
                    <td>
                        @if($data->gambar_outlet == "")
                        <span class="badge badge-danger">Data Kosong</span>
                        @else
                        <img src="{{asset('storage')}}/{{$data->gambar_outlet}}" width="100" height="100">
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- .card-preview -->
</div><!-- nk-block -->

@endsection