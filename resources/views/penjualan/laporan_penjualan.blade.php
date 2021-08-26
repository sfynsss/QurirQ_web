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
<div class="modal fade modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-lg">
		<div class="modal-content">
			<form method="post" action="{{url('inputResi')}}">
				{{csrf_field()}}
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Masukkan Resi</h4>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row gy-4">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" for="default-01">No Invoice</label>
								<div class="form-control-wrap">
									<input type="text" class="form-control" readonly="true" id="no_ent" name="no_ent">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="form-label" for="default-01" id="judul">No Resi</label>
								<div class="form-control-wrap">
									<input type=text class="form-control" id="no_resi" name="no_resi">
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
										<option value="PROSES">PROSES</option>
										<option value="SIAP DIAMBIL">SIAP DIAMBIL</option>
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
	<div class="nk-block-head nk-block-head-sm">
		<div class="nk-block-between">
			<div class="nk-block-head-content">
				<h3 class="nk-block-title page-title">Laporan Penjualan</h3>
			</div><!-- .nk-block-head-content -->
			<div class="nk-block-head-content">
				<div class="toggle-wrap nk-block-tools-toggle">
					<a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>>
				</div>
			</div><!-- .nk-block-head-content -->
		</div><!-- .nk-block-between -->
	</div>
	<div class="col-xxl-12">
		<div class="card card-bordered card-full">
			<div class="card-inner">
				<div class="row gy-4 mt-2">
					<div class="col-sm-5">
						<div class="form-group">
							<label class="form-label">Tanggal Awal</label>
							<div class="form-control-wrap">
								<input type="text" name="tgl_awal" class="form-control date-picker">
							</div>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							<label class="form-label">Tanggal Akhir</label>
							<div class="form-control-wrap">
								<input type="text" name="tgl_akhir" class="form-control date-picker">
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<label class="form-label">Cari</label>
						<a href="#" class="btn btn-primary">Caro Berdasarkan Tanggal</a>
					</div>
				</div>
			</div>
			<div class="card-inner p-0 border-top">
				<div class="nk-tb-list nk-tb-orders">
					<div class="nk-tb-item nk-tb-head">
						<div class="nk-tb-col"><span>No Ent</span></div>
						<div class="nk-tb-col"><span>Customer</span></div>
						<div class="nk-tb-col"><span>Transaksi</span></div>
						<div class="nk-tb-col"><span>Pengiriman</span></div>
						<div class="nk-tb-col"><span>Aksi</span></div>
					</div>
					@foreach($data as $data)
					<div class="nk-tb-item">
						<div class="nk-tb-col">
							<span class="tb-lead"><a href="#">{{$data->no_ent}}</a></span>
						</div>
						<div class="nk-tb-col tb-col-sm">
							<div class="user-card">
								<div class="user-name">
									<span class="tb-lead">{{$data->NM_CUST}}</span>
								</div>
							</div>
						</div>
						<div class="nk-tb-col">
							<span class="tb-sub tb-amount">@currency($data->total)</span>
						</div>
						<div class="nk-tb-col">
							<span class="tb-sub tb-amount">{{$data->jns_pengiriman}}</span>
						</div>
						<div class="nk-tb-col">
							<button type="button" class="btn btn-success onclick="setId('{{$data->no_ent}}');" data-toggle="modal" data-target="#exampleModal">Detail Pesanan</Button>
							<a class="btn btn-warning" href="{{url('invoice')}}/{!! str_replace('/', '-', $data->no_ent) !!}">Lihat Invoice</a>
						</div>

					</div>
					@endforeach
				</div>
			</div>
			<div class="card-inner-sm border-top text-center d-sm-none">
				<a href="#" class="btn btn-link btn-block">See History</a>
			</div>
		</div><!-- .card -->
	</div>
</div>
@endsection

@section('script')
<script>
	function setId($id) {
		var a = $id.substr(0, 8);
		var b = $id.substr(9, 5);
		var c = $id.substr(15, 8);
		var view_url = "{{url('detPenjualan')}}"+"/"+a+"-"+b+"-"+c;
		// alert(view_url);
		$.getJSON(view_url,function(result){
			console.log(result);
         // console.log(result);
         $("#isi").empty();
         $("#isi").append("<div class='nk-tb-item nk-tb-head'>"
         	+"<div class='nk-tb-col'><span>Kode Barang</span></div>"
         	+"<div class='nk-tb-col'><span>Nama Barang</span></div>"
         	+"<div class='nk-tb-col'><span>Harga Jual</span></div>"
         	+"<div class='nk-tb-col'><span>Quantity</span></div>"
         	+"<div class='nk-tb-col'><span>Sub Total</span></div>"
         	+"</div>")

         result.forEach(function(r){
         	// alert(r);
         	$("#isi").append("<div class='nk-tb-item'>"
         		+"<div class='nk-tb-col'><span class='tb-sub'>"+r['kd_brg']+"</span></div>"
         		+"<div class='nk-tb-col'><span class='tb-sub'>"+r['nm_brg']+"</span></div>"
         		+"<div class='nk-tb-col'><span class='tb-sub'>"+r['harga']+"</span></div>"
         		+"<div class='nk-tb-col'><span class='tb-sub'>"+r['jumlah']+"</span></div>"
         		+"<div class='nk-tb-col'><span class='tb-sub'>"+r['sub_total']+"</span></div>"
         		+"<div>");
         });
     });
	};

	function setNoEnt($id, $jns_pengiriman) {
		$('#no_ent').val($id);
		if ($jns_pengiriman == "cod") {
			// alert("masuk sini");
			// $("#input_resi").empty().append('<select class="form-select" name="status" id="status">'
			// 	+'<option disabled="true" selected="none">Pilih Salah Satu</option>'
			// 	+'<option value="1">Tampil</option>'
			// 	+'<option value="0">Tidak Tampil</option>'
			// 	+'</select>');
			// $("#input_resi").empty().append(function() {
			// 	return $("<select name='sopir' id='sopir'>")
			// 	.append("<option disabled='true' selected='none'>Pilih Salah Satu</option>")
			// 	.append("<option value='budi'>Budi</option>")
			// 	.append("<option value='dani'>Dani</option>");
			// });
			// var element = document.getElementById("sopir");
			// element.classList.add("form-group");
			$("#judul").empty();
			$("#judul").append("Nama Sopir");
		} else {
			// alert("masuk sana");
			// $("#input_resi").empty().append("<input type='text' class='form-control' id='no_resi' name='no_resi'>");
			$("#judul").empty();
			$("#judul").append("No Resi");
		}
	};

	function setNoEnt1($id) {
		$('#no_ent1').val($id);
	};
</script>
@endsection