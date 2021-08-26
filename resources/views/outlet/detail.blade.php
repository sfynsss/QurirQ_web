@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Outlet {{$nama_outlet->nama_outlet}}</h3>
            </div><!-- .nk-block-head-content -->
            {{-- <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".modal_input" onclick="setKodeOutlet();">Tambah</button> 
                </div>
            </div> --}}<!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="modal fade modal_input" id="modalku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form action="{{url('/tambahKategoriOutlet')}}" method="post" id="link_url" name="link_url" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Form Kategori Outlet</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-inner">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name-1">Kode Outlet</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="kd_outlet" name="kd_outlet" readonly value="{{$nama_outlet->kd_outlet}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Status Aktif</label>
                                        <ul class="custom-control-group g-3 align-center">
                                            <li>
                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="status" name="status" value="1">
                                                    <label class="custom-control-label" for="status">Aktif</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name-1">Pilih Kategori</label>
                                        <div class="form-control-wrap">
                                            <select id="kategori" name="kategori[]" multiple style="width: 100%;">
                                                <option value="semua">Semua</option>
                                                @foreach($kategori as $kategori)
                                                <option value="{{$kategori->kd_kat_android}}">{{$kategori->nm_kat_android}}</option>
                                                @endforeach
                                            </select>
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
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xl-4">
                <div class="row g-gs">
                    <div class="col-lg-6 col-xl-12">
                        <div class="card card-bordered card-full">
                            <div class="card-inner">
                                <div class="nk-cov-wg1">
                                    <div class="nk-refwg-head g-3">
                                        <div class="nk-refwg-title">
                                            <h5 class="title">Data Kategori Outlet</h5>
                                            {{-- <div class="title-sub">Use the bellow link to invite your friends.</div> --}}
                                        </div>
                                        <div class="nk-refwg-action">
                                            <button class="btn btn-primary" data-toggle="modal" data-target=".modal_input" onclick="setKodeOutlet();">Tambah</button> 
                                        </div>
                                    </div>
                                    <table class="table table-orders">
                                        <thead class="tb-odr-head">
                                            <tr class="tb-odr-item">
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tb-odr-body">
                                            @php($i = 1)
                                            @foreach($data as $data)
                                            <tr class="tb-odr-item">
                                                <td>{{$i++}}</td>
                                                <td>{{$data->nm_kat_android}}</td>
                                                @if($data->status == 1)
                                                <td>Aktif</td>
                                                @else
                                                <td>Tidak Aktif</td>
                                                @endif
                                                <td>
                                                    <button type="submit" class="btn btn-warning" data-toggle="modal" data-target=".modal_input" onclick="ubahKategori('{{$nama_outlet->kd_outlet}}', '{{$data->kd_kat_android}}', '{{$data->status}}');">Ubah</button>
                                                    <a href="{{url('deleteKategoriOutlet/')}}/{{$data->nmr}}" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><button type="submit" class="btn btn-danger">Hapus</button></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->
                </div>
            </div>
        </div>
    </div>

</div><!-- nk-block -->

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("#kategori").select2();
    });

    function setKodeOutlet() {
        $("#nama_outlet").val("");
        $("#keterangan").val("");
        $('#status').removeAttr('checked');
    }

    function ubahKategori($a, $b, $c) {
        $('#link_url').attr('action', '{{url('/ubahKategoriOutlet')}}');
        $("#kd_outlet").val($a);
         $("#kategori").select2().val($b).trigger('change.select2');
        $("#keterangan").val($c);
        if ($c == 1) {
            $('#status').attr('checked', 'checked');
        } else {
            $('#status').removeAttr('checked');
        }
    }

    // function alert($kd_outlet) {
    //     var checkstr =  confirm('Apakah Anda yakin untuk menghapus?');
    //     if(checkstr == true){
    //         $.ajax({
    //             type:'GET',
    //             url:'/deleteOutlet/{$kd_outlet}',
    //             success:function(){
    //                 location.reload();
    //             }
    //         });       
    //     }else{
    //         return false;
    //     }
    // }
</script>
@endsection