@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg">
	<div class="nk-block-head nk-block-head-sm">
		<div class="nk-block-between">
			<div class="nk-block-head-content">
				<h3 class="nk-block-title page-title">Kategori Barang</h3>
			</div><!-- .nk-block-head-content -->
			<div class="nk-block-head-content">
				<div class="toggle-wrap nk-block-tools-toggle">
					<button class="btn btn-primary" data-toggle="modal" data-target=".modal_input" onclick="bersih();">Tambah</button> 
				</div>
			</div><!-- .nk-block-head-content -->
		</div><!-- .nk-block-between -->
	</div><!-- .nk-block-head -->
	<div class="card card-bordered card-preview">
		<table class="table table-orders">
			<thead class="tb-odr-head">
				<tr>
					<th>No</th>
					<th>Nama Kategori</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody class="tb-odr-body">
				@foreach($data as $i => $data)
				<tr class="tb-odr-item">
					<td>{{$i+1}}</td>
					<td>
						<span class="tb-odr-date">{{$data->nm_kategori_barang}}</span>
					</td>
					<td>
						<div class="dropdown">
							<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
								<ul class="link-list-plain">
									<li><a data-toggle="modal" data-target=".modal_input" onclick="setKategori('{{$data->id}}', '{{$data->nm_kategori_barang}}')">Edit</a></li>
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

@include('barang.input_kategori_barang')
@endsection

@section('script')
<script>
  function setKategori($a, $b) {
    $('#link_url').attr('action', '{{route('ubah_kategori_barang')}}');
    $('#nm_kategori').val($b);
    $('#id_kategori').val($a);
  }

  function bersih() {
    $('#link_url').attr('action', '{{route('simpan_kategori_barang')}}');
    $('#nm_kategori').val("");
  }
</script>
@endsection