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
          @if(Auth::user()->otoritas == 'SUPER ADMIN')
          <button type="button" class="btn btn-success float-right" style="margin-left: 10px;" data-toggle="modal"  data-target=".bs-example-modal-lg">TAMBAH DATA</button>
          @endif
          <a href="{{url('notifMultiDevice')}}"><button type="button" style="margin-left: 10px;" class="btn btn-primary float-right">NOTIFIKASI</button></a>
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
          <th>Nilai</th>
          <th>Tgl Berlaku</th>
        </tr>
      </thead>
      <tbody>
        @php($i = 1)
        @foreach($data as $data)
        <tr>
          <td>{{$i++}}</td>
          <td>{{$data->kd_voucher}}</td>
          <td>{{$data->nama_voucher}}</td>
          <td>@currency($data->nilai_voucher)</td>
          <td>{{$data->tgl_berlaku_2}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>

@include('Voucher.tambah_voucher')
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

      $(document).ready(function() {
        $("#user").select2();
      });

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