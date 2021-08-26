<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-top modal-lg">
        <form action="{{url('/inputPenawaran')}}" id="link_url" name="link_url" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Form Penawaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-body">
                             <input type="text" name="id_penawaran" id="id_penawaran" hidden>
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="form-label" for="default-01">Nama Penawaran</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" required id="penawaran" name="penawaran">
                                  </div>
                              </div>
                          </div>
                          <!--/span-->
                          <div class="col-md-6">
                            <div class="form-group row">
                                <label class="form-label" for="default-01">Gambar</label>
                                <div class="form-control-wrap">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="gambar_penawaran" accept=".jpg, .jpeg, .png">
                                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
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
            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success waves-effect text-left">Submit</button>
        </div>
    </div>
</form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>