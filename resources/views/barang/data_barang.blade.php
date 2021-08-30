@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
	<div class="nk-block-head nk-block-head-sm">
		<div class="nk-block-between">
			<div class="nk-block-head-content">
				<h3 class="nk-block-title page-title">Data Barang Outlet : {{ $outlet->nama_outlet }}</h3>
			</div><!-- .nk-block-head-content -->
			<div class="nk-block-head-content">
				<div class="toggle-wrap nk-block-tools-toggle">
					<button class="btn btn-primary" data-toggle="modal" data-target="#modalInput">tambah</button>
				</div>
			</div><!-- .nk-block-head-content -->
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
						<th>
							<span class="tb-odr-date d-none d-md-inline-block">Kategori Barang</span>
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
					@foreach($data as $i => $data)
					<tr class="tb-odr-item">
						<td>{{$i+1}}</td>
						<td class="edit">{{$data->kategori->nm_kategori_barang}}</td>
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
							<a onclick="editBarang('{{$data->id}}', '{{$data->nm_brg}}', '{{$data->id_kategori_barang}}', '{{$data->hpp}}', '{{$data->harga_jl}}', '{{$data->disc}}', '{{$data->harga_disc}}', '{{$data->kd_kat_android}}', '{{$data->berat}}', '{{$data->volume}}')" class="btn btn-warning" data-toggle="modal" data-target="#modalInput">Ubah</a>
							<a onclick="detailBarang('{{$data->id}}', '{{$data->nm_brg}}', '{{$data->kategori->nm_kategori_barang}}', '{{$data->hpp}}', '{{$data->harga_jl}}', '{{$data->disc}}', '{{$data->harga_disc}}', '{{$data->kd_kat_android}}', '{{$data->berat}}', '{{$data->volume}}')" class="btn btn-success" data-toggle="modal" data-target="#modal_detail">Detail</a>
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
@include('barang.detail_barang')
@endsection

@section('script')
<script>
	$( document ).ready(function() {
		const source = document.getElementById('disc_brg_edit');
		const result = document.getElementById('harga_disc_brg_edit');
		
		const source2 = document.getElementById('harga_disc_brg_edit');
		const result2 = document.getElementById('disc_brg_edit');
		
		const source3 = document.getElementById('margin');
		const result3 = document.getElementById('hrg_brg_edit');

		const inputHandler = function(e) {
			var disc = document.getElementById('hrg_brg_edit').value * (e.target.value/100);
			var total = parseInt(document.getElementById('hrg_brg_edit').value) + parseInt(disc);
			//var disc = Math.ceil(document.getElementById('hrg_brg_edit').value * (e.target.value/100));
			$('#harga_disc_brg_edit').val(total.toFixed(0));
		}
		
		const inputHandler2 = function(e) {
			var hrg = document.getElementById('hrg_brg_edit').value;
			var dsc = e.target.value;
			var ptg = (dsc/hrg) * 100;
			ptg = ptg.toFixed(0);
			$('#disc_brg_edit').val(ptg);
		}

		const inputHandler3 = function(e) {
			var hpp = document.getElementById('hpp').value;
			var disc = document.getElementById('hpp').value * (e.target.value/100);
			var total = parseInt(hpp) + parseInt(disc.toFixed(0));
			//var disc = Math.ceil(document.getElementById('hrg_brg_edit').value * (e.target.value/100));
			$('#hrg_brg_edit').val(total);
		}
		
		source.addEventListener('input', inputHandler);
		source.addEventListener('propertychange', inputHandler);
		
		source2.addEventListener('input', inputHandler2);
		source2.addEventListener('propertychange', inputHandler2);

		source3.addEventListener('input', inputHandler3);
		source3.addEventListener('propertychange', inputHandler3);
	});
	
	function bersih() {
		$('#link_url').attr('action', '{{route('simpan_barang', $outlet->id)}}');
		$('#nm_brg_edit').val("");
		$('#hpp').val("");
		$('#hrg_brg_edit').val("");
		$('#disc_brg_edit').val("");
		$('#harga_disc_brg_edit').val("");
		$("#kat_barang").val(0).trigger('change');		
	}

	function editBarang($id_brg, $nm_brg, $id_kategori_barang, $hpp, $hrg, $disc, $harga_disc) {
		$('#link_url').attr('action', '{{route('ubah_barang', $outlet->id)}}');
		$('#id_brg').val($id_brg);
		$('#nm_brg_edit').val($nm_brg);
		$('#hpp').val($hpp);
		$('#hrg_brg_edit').val($hrg);
		$('#disc_brg_edit').val($disc);
		$('#harga_disc_brg_edit').val($harga_disc);
		$("#kat_barang").val($id_kategori_barang).trigger('change');		
	}

	function detailBarang($id_brg, $nm_brg, $kategori_barang, $hpp, $hrg, $disc, $harga_disc) {
		document.getElementById('nama_barang').innerHTML = $nm_brg;	
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