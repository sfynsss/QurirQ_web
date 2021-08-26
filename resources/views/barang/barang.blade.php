@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
	<div class="nk-block-head nk-block-head-sm">
		<div class="nk-block-between">
			<div class="nk-block-head-content">
				<h3 class="nk-block-title page-title">Master Barang</h3>
			</div><!-- .nk-block-head-content -->
			{{-- <div class="nk-block-head-content">
				<div class="toggle-wrap nk-block-tools-toggle">
					<button class="btn btn-primary" data-toggle="modal" data-target=".modal_input">tambah</button> &nbsp
					<button class="btn btn-success" data-toggle="modal" data-target=".modal_upload">Upload</button>
				</div>
			</div><!-- .nk-block-head-content --> --}}
		</div><!-- .nk-block-between -->
	</div><!-- .nk-block-head -->
	<div class="card card-bordered card-preview">
		<div class="card-inner">
			<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
				<thead class="tb-odr-head">
					<tr class="tb-odr-item">
						<th>
							No
						</th>
						<th class="tb-odr-info">
							<span class="tb-odr-id">Kode Barang</span>
						</th>
						<th>
							<span class="tb-odr-date d-none d-md-inline-block">Kategori Barang</span>
						</th>
												<th>
							<span class="tb-odr-date d-none d-md-inline-block">Outlet</span>
						</th>
						<th>
							<span class="tb-odr-date d-none d-md-inline-block">Nama Barang</span>
						</th>
						<th>
							<span class="tb-odr-status d-none d-md-inline-block">Harga Beli</span>
						</th>
						<th>
							<span class="tb-odr-status d-none d-md-inline-block">Harga Jual</span>
						</th>
						<th>
							<span class="tb-odr-status d-none d-md-inline-block">Kesediaan Gambar</span>
						</th>
						<th class="tb-odr-action">Aksi</th>
					</tr>
				</thead>
				<tbody class="tb-odr-body">
					@php($i = 1)
					@foreach($data as $data)
					<tr class="tb-odr-item">
						<td>{{$i++}}</td>
						<td class="tb-odr-info">
							<span class="tb-odr-id"><a href="#">{{$data->kd_brg}}</a></span>
						</td>
						<td class="edit">{{$data->nm_kat_android}}</td>
						<td class="edit">{{$data->kd_outlet}}</td>
						<td>
							<span class="tb-odr-date">{{$data->nm_brg}}</span>
						</td>
						{{-- <td>
							<span class="tb-odr-total">
								<span class="amount">{{$data->berat}} gram</span>
							</span>
						</td> --}}
						<td>
							<span class="tb-odr-status">
								<span class="badge badge-dot badge-success">@currency($data->harga_bl)</span>
							</span>
						</td>
						<td>
							<span class="tb-odr-status">
								<span class="badge badge-dot badge-primary">@currency($data->harga_jl)</span>
							</span>
						</td>
						<td>
							@if($data->gambar == "" or $data->gambar == "kosong")
							<span class="badge badge-danger">Kosong</span>
							@else
							<span class="badge badge-success">Tersedia</span>
							@endif
						</td>				
						<td>
                    		<a onclick="editBarang('{{$data->nm_brg}}', '{{$data->kd_brg}}', '{{$data->harga_jl}}', '{{$data->disc}}', '{{$data->harga_disc}}', '{{$data->kd_kat_android}}', '{{$data->berat}}', '{{$data->volume}}')" class="btn btn-warning" data-toggle="modal" data-target=".modal_edit">Ubah</a>
                    		<a href="{{url('detail_barang')}}/{{$data->kd_brg}}" class="btn btn-success">Detail</a>
                		</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div><!-- .card-preview -->
</div>
</div><!-- nk-block -->

@include('barang.input_barang')
@include('barang.upload_barang')
@include('barang.edit_barang')
@endsection

@section('script')
<script>
	$( document ).ready(function() {
		const source = document.getElementById('disc_brg_edit');
		const result = document.getElementById('harga_disc_brg_edit');

		const source2 = document.getElementById('harga_disc_brg_edit');
		const result2 = document.getElementById('disc_brg_edit');

		const inputHandler = function(e) {
			var disc = document.getElementById('hrg_brg_edit').value * (e.target.value/100);
			//var disc = Math.ceil(document.getElementById('hrg_brg_edit').value * (e.target.value/100));
			$('#harga_disc_brg_edit').val(disc);
		}

		const inputHandler2 = function(e) {
			var hrg = document.getElementById('hrg_brg_edit').value;
			var dsc = e.target.value;
			var ptg = (dsc/hrg) * 100;
			ptg = ptg.toFixed(0);
			$('#disc_brg_edit').val(ptg);
		}

		source.addEventListener('input', inputHandler);
		source.addEventListener('propertychange', inputHandler);

		source2.addEventListener('input', inputHandler2);
		source2.addEventListener('propertychange', inputHandler2);


	});


	function editBarang($nm_brg, $id, $hrg, $disc, $harga_disc, $kd_kat_android, $berat, $volume) {
		$('#nm_brg_edit').val($nm_brg);
		$('#kd_brg_edit').val($id);
		$('#hrg_brg_edit').val($hrg);
		$('#disc_brg_edit').val($disc);
		$('#harga_disc_brg_edit').val($harga_disc);
		$("#kat_barang").val($kd_kat_android).trigger('change');
		$('#berat_edit').val($berat);
		$('#volume_edit').val($volume);

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