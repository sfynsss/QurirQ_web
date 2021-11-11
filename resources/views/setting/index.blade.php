@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Setting Komisi</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".modal_input" onclick="setKomisi();">Tambah</button> 
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    
    <div class="modal fade modal_input" id="modalku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form action="{{url('/tambahKomisi')}}" method="post" id="link_url" name="link_url" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Komisi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-inner">
                            <input type="text" name="id_komisi" id="id_komisi" hidden>
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-6">Komisi Outlet (%)</label>
                                        <div class="col-md-6">
                                            <input type="number" min="0" class="form-control" required name="komisi_outlet" id="komisi_outlet">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-6">Komisi Qurir (%)</label>
                                        <div class="col-md-6">
                                            <input type="number" min="0" class="form-control" required name="komisi_qurir" id="komisi_qurir">
                                        </div>
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
                <th>Komisi dari Outlet</th>
                <th>Komisi dari Qurir</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="tb-odr-body">
            @php($i = 1)
            @foreach($data as $data)
            <tr class="tb-odr-item">
                <td>{{$i++}}</td>
                <td>{{$data->komisi_outlet}} %</td>
                <td>{{$data->komisi_qurir}} %</td>
                <td>
                    <button type="submit" class="btn btn-warning" data-toggle="modal" data-target=".modal_input" onclick="updateKomisi('{{$data->id}}', '{{$data->komisi_outlet}}','{{$data->komisi_qurir}}');">Ubah</button>
                    <a href="/deleteKomisi/{{ $data->id }}" class="btn btn-danger" onclick="if (confirm('Hapus Item Terpilih?')){return true;}else{event.stopPropagation(); event.preventDefault();};">Hapus</a>
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
    function setKomisi() {
        $("#komisi_outlet").val("");
        $("#komisi_qurir").val("");
    }
    
    function updateKomisi($a, $b, $c) {
        $('#link_url').attr('action', '{{url('/updateKomisi')}}');
        $("#id_komisi").val($a);
        $("#komisi_outlet").val($b);
        $("#komisi_qurir").val($c);
    }
</script>
@endsection