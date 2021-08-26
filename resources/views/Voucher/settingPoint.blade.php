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
            <form action="{{url('/tambahSettingPoint')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Form Setting Point</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-4">Ketentuan Minimal</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="ketentuan" id="ketentuan">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-4">Perolehan Point</label>
                                            <div class="col-md-8">
                                                <input type="number" class="form-control" name="nilai_point" id="nilai_point">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-control-wrap">
                                            <label>Jenis Aplikasi</label>
                                            <select class="form-select" required id="jenis_apps" name="jenis_apps">
                                                <option disabled="true" selected="none">Pilih Satu</option>
                                                <option value="RETAIL">RETAIL</option>
                                                <option value="GROSIR">GROSIR</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
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
                <th>Ketentuan Point</th>
                <th>Nilai Point</th>
                <th>Keterangan</th>
                <th>Jenis Apps</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php($i = 1)
            @foreach($data as $data)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$data->ketentuan}}</td>
                <td>{{$data->nilai_point}}</td>
                <td>{{$data->keterangan}}</td>
                <td>{{$data->jenis_apps}}</td>
                <td>
                    <button type="submit" class="btn btn-warning waves-effect text-left">UBAH</i></button>
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