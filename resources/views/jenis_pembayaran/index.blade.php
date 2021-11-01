@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Jenis Pembayaran</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".modal_input" onclick="setJenisPembayaran();">Tambah</button> 
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    
    <div class="modal fade modal_input" id="modalku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form action="{{url('/inputJenisPembayaran')}}" method="post" id="link_url" name="link_url" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Jenis Pembayaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-inner">
                            <input type="text" name="id_jenis" id="id_jenis" hidden>
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label text-left col-md-6">Status Aktif</label>
                                        <div class="col-md-12">
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
                                    <div class="form-group">
                                        <label class="control-label text-left col-md-6">Nama Bank</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" required name="nama_bank" id="nama_bank">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label text-left col-md-6">No Rekening</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" required name="no_rekening" id="no_rekening">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label text-left col-md-6">Keterangan</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" required name="keterangan" id="keterangan">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label text-left col-md-6">Gambar Bank</label>
                                        <div class="col-md-12">
                                            <div class="form-control-wrap">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile" name="gambar_bank" accept=".jpg, .jpeg, .png">
                                                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                                    <p>*ukuran file maksimal 100kb</p>
                                                </div>
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
                <th>Gambar</th>
                <th>Nama Bank</th>
                <th>No Rekening</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="tb-odr-body">
            @php($i = 1)
            @foreach($data as $data)
            <tr class="tb-odr-item">
                <td>{{$i++}}</td>
                <td>
                    <img src="{{asset('storage')}}/{{$data->gambar_bank}}" width="100" height="100">
                </td>
                <td>{{$data->nama_bank}}</td>
                <td>{{$data->no_rekening}}</td>
                <td>{{$data->keterangan}}</td>
                <td> 
                    @if($data->sts_aktif == 1)
                    <span class="amount">Aktif</span>
                    @elseif($data->sts_aktif == 0)
                    <span class="amount">Non-Aktif</span>
                    @endif
                </td>
                <td>
                    <button type="submit" class="btn btn-warning" data-toggle="modal" data-target=".modal_input" onclick="updateJenisPembayaran('{{$data->id}}', '{{$data->sts_aktif}}', '{{$data->nama_bank}}', '{{$data->no_rekening}}', '{{$data->keterangan}}');">Ubah</button>
                    <a href="/deleteJenisPembayaran/{{ $data->id }}" class="btn btn-danger" onclick="if (confirm('Hapus Item Terpilih?')){return true;}else{event.stopPropagation(); event.preventDefault();};">Hapus</a>
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
    function setJenisPembayaran() {
        $("#sts_aktif").val("");
        $("#nama_bank").val("");
        $("#no_rekening").val("");
        $("#keterangan").val("");
    }
    
    function updateJenisPembayaran($a, $b, $c, $d, $e) {
        $('#link_url').attr('action', '{{url('/updateJenisPembayaran')}}');
        $("#id_jenis").val($a);
        $("#sts_aktif").val($b);
        $("#nama_bank").val($c);
        $("#no_rekening").val($d);
        $("#keterangan").val($e);
    }
    
    var uploadField = document.getElementById("customFile");
    
    uploadField.onchange = function() {
        if(this.files[0].size > 100000){
            alert("File is too big!");
            this.value = "";
        };
    };
</script>
@endsection