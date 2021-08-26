<!-- Large modal -->
<div class="modal fade modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top modal-lg">
    <div class="modal-content">
      <form method="post" action="{{url('barang/edit_barang')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row gy-4">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Kode Barang</label>
                <div class="form-control-wrap">
                  <input type="text" class="form-control" readonly="true" id="kd_brg_edit" name="kd_brg_edit">
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Nama Barang</label>
                <div class="form-control-wrap">
                  <input type="text" class="form-control" id="nm_brg_edit" name="nm_brg_edit">
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Harga Jual</label>
                <div class="form-control-wrap">
                  <input type="number" class="form-control" id="hrg_brg_edit" name="hrg_brg_edit">
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Kategori Barang</label>
                <div class="form-control-wrap">
                  <select class="form-select" name="kat_barang" id="kat_barang">
                    <option disabled="true" selected="none">Pilih Salah Satu</option>
                    @foreach($kat_barang as $kat_android)
                    <option value="{{$kat_android->kd_kat_android}}">{{$kat_android->nm_kat_android}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Gambar Barang</label>
                <div class="form-control-wrap">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="gambar_barang" accept=".jpg, .jpeg, .png">
                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                    <p>*ukuran file maksimal 200kb</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Diskon</label>
                <div class="form-control-wrap">
                  <input type="number" class="form-control" id="disc_brg_edit" name="disc_brg_edit" max="100">
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Harga Diskon</label>
                <div class="form-control-wrap">
                  <input type="number" class="form-control" id="harga_disc_brg_edit" name="harga_disc_brg_edit">
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Berat Barang (gram)</label>
                <div class="form-control-wrap">
                  <input type="number" class="form-control" id="berat_edit" name="berat_edit" min="1" max="10000">
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Volume (m3)</label>
                <div class="form-control-wrap">
                  <input type="number" class="form-control" id="volume_edit" name="volume_edit" min="1" max="10000">
                </div>
              </div>
            </div>
          </div>
          <br>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>