<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/tambahVoucher')}}" method="post" class="form-horizontal">
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
                                        <label class="control-label text-left col-md-4">Kode Voucher</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="kode_voucher" id="kode_voucher" required maxlength="6" style="text-transform:uppercase">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-primary waves-effect text-left" style="margin-bottom: 20px;" onclick="setNama();">Generate Kode</button>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <input type="number" class="form-control" required name="banyak" id="banyak" min="1" max="100" value="1">
                                        </div> --}}
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Nilai Voucher</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" required min="0" name="nilai_voucher" id="nilai_voucher">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Nama Voucher</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" required name="nama_voucher" id="nama_voucher">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Tanggal Mulai</label>
                                        <div class="col-md-8">
                                            <input type="date" class="form-control" required name="tgl_start" id="tgl_start" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Tanggal Berakhir</label>
                                        <div class="col-md-8">
                                            <input type="date" class="form-control" required name="tgl_end" id="tgl_end" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label text-left">Syarat Dan Ketentuan</label>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="sk" id="sk"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label text-left">Pilih Target</label>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <select id="user" name="user[]" multiple style="width: 100%;">
                                                <option value="semua">Semua</option>
                                                @foreach($user as $user)
                                                <option value="{{$user->KD_CUST}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                                    {{-- <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label text-left col-md-4">Jenis Voucher</label>
                                                <div class="col-md-8">
                                                    <select id="jenis_vouhcer" name="jenis_vouhcer" class="form-control custom-select">
                                                        <option style="display: none;">Select an Option</option>
                                                        <option value="">GIFT VOUCHER</option>
                                                        <option value="">GIFT CARD</option>
                                                    </select>
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