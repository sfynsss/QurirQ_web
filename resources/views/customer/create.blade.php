<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-top modal-lg">
        <form action="{{url('/tambahCustomer')}}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Form Tambah Customer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-body">
                            <h5 class="box-title">Master Customer</h5>
                            <hr class="m-t-0 m-b-40">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Kode Customer</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly name="kode_cust" id="kode_cust">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-warning row">
                                        <label class="control-label text-left col-md-4">Kategori</label>
                                        <div class="col-md-8">
                                            <select id="kategori" name="kategori" class="form-control custom-select">
                                                <option style="display: none;">Select an Option</option>
                                                <option value="RETAIL">Retail</option>
                                                <option value="GROSIR">Grosir</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <br>

                            <h5 class="box-title">Customer Info</h5>
                            <hr class="m-t-0 m-b-40">
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Nama</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Alamat</label>
                                        <div class="col-md-8">
                                            <input type="text" id="alamat" name="alamat" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Tgl Lahir</label>
                                        <div class="col-md-8">
                                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">No Telp / Hp</label>
                                        <div class="col-md-8">
                                            <input type="text" id="no_telp" name="no_telp" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Jenis Kelamin</label>
                                        <div class="col-md-8">
                                            <select name="jenis_kelamin" class="form-control custom-select">
                                                <option value="Laki-laki">Laki - Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <h5 class="box-title">Detail Customer</h5>
                            <hr class="m-t-0 m-b-40">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Email</label>
                                        <div class="col-md-8">
                                            <input type="Email" id="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                {{-- <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Kredit Limit</label>
                                        <div class="col-md-8">
                                            <input type="number" id="kredit_limit" name="kredit_limit" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--/span--> --}}
                            </div>
                            {{-- <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">TOP (Termin)</label>
                                        <div class="col-md-8">
                                            <input type="number" id="top" name="top" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row--> --}}
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