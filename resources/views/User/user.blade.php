@extends('layouts.app')

@section('content')
@include('User.create')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                @if($status == "admin")
                <h3 class="nk-block-title page-title">Data Users Admin</h3>
                @elseif($status == "driver")
                <h3 class="nk-block-title page-title">Data Users Driver</h3>
                @elseif($status == "resto")
                <h3 class="nk-block-title page-title">Data Users Resto</h3>
                @endif
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"  data-target=".bs-example-modal-lg" onclick="setTambah();">TAMBAH DATA</button> &nbsp
                    {{-- <a href="{{url('/sinkronisasi')}}"><button type="button" class="btn btn-success float-right" style="margin-right: 10px;">SINKRONISASI</button></a> --}}
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="card card-bordered card-preview">
        <table class="table table-orders">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    @if ($status == 'resto')
                    <th>Nama Resto</th>
                    @endif
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach($data as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->no_telp}}</td>
                    @if ($status == 'resto')
                    <td>{{$data->outlet->nama_outlet}}</td>
                    @endif
                    <td>
{{--                         <button type="submit" class="btn btn-warning waves-effect text-left" onclick="setEdit('{{$data->kd_peg}}', '{{$data->name}}', '{{$data->email}}', '{{$data->tanggal_lahir}}', '{{$data->no_telp}}', '{{$data->alamat}}', '{{$data->cabang}}')" data-toggle="modal"  data-target=".bs-example-modal-lg">Edit</button> --}}
                    <a href="{{url('editUser')}}/{{$data->id}}" class="btn btn-success">Ubah</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script>

    function setEdit($kd_peg, $nama, $email, $tanggal_lahir, $no_telp, $alamat, $cabang) {
        $("#kd_peg").val($kd_peg);
        $("#name").val($nama);
        $("#email").val($email);
        $("#tgl_lahir").val($tanggal_lahir);
        $("#no_telp").val($no_telp);
        $("#alamat").val($alamat);
    }

    function setTambah() {
        $.ajax({
            type:'GET',
            url:'/api/getKdPeg',
            headers: {
                "Accept":"application/json",
                "Authorization":"Bearer {{Auth::user()->api_token}}"
            },
            success:function(data){
              $("input[name=kd_peg]").val(data);
              $("#name").val("");
              $("#email").val("");
              $("#tgl_lahir").val("");
              $("#no_telp").val("");
              $("#alamat").val("");
              // alert(data);
          }
      });
    }
    
</script>
@endsection