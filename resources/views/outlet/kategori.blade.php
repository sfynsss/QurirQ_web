@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
	<div class="nk-block-head nk-block-head-sm">
		<div class="nk-block-between">
			<div class="nk-block-head-content">
				<h3 class="nk-block-title page-title">Kategori Outlet</h3>
			</div><!-- .nk-block-head-content -->
			<div class="nk-block-head-content">
				<div class="toggle-wrap nk-block-tools-toggle">
					<button class="btn btn-primary" data-toggle="modal" data-target=".modal_input" onclick="tambah();">tambah</button> 
				</div>
			</div><!-- .nk-block-head-content -->
		</div><!-- .nk-block-between -->
	</div><!-- .nk-block-head -->
	<div class="card card-bordered card-preview">
		<table class="table table-orders">
			<thead class="tb-odr-head">
				<tr class="tb-odr-item">
					<th>
						No
					</th>
					<th class="tb-odr-info">
						<span class="tb-odr-id">Nama Kategori Outlet</span>
					</th>
					<th>
						<span class="tb-odr-date d-none d-md-inline-block">Gambar</span>
					</th>
					<th>
						<span class="tb-odr-total">Status Tampil</span>
					</th>
					<th class="tb-odr-action">&nbsp;</th>
				</tr>
			</thead>
			<tbody class="tb-odr-body">
				@foreach($data as $i => $data)
				<tr class="tb-odr-item">
					<td>{{$i+1}}</td>
					<td class="tb-odr-info">
						<span class="tb-odr-id"><a href="#">{{$data->nm_kategori_outlet}}</a></span>
					</td>
					<td>
						<img src="{{asset('storage')}}/{{$data->gbr_kategori_outlet}}" width="100" height="100">
					</td>
					<td>
						<span class="tb-odr-total">
							@if($data->sts_tampil == 1)
							<span class="amount">Tampil</span>
							@elseif($data->sts_tampil == 0)
							<span class="amount">Tidak Tampil</span>
							@endif
						</span>
					</td>
					<td class="tb-odr-action">
						<div class="dropdown">
							<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
								<ul class="link-list-plain">
									<li><a data-toggle="modal" data-target=".modal_input" onclick="setKategori('{{$data->id}}', '{{$data->nm_kategori_outlet}}', '{{$data->sts_tampil}}', '{{$data->gbr_kategori_outlet}}')">Edit</a></li>
									<li><a href="{{route('data_outlet', $data->id)}}" class="text-primary">Outlet</a></li>
									<li><a href="#" class="text-danger">Remove</a></li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div><!-- .card-preview -->
</div><!-- nk-block -->

@include('outlet.input_kategori_outlet')

@endsection

@section('script')
<script>
	function tambah() {
		$('#form_kategori_outlet').attr('action', '{{route('simpan_kategori_outlet')}}');
        $('#nm_kategori').val("");
        $('#status').select2('val', "");
    }

    function setKategori($a, $b, $c, $d) {
		$('#form_kategori_outlet').attr('action', '{{route('ubah_kategori_outlet')}}');
		$('#id_kategori').val($a);
        $('#nm_kategori').val($b);
        $('#status').select2('val', $c);
    }

</script>
@endsection