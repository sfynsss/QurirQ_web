<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-top modal-lg">
        <form action="{{url('/editCustomer')}}" method="post" class="form-horizontal">
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
                            <input type="text" class="form-control" hidden readonly name="id_user" id="id_user">
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
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Email</label>
                                        <div class="col-md-8">
                                            <input type="Email" id="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-left col-md-4">Password</label>
                                        <div class="col-md-8">
                                            <input type="Password" id="password" name="password" class="form-control">
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