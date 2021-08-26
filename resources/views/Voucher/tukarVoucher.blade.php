@extends('layouts.app')

@section('content')

<div class="card">
  <br>
  <div class="col-md-8"><h4 class="card-title">Data Tukar Voucher</h4></div>

  <div class="card-body">
    <div class="form-body">
      <form action="{{url('/penukaranVoucher')}}" method="post">
        {{csrf_field()}}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="control-label text-left col-md-4">Kode Voucher</label>
              <div class="col-md-8">
                <input type="text" class="form-control" autofocus name="kd_voucher" id="kd_voucher" required min="6" maxlength="6" style="text-transform:uppercase">
              </div>
            </div>
          </div>
          <!--/span-->
          <div class="col-md-6">
            <div class="form-group row">
              <label class="control-label text-left col-md-4">Nomor Kartu</label>
              <div class="col-md-8">
                <input type="text" class="form-control" required name="no_kartu" id="no_kartu" style="text-transform:uppercase;">
              </div>
            </div>
          </div>
          <!--/span-->
        </div>
        <!--/row-->
        <br>
        <button type="button" class="btn btn-danger waves-effect float-right" data-dismiss="modal">Clear</button>
        <button type="submit" class="btn btn-success waves-effect float-right" style="margin-right: 5px;">Simpan</button>
      </form>
    </div>
  </div>

  <div class="card card-bordered card-preview">
    <table id="myTable" class="table table-orders">
      <thead class="thead">
          <tr>
            <th>No</th>
            <th>Kode Voucher</th>
            <th>Nomor Kartu</th>
            <th>Nama Customer</th>
            <th>Nilai</th>
          </tr>
        </thead>
        <tbody>
          @php($i = 1)
          @foreach($data as $data)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$data->kd_voucher}}</td>
            <td>{{$data->no_kartu}}</td>
            <td>{{$data->NM_CUST}}</td>
            <td>{{$data->nilai_voucher}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>



</script>

@endsection