<!-- Large modal -->
<div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top modal-lg">
    <form id="link_url" action="{{ route('simpan_barang', $outlet->id) }}" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
        {{csrf_field()}}
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row gy-4">         
            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Nama Barang</label>
                <div class="form-control-wrap">
                  <input type="text" class="form-control" id="id_brg" name="id_brg" readonly hidden>
                  <input type="text" class="form-control" id="nm_brg_edit" name="nm_brg_edit">
                </div>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Kategori Barang</label>
                <div class="form-control-wrap">
                  <select class="form-select" name="kat_barang" id="kat_barang">
                    <option disabled="true" selected="none">Pilih Salah Satu</option>
                    @foreach($kategori_barang as $kategori_barang)
                    <option value="{{$kategori_barang->id}}">{{$kategori_barang->nm_kategori_barang}}</option>
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
                <label class="form-label" for="default-01">HPP</label>
                <div class="form-control-wrap">
                  <input type="number" class="form-control" id="hpp" name="hpp">
                </div>
              </div>
            </div>
            
            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Margin (%)</label>
                <div class="form-control-wrap">
                  <input type="number" class="form-control" id="margin" name="margin">
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
                <label class="form-label" for="default-01">Diskon (%)</label>
                <div class="form-control-wrap">
                  <input type="number" class="form-control" required id="disc_brg_edit" name="disc_brg_edit" max="100">
                </div>
              </div>
            </div>
            
            <div class="col-sm-6">
              <div class="form-group">
                <label class="form-label" for="default-01">Harga Diskon</label>
                <div class="form-control-wrap">
                  <input type="number" class="form-control" required id="harga_disc_brg_edit" name="harga_disc_brg_edit">
                </div>
              </div>
            </div>
            <br>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>