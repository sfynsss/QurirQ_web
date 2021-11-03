@extends('layouts.app')

@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table" id="isi">
					
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Large modal -->
<div class="modal fade modal_edit" id="modalKurir" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-lg">
		<div class="modal-content">
			<form method="post" action="{{url('inputQurir')}}">
				{{csrf_field()}}
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Pilih Kurir</h4>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row gy-4">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" for="default-01">No Invoice</label>
								<div class="form-control-wrap">
									<input type="text" class="form-control" readonly="true" id="id_mst" name="id_mst">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" for="default-01" id="judul">Nama Kurir</label>
								<div class="form-control-wrap">
									<select class="form-select" name="qurir" id="qurir">
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Large modal -->
<div class="modal fade modal_edit_status" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-lg">
		<div class="modal-content">
			<form method="post" action="{{url('gantiStatusTransaksi')}}">
				{{csrf_field()}}
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Ganti Status Transaksi</h4>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row gy-4">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" for="default-01">No Invoice</label>
								<div class="form-control-wrap">
									<input type="text" class="form-control" readonly="true" id="no_ent1" name="no_ent1">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" for="default-01" id="judul">Status Transaksi</label>
								<div class="form-control-wrap">
									<select class="form-select" name="status" id="status">
										<option disabled="true" selected="none">Pilih Salah Satu</option>
										<option value="MASUK">MASUK</option>
										<option value="PICKUP">PICKUP</option>
										<option value="DIKIRIM">DIKIRIM</option>
										<option value="SELESAI">SELESAI</option>
										<option value="BATAL">BATAL</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="nk-block nk-block-lg">
	<div class="nk-block-head nk-block-head col-xxl-12">
		<div class="nk-block-between">
			<div class="nk-block-head-content">
				<h3 class="nk-block-title page-title">Penjualan</h3>
			</div><!-- .nk-block-head-content -->
		</div><!-- .nk-block-between -->
	</div>
	<div class="col-xxl-12">
		<div class="card card-bordered card-full">
			<div class="card-inner">
				<div class="card-title-group">
					<div class="card-title">
						<h6 class="title"><span class="mr-2">Transaction</span></h6>
					</div>
				</div>
			</div>
			<div class="card card-bordered card-preview">
				<div class="card-inner">
					<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
						<thead>
							<tr>
								<th>No</th>
								<th>Tgl Transaksi</th>
								<th>Qurir</th>
								<th>Customer</th>
								<th>Total</th>
								<th>Sts Transaksi</th>
								<th>Sts Bayar</th>
								<th>Bukti TF</th>
								<th><span>&nbsp;</span></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($data as $i => $data)
							<tr class="nk-tb-item">
								<td class="nk-tb-col">{{ $i+1 }}</td>
								<td class="nk-tb-col">{{ substr($data->tanggal, 0, 10) }}</td>
								<td class="nk-tb-col">{{ $data->id_qurir != null ? $data->qurir->name : "Belum ada Qurir" }}</td>
								<td class="nk-tb-col">{{ $data->user->name }}</td>
								<td class="nk-tb-col">{{ $data->grand_total }}</td>
								<td class="nk-tb-col">{{ $data->sts_transaksi }}</td>
								<td class="nk-tb-col">{{ $data->sts_byr == "0" ? "Belum Terbayar" : "Terbayar" }}</td>
								<td>
									@if (isset($data->bukti_tf))
									<img src="{{asset('storage')}}/{{$data->bukti_tf}}" width="100" height="100">
									@else
									Belum Tersedia
									@endif
								</td>
								<td class="nk-tb-col nk-tb-col-action">
									<div class="dropdown">
										<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
											<ul class="link-list-plain">
												<li><a class="dropdown-item" onclick="setId('{{$data->id}}');" data-toggle="modal" data-target="#exampleModal">View</a></li>
												{{-- <li><a class="text-primary" onclick="setNoEnt1('{{$data->id}}');" data-toggle="modal" data-target=".modal_edit_status">Edit Status</a></li> --}}
												@if ($data->sts_byr == 1 && isset($data->bukti_tf))
												<li><a class="text-primary" onclick="setKurir('{{$data->id}}');" data-toggle="modal" data-target="#modalKurir">Pilih Kurir</a></li>
												@endif
											</ul>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div><!-- .card -->
	</div>
</div>
@endsection

@section('script')
<script>
	function setId($id) {
		var id = $id;
		var view_url = "{{url('detPenjualan')}}"+"/"+id;
		// alert(view_url);
		$.getJSON(view_url,function(result){
			// console.log(result);
			$("#isi").empty();
			$("#isi").append("<div class='nk-tb-item nk-tb-head'>"
				+"<div class='nk-tb-col'><span>No</span></div>"
				+"<div class='nk-tb-col'><span>Nama Barang</span></div>"
				+"<div class='nk-tb-col'><span>Harga Jual</span></div>"
				+"<div class='nk-tb-col'><span>Quantity</span></div>"
				+"<div class='nk-tb-col'><span>Sub Total</span></div>"
				+"</div>")
				var i = 1;
				result.forEach(function(r){
					$("#isi").append("<div class='nk-tb-item'>"
						+"<div class='nk-tb-col'><span class='tb-sub'>"+i+"</span></div>"
						+"<div class='nk-tb-col'><span class='tb-sub'>"+r['nm_brg']+"</span></div>"
						+"<div class='nk-tb-col'><span class='tb-sub'>"+r['harga']+"</span></div>"
						+"<div class='nk-tb-col'><span class='tb-sub'>"+r['jumlah']+"</span></div>"
						+"<div class='nk-tb-col'><span class='tb-sub'>"+r['sub_total']+"</span></div>"
						+"<div>"
							);
							i++;
						});
					});
				};
				
				function setNoEnt1($id) {
					$('#no_ent1').val($id);
				};
				
				function setKurir($id) {
					$('#id_mst').val($id);
					
					var view_url = "{{url('getKurir')}}";
					// alert(view_url);
					$.getJSON(view_url,function(result){
						console.log(result);
						$("#qurir").empty();
						$("#qurir").append("<option disabled='true' selected='none'>Pilih Salah Satu</option>");
						result.forEach(function(r){
							$("#qurir").append("<option value="+r['id']+">"+r['name']+"</option>");
						});
					});
				};
				
			</script>
			@endsection