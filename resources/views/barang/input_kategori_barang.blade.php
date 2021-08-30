<!-- Large modal -->
<div class="modal fade modal_input" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top modal-lg">
    <div class="modal-content">
      <form method="post" id="link_url" action="{{route('simpan_kategori_barang')}}">
        {{ csrf_field() }}
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Tambah Kategori Barang</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row gy-4">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="form-label" for="default-01">Nama Kategori</label>
                <div class="form-control-wrap">
                  <input type="text" class="form-control" readonly hidden id="id_kategori" name="id_kategori">
                  <input type="text" class="form-control" id="nm_kategori" name="nm_kategori">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>