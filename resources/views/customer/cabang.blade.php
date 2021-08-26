@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Perusahaan Cabang</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".modal_input">tambah</button> 
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="modal fade modal_input" id="modalku" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form action="{{url('/tambahCabang')}}" method="post" id="link_url" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Form Cabang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-4">Nama Cabang</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="nama_cabang" id="nama_cabang" required >
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="control-label text-left col-md-4">Alamat Cabang</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" required name="alamat_cabang" id="alamat_cabang">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal" onclick="clear();">Close</button>
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
            <thead class="tb-odr-head">
                <tr class="tb-odr-item">
                    <th>No</th>
                    <th>Nama Cabang</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tb-odr-body">
                @php($i = 1)
                @foreach($data as $data)
                <tr class="tb-odr-item">
                    <td>{{$i++}}</td>
                    <td>{{$data->cabang}}</td>
                    <td>{{$data->alamat_cabang}}</td>
                    <td class="tb-odr-action">
                        <div>
                            <a class="label label-warning m-r-10" href="" data-toggle="modal"  data-target=".bs-example-modal-lg" onclick="setIsi('{{$data->cabang}}', '{{$data->alamat_cabang}}')"><i class="mdi mdi-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- .card-preview -->
</div><!-- nk-block -->

@endsection