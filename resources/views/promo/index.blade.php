@extends('layouts.app')

@section('content')

<div class="modal fade modal_input" id="modalku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/updatePromo')}}" method="post" id="link_url" name="link_url" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Ubah Promo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="card-inner">
                        <input type="text" name="id" id="id" hidden>
                        <div class="row gy-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Nama Promo</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="nama_promo" id="nama_promo" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gy-4">
                            <div class="col-6">
                                <div class="form-group">
                                <label class="form-label">Tanggal Mulai</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="tgl_mulai" id="tgl_mulai" required>
                                </div>
                                <div class="form-note">Format <code>yyyy-mm-dd</code></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label class="form-label">Tanggal Berakhir</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="tgl_akhir" id="tgl_akhir" required>
                                </div>
                                <div class="form-note">Format <code>yyyy-mm-dd</code></div>
                                </div>
                            </div>
                        </div>
{{--                         <div class="row gy-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Status Aktif</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select" required id="sts_aktif" name="sts_aktif">
                                                <option value="1" selected>Aktif</option>
                                                <option value="0">Non-Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left">Tutup</button>
                        <button type="submit" class="btn btn-success waves-effect text-left">Simpan</button>
                    </div>
                </div>
                </div>
        </form>
    </div>
</div>

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Pengaturan Periode Promo</h3>
                        </div>
                    </div>
                </div>
                <div class="card card-bordered card-preview">
                    <table class="table table-tranx">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-id"><span class="">No</span></th>
                                <th class="tb-tnx-info">
                                    <span class="tb-tnx-desc d-none d-sm-inline-block">
                                        <span>Nama Promo</span>
                                    </span>
                                    <span class="tb-tnx-date d-md-inline-block d-none">
                                        <span class="d-none d-md-block">
                                            <span>Tanggal Mulai</span>
                                            <span>Tanggal Berakhir</span>
                                        </span>
                                    </span>
                                </th>
                                <th class="tb-tnx-amount is-alt">
                                    {{-- <span class="tb-tnx-status d-none d-md-inline-block">Status</span> --}}
                                    <span class="tb-tnx-status d-none d-md-inline-block">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tb-tnx-item">
                                @php($i = 1)
                                @foreach($data as $v_data)
                                <td class="tb-tnx-id">
                                    <a href="#"><span>{{$i}}</span></a>
                                </td>
                                <td class="tb-tnx-info">
                                    <div class="tb-tnx-desc">
                                        <span class="title">{{$v_data->nama_promo}}</span>
                                    </div>
                                    <div class="tb-tnx-date">
                                        <span class="date">{{$v_data->tgl_mulai}}</span>
                                        <span class="date">{{$v_data->tgl_akhir}}</span>
                                    </div>
                                </td>
                                <td class="tb-tnx-amount is-alt">
                                    <!-- <div class="tb-tnx-desc">
                                        @if($v_data->sts_aktif == 1)
                                        <span class="badge badge-dot badge-success">Aktif</span>
                                        @elseif($v_data->sts_aktif == 0)
                                        <span class="badge badge-dot badge-danger">Tidak Aktif</span>
                                        @endif
                                    </div> -->
                                    <div class="tb-tnx-status">
                                    <button type="submit" class="btn btn-warning" data-toggle="modal" data-target=".modal_input" onclick="updatePromo('{{$v_data->nama_promo}}','{{$v_data->tgl_mulai}}', '{{$v_data->tgl_akhir}}');">Ubah Promo</button>
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="form-note">Barang berdiskon yang sebelum atau melewati masa promo, tidak dimunculkan di Apps</div>
            </div>
        </div>
    </div>

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Daftar Barang Diskon</h3>
                        </div>
                    </div>
                </div>
                <div class="card card-bordered card-preview">
                    <table class="table table-tranx">
                    <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-info"><span>No</span></th>
                                <th class="tb-tnx-info"><span>Kode Barang</span></th>
                                <th class="tb-tnx-info"><span>Nama Barang</span></th>
                                <th class="tb-tnx-info"><span>Kategori</span></th>
                                <th class="tb-tnx-info"><span>Diskon</span></th>
                                <th class="tb-tnx-info"><span>Harga Jual</span></th>
                                <th class="tb-tnx-info"><span>Harga Diskon</span></th>
                            </tr>
                    </thead>
                    <tbody class="tb-odr-body">
                        @php($j = 1)
                        @foreach($data2 as $v_data2)
                        <tr class="tb-odr-item">
                            <td>{{$j++}}</td>
                            <td class="tb-odr-info"><span class="tb-odr-id"><a href="#">{{$v_data2->kd_brg}}</a></span></td>
                            <td><span class="tb-odr-date">{{$v_data2->nm_brg}}</span></td>
                            <td><span class="tb-odr-date">{{$v_data2->nm_kat_android}}</span></td>
                            <td><span class="tb-odr-date">{{$v_data2->disc}}%</span></td>
                            <td><span class="tb-odr-status"><span class="badge badge-dot badge-success">@currency($v_data2->harga_jl)</span></span></td>
                            <td><span class="tb-odr-status"><span class="badge badge-dot badge-primary">@currency($v_data2->harga_jl - $v_data2->harga_disc)</span></span></td>					
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script>
    function setPromo() {
        $("#nama_promo").val("");
        $("#tgl_mulai").val("");
        $("#tgl_akhir").val("");
        $.ajax({
            type:'GET',
            url:'/api/getPromo',
            headers: {
                "Accept":"application/json",
                "Authorization":"Bearer {{Auth::user()->api_token}}"
            },
            success:function(data){
                $("input[name=id]").val(data);
            }
        });
        var uploadField = document.getElementById("customFile");
    }

    function updatePromo($a, $b, $c) {
        $('#link_url').attr('action', '{{url('/updatePromo')}}');
        $("#nama_promo").val($a);
        $("#tgl_mulai").val($b);
        $("#tgl_akhir").val($c);
    }
</script>
@endsection
