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
        <div class="table-responsive">
            <table class="table table-orders" id="tabelku">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Cust</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div><!-- nk-block -->
@endsection

@section('script')
<script>
    
    function setIsi($kd_cust, $email, $id) {
        // alert($kd_cust);
        $("#kode_cust").val($kd_cust);
        $("#email").val($email);
        $("#id_user").val($id);
        $("#password").val();
    }
    
    $(function () {
        
        var table = $('#tabelku').DataTable({
            processing: true,
            serverSide: true,
            autoWidht:false,
            ajax: "{{ route('customer') }}",
            columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'KD_CUST', name: 'KD_CUST'},
            {data: 'NM_CUST', name: 'NM_CUST'},
            {data: 'ALM_CUST', name: 'ALM_CUST'},
            {data: 'HP', name: 'HP'},
            {data: 'E_MAIL', name: 'E_MAIL'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
    
</script>
@endsection