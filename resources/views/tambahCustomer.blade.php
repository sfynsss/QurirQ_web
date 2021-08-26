@extends('layouts.attr')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Form Tambah Customer</h4>
            </div>
            <div class="card-body">
                <form action="#" method="post" class="form-horizontal">
                    <div class="form-body">
                        <h3 class="box-title">Master Customer</h3>
                        <hr class="m-t-0 m-b-40">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-warning row">
                                    <label class="control-label text-right col-md-3">Pilih Cabang</label>
                                    <div class="col-md-9">
                                        <select id="cabang" name="cabang" class="form-control custom-select">
                                            <option style="display: none;">Select an Option</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group has-warning row">
                                    <label class="control-label text-right col-md-3">Kategori</label>
                                    <div class="col-md-9">
                                        <select id="cabang" name="cabang" class="form-control custom-select">
                                            <option style="display: none;">Select an Option</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Kode Customer</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" readonly name="kode_cust" id="kode_cust">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">NIK</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nik" id="nik">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        
                        <h3 class="box-title">Customer Info</h3>
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Nama</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Alamat</label>
                                    <div class="col-md-9">
                                        <input type="text" id="alamat" name="alamat" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Tgl Lahir</label>
                                    <div class="col-md-9">
                                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Kota / Wilayah</label>
                                    <div class="col-md-9">
                                        <select id="kota" name="kota" class="form-control custom-select">
                                            <option style="display: none;">Select an Option</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">No Telp / Hp</label>
                                    <div class="col-md-9">
                                        <input type="text" id="no_telp" name="no_telp" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Jenis Kelamin</label>
                                    <div class="col-md-9">
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
                        <h3 class="box-title">Detail Customer</h3>
                        <hr class="m-t-0 m-b-40">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" id="no_telp" name="no_telp" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Kredit Limit</label>
                                    <div class="col-md-9">
                                        <input type="number" id="kredit_limit" name="kredit_limit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">TOP (Termin)</label>
                                    <div class="col-md-9">
                                        <input type="text" id="no_telp" name="no_telp" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <hr>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"> </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection