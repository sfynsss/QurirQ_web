@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Data Voucher Fisik</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button type="button" class="btn btn-primary float-right" style="margin-left: 10px;" data-toggle="modal"  data-target=".bs-example-modal-lg">TAMBAH DATA</button>
                    <button type="button" class="btn btn-success float-right" onclick="validasi();">VALIDASI</button>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

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
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" required name="banyak" id="banyak" min="1" max="100" value="1">
                                            </div>
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

        <div class="card card-bordered card-preview">
            <table id="myTable" class="table table-orders">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Voucher</th>
                        <th>Nama Voucher</th>
                        <th>Nilai</th>
                        <th>Tgl Berlaku</th>
                        <th>Tgl Berakhir</th>
                        <th>Status</th>
                        <th>
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="all" name="all" value="all" onchange="checkedAll(this);">
                              <label class="custom-control-label" for="all"></label>
                          </div>
                      </th>
                  </tr>
              </thead>
              <tbody>
                @php($i = 1)
                @foreach($data as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$data->kd_voucher}}</td>
                    <td>{{$data->nama_voucher}}</td>
                    <td>{{$data->nilai_voucher}}</td>
                    <td>{{$data->tgl_berlaku_1}}</td>
                    <td>{{$data->tgl_berlaku_2}}</td>
                    @if($data->status_voucher == 'NON-AKTIF')
                    <td><a class="label label-warning m-r-10" href="#"><span>NON-AKTIF</span></a></td>
                    @elseif($data->status_voucher == 'AKTIF')
                    <td><a class="label label-info m-r-10" href="#"><span>AKTIF</span></a></td>
                    @elseif($data->status_voucher == 'DIGUNAKAN')
                    <td><a class="label label-success m-r-10" href="#"><span>DIGUNAKAN</span></a></td>
                    @endif
                    <td>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="{{$data->kd_voucher}}" name="pilih" value="{{$data->kd_voucher}}">
                          <label class="custom-control-label" for="{{$data->kd_voucher}}"></label>
                      </div>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>
</div>

@endsection

@section('script')

<script>

    function setNama() {
        // alert($n);
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
        $index = "";

        if ($('#banyak').val() > 1) {
            $tmp = 3;
        } else {
            $tmp = 6;
        }
        for ($i = 0; $i < $tmp; $i++) { 
            $index = Math.floor(Math.random() * 35) + 1;
            $randomString += $characters[$index]; 
        } 

        // alert($randomString);
        $("input[name=kode_voucher]").val($randomString);
    }

    $('#banyak').on('input', function () {
        if ($('#banyak').val() > 1) {
            $("#kode_voucher").attr('maxlength', 3)
        }
    });

    function checkedAll(source) {
        var checkboxes = document.querySelectorAll('input[name="pilih"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }

    function validasi() {
        var favorite = [];
        var data = "";
        $.each($("input[name='pilih']:checked"), function(){
            favorite.push($(this).val());
        });
        if (favorite != "") {
            data = favorite.join(";");
            $.ajax({
             type:'POST',
             url:'/api/validasi',
             data:{data:data},
             headers: {
                "Accept":"application/json",
                "Authorization":"Bearer {{Auth::user()->api_token}}"
            }, 
            success:function(data){
                // location.reload(true);
                // alert(data);
                if (data == "berhasil") {
                    location.reload(true);
                } else {
                    alert(data);
                }
            }
        });
        } else {
            alert("pilih salah satu !!!");
        }
    }

</script>

@endsection