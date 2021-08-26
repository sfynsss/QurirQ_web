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
                            <h3 class="nk-block-title page-title">Record Penggantian Point</h3>
                        </div>
                    </div>
                </div>
                <div class="card card-bordered card-preview">
                    <table class="table table-tranx">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-info"><span>No</span></th>
                                <th class="tb-tnx-info"><span>User Pengubah</span></th>
                                <th class="tb-tnx-info"><span>KD Customer</span></th>
                                <th class="tb-tnx-info"><span>Nama Customer</span></th>
                                <th class="tb-tnx-info"><span>Tanggal</span></th>
                                <th class="tb-tnx-info"><span>Point Awal</span></th>
                                <th class="tb-tnx-info"><span>Point Perubahan</span></th>
                                <th class="tb-tnx-info"><span>Point Akhir</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($data as $v_data)
                            <tr class="tb-tnx-item">
                                <td class="tb-tnx-info">
                                    <a href="#"><span>{{$i++}}</span></a>
                                </td>
                                <td class="tb-tnx-info"><span>{{$v_data->nm_user}}</span></td>
                                <td class="tb-tnx-info"><span>{{$v_data->kd_cust}}</span></td>
                                <td class="tb-tnx-info"><span>{{$v_data->nm_cust}}</span></td>
                                <td class="tb-tnx-info"><span>{{$v_data->tanggal}}</span></td>
                                <td class="tb-tnx-info"><span>{{$v_data->point_awal}}</span></td>
                                @if($v_data->point_akhir - $v_data->point_awal >= 0)
                                <td class="tb-tnx-info"><span class="badge badge-dot badge-dot-xs badge-success">+{{$v_data->point_akhir - $v_data->point_awal}}</span></td>
                                @else
                                <td class="tb-tnx-info"><span class="badge badge-dot badge-dot-xs badge-success">{{$v_data->point_akhir - $v_data->point_awal}}</span></td>
                                @endif
                                <td class="tb-tnx-info"><span style="font-weight:bold">{{$v_data->point_akhir}}</span></td>
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
