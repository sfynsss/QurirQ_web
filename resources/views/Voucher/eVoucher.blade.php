@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
  <div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
      <div class="nk-block-head-content">
        <h3 class="nk-block-title page-title">Data Voucher</h3>
      </div><!-- .nk-block-head-content -->
      <div class="nk-block-head-content">
        <div class="toggle-wrap nk-block-tools-toggle">
          <a href="{{url('notifMultiDevice')}}"><button type="button" style="margin-left: 10px;" class="btn btn-primary float-right">NOTIFIKASI</button></a>
          <button type="button" class="btn btn-success float-right" onclick="validasi();">VALIDASI</button>
        </div>
      </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
  </div><!-- .nk-block-head -->

  <div class="card card-bordered card-preview">
    <table id="myTable" class="table table-orders">
      <thead class="thead">
        <tr>
          <th>No</th>
          <th>Kode Voucher</th>
          <th>Nama Voucher</th>
          <th>Nama Customer</th>
          <th>Nilai</th>
          <th>Tgl Berlaku</th>
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
          <td>{{$data->NM_CUST}}</td>
          <td>{{$data->nilai_voucher}}</td>
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

  function setKdCust() {
    var kategori = $("select[name=kategori]").val();
    var cabang = $("select[name=cabang]").val();
    if (kategori == "Select an Option" || cabang == "Select an Option") {
    } else {
      $.ajax({
       type:'POST',
       url:'/api/getKodeCust',
       data:{kategori:kategori, cabang:cabang},
       headers: {
        "Accept":"application/json",
        "Authorization":"Bearer {{Auth::user()->api_token}}"
      },
      success:function(data){
        $("input[name=kode_cust]").val(data);
      }
    });
    }
  }

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