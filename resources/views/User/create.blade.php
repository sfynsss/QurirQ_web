<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-top modal-lg">
        @if($status == "admin")
        <form action="{{url('/tambahUser/admin')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
            @elseif($status == "driver")
            <form action="{{url('/tambahUser/driver')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @elseif($status == "resto")
                <form action="{{url('/tambahUser/resto')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @endif
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Form User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-body">
                                    @if($status == "resto")
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-2">Outlet</label>
                                                <div class="col-md-10">
                                                    <select class="form-select" name="id_outlet" id="id_outlet">
                                                        <option disabled="true" selected="none">Pilih Salah Satu</option>
                                                        @foreach($outlet as $outlet)
                                                        <option value="{{$outlet->id}}">{{$outlet->nama_outlet}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-4">Nama / Username</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-4">email</label>
                                                <div class="col-md-8">
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-4">Tgl Lahir</label>
                                                <div class="col-md-8">
                                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-4">No Telp</label>
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control" name="no_telp" id="no_telp">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-4">Alamat</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="alamat" id="alamat">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-4">Password</label>
                                                <div class="col-md-8">
                                                    <input type="password" class="form-control" name="password" id="password">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>

                                    @if ($status == "driver")
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-4">Nopol Kendaraan</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="nopol" id="nopol">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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