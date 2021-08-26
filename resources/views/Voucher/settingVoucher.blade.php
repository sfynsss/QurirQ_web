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
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"  data-target=".bs-example-modal-lg">TAMBAH DATA</button>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->


    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form action="{{url('/tambahSettingVoucher')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Form Voucher</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-4">Nama Voucher</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="nama_voucher" id="nama_voucher">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-4">Nilai Voucher</label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control" name="nilai_voucher" id="nilai_voucher">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-4">Ketentuan Poin</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="ketentuan" id="ketentuan">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-4">Masa Berlaku</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="masa_berlaku" id="masa_berlaku">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-12">
                                    {{-- <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="gambar" id="gambar" accept="image/*">
                                    </div> --}}
                                    <div class="form-control-wrap">
                                        <label>Gambar</label>
                                        <div class="custom-file">
                                            <input type="file" name="gambar" id="gambar" accept="image/*" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <br>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Syarat & Ketentuan</label>
                                        <textarea class="form-control" name="sk" id="sk"></textarea>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect text-left">Submit</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="card card-bordered card-preview">
    <table class="table table-orders">
      <thead class="thead">
        <tr>
            <th>No</th>
            <th>Nama Voucher</th>
            <th>Gambar</th>
            <th>Nilai Voucher</th>
            <th>Ketentuan Poin</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php($i = 1)
        @foreach($data as $data)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$data->nama_voucher}}</td>
            <td><img class="logo-data" src="{{asset('storage')}}/{{$data->gambar_voucher}}"  width="300" height="100"></td>
            <td>{{$data->nilai_voucher}}</td>
            <td>{{$data->ketentuan}}</td>
            <td>
                <button type="submit" class="btn btn-warning waves-effect text-left">UBAH</i></button>
                <button type="submit" class="btn btn-danger waves-effect text-left">HAPUS</i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>

@endsection

@section('script')
<script>

</script>
@endsection