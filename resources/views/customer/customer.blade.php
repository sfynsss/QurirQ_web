@extends('layouts.app')

@section('content')
@include('customer.edit')
{{-- @include('customer.detail') --}}

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Data Customer</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    {{-- <button type="button" class="btn btn-primary float-right" data-toggle="modal" onclick="setKdCust();" data-target=".bs-example-modal-lg">TAMBAH DATA</button> &nbsp --}}
                </div>
            </div>
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="card card-bordered card-preview">
        <table class="table table-orders">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Cust</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Hp</th>
                    <th scope="col">Email</th>
                    <th scope="col">Point</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">OTP</th>
                    <th scope="col">Grosir Token</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="tb-odr-body">
                @php($i = 1)
                @foreach($data as $data)
                <tr class="tb-odr-item">
                    <td>{{$i++}}</td>
                    <td class="tb-status text-success">{{$data->KD_CUST}}</td>
                    <td>{{$data->NM_CUST}}</td>
                    <td>{{$data->ALM_CUST}}</td>
                    <td class="tb-status text-warning">{{$data->HP}}</td>
                    <td class="tb-status text-primary">{{$data->E_MAIL}}</td>
                    <td class="tb-status text-danger">{{$data->POINT_BL_INI}}</td>
                    <td>{{$data->KATEGORI}}</td>
                    @if($data->email_activation == 1)
                    <td class="tb-status text-success">Aktif</td>
                    @elseif($data->email_activation == 0)
                    <td class="tb-status text-danger">{{$data->activation_token}}</td>
                    @endif
                    <td>{{$data->grosir_token}}</td>
                    <td>
                        <a class="btn btn-success m-r-10" href="{{url('aktifasiAkun')}}/{{$data->E_MAIL}}"><i class="icon ni ni-unlock"></i>&nbsp;Aktivasi</a>
                        <a class="btn btn-warning m-r-10" href="" data-toggle="modal"  data-target=".bs-example-modal-lg" onclick="setIsi('{{$data->KD_CUST}}', '{{$data->E_MAIL}}', '{{$data->id}}', '{{$data->password}}',);"><i class="icon ni ni-pen-alt-fill"></i>&nbsp;Ubah</a>
                    </td>
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

    function setIsi($kd_cust, $email, $id, $password) {
        $("#kode_cust").val($kd_cust);
        $("#email").val($email);
        $("#id_user").val($id);
        $("#password").val($id);
    }

    // window.RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;//compatibility for Firefox and chrome
    // var pc = new RTCPeerConnection({iceServers:[]}), noop = function(){};      
    // pc.createDataChannel('');//create a bogus data channel
    // pc.createOffer(pc.setLocalDescription.bind(pc), noop);// create offer and set local description
    // pc.onicecandidate = function(ice) {
    //     if (ice && ice.candidate && ice.candidate.candidate) {
    //         var myIP = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/.exec(ice.candidate.candidate)[1];  
    //         pc.onicecandidate = noop;
    //         // alert(myIP);
    //         document.getElementById("link_download").setAttribute("href", '{{url('/downloadCustomer')}}/'+myIP);
    //     }
    // };

</script>
@endsection