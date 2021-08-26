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
					<button class="btn btn-primary" data-toggle="modal" data-target=".modal_input">tambah</button> 
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
						<span class="tb-odr-id">Kode Kategori</span>
					</th>
					<th>
						<span class="tb-odr-date d-none d-md-inline-block">Nama Kategori</span>
					</th>
					<th>
						<span class="tb-odr-total">Status Tampil</span>
					</th>
					<th>
						<span class="tb-odr-total">Gambar</span>
					</th>
					<th class="tb-odr-action">&nbsp;</th>
				</tr>
			</thead>
			<tbody class="tb-odr-body">
				@php($i = 1)
				@foreach($data as $data)
				<tr class="tb-odr-item">
					<td>{{$i++}}</td>
					<td class="tb-odr-info">
						<span class="tb-odr-id"><a href="#">{{$data->kd_kat_android}}</a></span>
					</td>
					<td>
						<span class="tb-odr-date">{{$data->nm_kat_android}}</span>
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
					<td>
						<img src="{{asset('storage')}}/{{$data->gbr_kat_android}}" width="100" height="100">
					</td>
					<td class="tb-odr-action">
						<div class="dropdown">
							<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
								<ul class="link-list-plain">
									<li><a href="#" class="text-primary">Ubah</a></li>
									<li><a href="#" class="text-danger">Hapus</a></li>
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
@include('barang.upload_barang')
@endsection