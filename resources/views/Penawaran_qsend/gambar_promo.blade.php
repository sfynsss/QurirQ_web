@extends('layouts.app')

@section('content')
@include('Penawaran.create_gambar_promo')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Data Gambar Promo</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"  data-target=".bs-example-modal-lg" onclick="setPenawaran();">TAMBAH DATA</button> &nbsp
                    {{-- <a href="{{url('/sinkronisasi')}}"><button type="button" class="btn btn-success float-right" style="margin-right: 10px;">SINKRONISASI</button></a> --}}
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="card card-bordered card-preview">
        <table class="table table-orders">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="tb-odr-body">
                @foreach($data as $data)
                <tr class="tb-odr-item">
                    <td>{{$data->id}}</td>
                    <td>
                        @if($data->gambar == "")
                        <span class="badge badge-danger">Data Kosong</span>
                        @else
                        <img src="{{asset('storage')}}/{{$data->gambar}}" width="200" height="75">
                        @endif
                    </td>
                    <td>
                        <button type="submit" class="btn btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="updatePenawaran('{{$data->id}}');">Ubah</button>
                        <a href="/deleteGambarPromo/{{ $data->id }}" class="btn btn-danger" onclick="if (confirm('Hapus Item Terpilih?')){return true;}else{event.stopPropagation(); event.preventDefault();};">Hapus</a>
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
    // function setPenawaran() {
    //     $("#penawaran").val("");
    //     $.ajax({
    //         type:'GET',
    //         url:'/api/getPenawaran',
    //         headers: {
    //             "Accept":"application/json",
    //             "Authorization":"Bearer {{Auth::user()->api_token}}"
    //         },
    //         success:function(data){
    //             $("input[name=id]").val(data);
    //         }
    //     });
    // }

    function updatePenawaran($a) {
        $('#link_url').attr('action', '{{url('/updateGambarPromo')}}');
        $("#id").val($a);
    }

    var uploadField = document.getElementById("customFile");

    uploadField.onchange = function() {
        if(this.files[0].size > 200000){
         alert("File is too big!");
         this.value = "";
     };
 };
</script>
@endsection