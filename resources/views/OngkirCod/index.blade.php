@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Ongkir COD</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".modal_input" onclick="setOngkirCod();">Tambah</button> 
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="modal fade modal_input" id="modalku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form action="{{url('/tambahOngkirCod')}}" method="post" id="link_url" name="link_url" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Ongkir COD</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-inner">
                            <input type="text" name="id_ongkir" id="id_ongkir" hidden>
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-6">Status Aktif</label>
                                        <div class="col-md-6">
                                            <div class="form-control-wrap">
                                              <select class="form-select" required id="sts_aktif" name="sts_aktif">
                                                <option disabled="true" selected="none">Pilih Satu</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Non-Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-6">Harga per Kilometer</label>
                                    <div class="col-md-6">
                                        <input type="number" min="0" class="form-control" required name="harga_per_km" id="harga_per_km">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-6">Harga 2km Pertama</label>
                                    <div class="col-md-6">
                                        <input type="number" min="0" class="form-control" name="harga_awal" id="harga_awal" required >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-6">Harga per Kilogram</label>
                                    <div class="col-md-6">
                                        <input type="number" min="0" class="form-control" required name="harga_per_kg" id="harga_per_kg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left">Close</button>
                        <button type="submit" class="btn btn-success waves-effect text-left">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="card card-bordered card-preview">
    <table class="table table-orders">
        <thead class="tb-odr-head">
            <tr class="tb-odr-item">
                <th>No</th>
                <th>Harga Awal</th>
                <th>Harga per Km</th>
                <th>Harga per Kg</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="tb-odr-body">
            @php($i = 1)
            @foreach($data as $data)
            <tr class="tb-odr-item">
                <td>{{$i++}}</td>
                <td>Rp.{{$data->harga_awal}}</td>
                <td>Rp.{{$data->harga_per_km}}</td>
                <td>Rp.{{$data->harga_per_kg}}</td>
                <td> 
                    @if($data->sts_aktif == 1)
                    <span class="amount">Aktif</span>
                    @elseif($data->sts_aktif == 0)
                    <span class="amount">Non-Aktif</span>
                    @endif
                </td>
                <td>
                    <button type="submit" class="btn btn-warning" data-toggle="modal" data-target=".modal_input" onclick="updateOngkirCod('{{$data->id}}', '{{$data->sts_aktif}}','{{$data->harga_awal}}', '{{$data->harga_per_km}}', '{{$data->harga_per_kg}}');">Ubah</button>
                    <a href="/deleteOngkirCod/{{ $data->id }}" class="btn btn-danger" onclick="if (confirm('Hapus Item Terpilih?')){return true;}else{event.stopPropagation(); event.preventDefault();};">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div><!-- .card-preview -->
</div><!-- nk-block -->

@endsection

@section('script')
<script>
    function setOngkirCod() {
        $("#sts_aktif").val("");
        $("#harga_awal").val("");
        $("#harga_per_km").val("");
        $("#harga_per_kg").val("");
        $.ajax({
            type:'GET',
            url:'/api/getOngkirCOD',
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

    function updateOngkirCod($a, $b, $c, $d, $e) {
        $('#link_url').attr('action', '{{url('/updateOngkirCod')}}');
        $("#id_ongkir").val($a);
        $("#sts_aktif").val($b);
        $("#harga_awal").val($c);
        $("#harga_per_km").val($d);
        $("#harga_per_kg").val($e);
    }
</script>
@endsection