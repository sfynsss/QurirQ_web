@extends('layouts.app')

@section('content')
@include('customer.edit_point')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Perolehan Point Bulan Ini</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
<br>
<div class="card card-bordered card-preview">
    <table class="table table-orders">
        <thead class="tb-odr-head">
            <tr class="tb-odr-item">
                <th style="width:5%">No</th>
                <th style="width:25%">Nama</th>
                <th style="width:30%">Alamat</th>
                <th style="width:10%">No Hp</th>
                <th style="width:10%">Kategori</th>
                <th style="width:10%">Jumlah Point</th>
                @if(Auth::user()->otoritas == 'SUPER ADMIN')
                <th style="width:20%">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody class="tb-odr-body">
            @php($i = 1)
            @foreach($data as $data)
            <tr class="tb-odr-item">
                <td>{{$i++}}</td>
                <td>{{$data->NM_CUST}}</td>
                <td>{{$data->ALM_CUST}}</td>
                <td>{{$data->HP}}</td>
                <td>{{$data->KATEGORI}}</td>
                <td><span style="font-weight:bold">{{$data->POINT_BL_INI}}</span></td>
                @if(Auth::user()->otoritas == 'SUPER ADMIN')
                <td><button type="submit" class="btn btn-warning waves-effect text-left" 
                    onclick="setIsi('{{$data->KD_CUST}}','{{$data->NM_CUST}}', '{{$data->POINT_BL_INI}}', '{{$data->POINT_BL_INI}}', '{{$data->id}}');" 
                    data-toggle="modal"  data-target=".bs-example-modal-lg">Edit</button>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div><!-- .card-preview -->
</div><!-- nk-block -->

@endsection
@section('script')
<script>

    function setKdCust() {
        $.ajax({
         type:'POST',
         url:'/api/getKodeCust',
         headers: {
            "Accept":"application/json",
            "Authorization":"Bearer {{Auth::user()->api_token}}"
        },
        success:function(data){
          $("input[name=kode_cust]").val(data);
              // alert(data);
          }
        });
    }

    function setIsi($kd_cust, $nm_cust, $point_awal, $point_akhir, $id) {
        $("#kode_cust").val($kd_cust);
        $("#nm_cust").val($nm_cust);
        $("#point_awal").val($point_awal);
        $("#point_akhir").val($point_akhir);
        $("#id_user").val($id);
    }


</script>
@endsection