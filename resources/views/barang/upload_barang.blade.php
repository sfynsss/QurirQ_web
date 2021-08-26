<!-- Modal Content Code -->
<div class="modal fade modal_upload" tabindex="-1" id="modalDefault">
  <div class="modal-dialog modal-dialog-top modal-lg" role="document">
    <div class="modal-content">
      <form action="{{ url('barang/import') }}" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
          <em class="icon ni ni-cross"></em>
        </a>
        <div class="modal-header">
          <h5 class="modal-title">Upload Barang</h5>
        </div>
        <div class="modal-body">
          <input type="file" name="file_barang" id="file_barang" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
          <br>
          <br>
          <p>* untuk format file bisa diunduh <a href="{{url('assets/file/barang.xlsx')}}" style="color: blue;">disini</a>, jika bidang pendidikan maka pilih sheet pendidikan dan seterusnya</p>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>