<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-top modal-lg">
        <form action="{{url('/editPointCustomer')}}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Form Edit Point Customer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-body">
                            <h5 class="box-title">Edit Point</h5>
                            <hr class="m-t-0 m-b-40">
                            <input type="text" class="form-control" hidden readonly name="id_user" id="id_user">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Kode Customer</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly name="kode_cust" id="kode_cust">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Nama Customer</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly name="nm_cust" id="nm_cust">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Point Awal</label>
                                        <div class="col-md-8">
                                            <input type="number" id="point_awal" name="point_awal" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Point Akhir</label>
                                        <div class="col-md-8">
                                            <input type="number" id="point_akhir" name="point_akhir" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
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