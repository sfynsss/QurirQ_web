@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Data Notifikasi</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalLarge">Tambah Data</button> 
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->

    <div class="modal fade" tabindex="-1" id="modalLarge">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{url('/notifGlobal')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title">Form Notifikasi</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label text-left">Judul</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="title" id="title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Notifikasi</label>
                                            <select class="form-control" name="jenis_notif">
                                                <option disabled="true" selected="none">Pilih Salah Satu</option>
                                                <option value="0">Transaksi</option>
                                                <option value="1">Promo</option>
                                                <option value="2">Informasi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <!--/row-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label text-left">Rincian Pesan</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="notif" id="notif"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label text-left">Pilih Target</label>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <select id="user" name="user[]" multiple style="width: 100%;">
                                                    <option value="semua">Semua</option>
                                                    @foreach($user as $user)
                                                    <option value="{{$user->KD_CUST}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success waves-effect text-left" onclick="simpan();">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card card-bordered card-preview">
        <table class="table table-orders">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Notif</th>
                    <th>Jenis Notifikasi</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @foreach($data as $data)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$data->judul}}</td>
                    <td>{{$data->notif}}</td>
                    @if($data->jenis_notif == "0")
                    <td>Transaksi</td>
                    @elseif($data->jenis_notif == "1")
                    <td>Promo</td>
                    @else
                    <td>Info</td>
                    @endif
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

</script>

@endsection