@extends('layouts.app')

@section('content')

<div class="nk-block nk-block-lg" id="to-print">
	<div class="invoice">
		<div class="invoice-action">
			{{-- <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" data-toggle="modal"  data-target=".modal_edit"><em class="icon ni ni-plus-fill-c"></em></a> --}}
		</div><!-- .invoice-actions -->
		<div class="invoice-wrap">
			<div class="invoice-head">
				<div class="invoice-contact">
					<span class="overline-title">Nama Customer</span>
					<div class="invoice-contact-info">
						<h4 class="title">{{$mst->NM_CUST}}</h4>
						<ul class="list-plain">
							<li><em class="icon ni ni-map-pin-fill"></em><span>{{$mst->ALM_CUST}}</span></li>
							<li><em class="icon ni ni-emails-fill"></em><span>{{$mst->E_MAIL}}</span></li>
						</ul>
					</div>
				</div>
				<div class="invoice-desc">
					<h4 >Master</h4>
					<ul class="list-plain">
						<li class="invoice-id"><span>No Ent</span>:<br><b>{{$mst->no_ent}}</b></li>
						<li class="invoice-date"><span>Date</span>:<span><br>{{ substr($mst->tanggal, 0, 10) }}</span></li>
					</ul>
				</div>
			</div><!-- .invoice-head -->
			<div class="invoice-bills">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Kode Brg</th>
								<th>Nama Barang</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Sub Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $det)
							<tr>
								<td>{{$det->kd_brg}}</td>
								<td>{{$det->nm_brg}}</td>
								<td>@currency($det->harga)</td>
								<td>{{$det->jumlah}}</td>
								<td>@currency($det->sub_total)</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2"></td>
								<td colspan="2">Subtotal</td>
								<td>@currency($mst->total)</td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td colspan="2">Ongkir</td>
								<td>@currency($mst->ongkir)</td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td colspan="2">Voucher
									@if($mst->kd_voucher != null)
									({{$mst->kd_voucher}})
									@endif
								</td>
								<td>@currency($mst->disc_value)</td>
							</tr>
							<tr>
								<td colspan="2"></td>
								<td colspan="2">Grand Total</td>
								<td>@currency($mst->netto)</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<button type="submit" id="printPageButton" class="btn btn-primary" onclick="window.print()" style="float: right;">Print Invoice</button>
			</div><!-- .invoice-bills -->
		</div><!-- .invoice-wrap -->
	</div>
</div>

@include('penjualan.popUpBarang')
@endsection

@section('script')
<script>
	// function print() {
	// 	var printContents = document.getElementById("print_area").innerHTML;
 //        var originalContents = document.body.innerHTML;
 //        document.body.innerHTML = printContents;
 //        window.print();
 //        document.body.innerHTML = originalContents;
	// }
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

	function setNoEnt($id) {
		$('#no_ent').val($id);
	};

	function tambahDetail($no_ent, $kd_brg, $nm_brg, $satuan, $harga) {
		var no_ent = $no_ent;
		var kd_brg = $kd_brg;
		var nm_brg = $nm_brg;
		var satuan = $satuan;
		var jumlah = "1";
		var harga = $harga;
		var sub_total = $harga;
		var hpp = $harga;
		$.ajax({
			type:'POST',
			url:'/api/insertDetailOrderJual1',
			data:{no_ent:no_ent, kd_brg:kd_brg, nm_brg:nm_brg, satuan:satuan, jumlah:jumlah, harga:harga, sub_total:sub_total, hpp:hpp},
			headers: {
				"Accept":"application/json",
				"Authorization":"Bearer {{Auth::user()->api_token}}"
			},
			success:function(data){
				data['data']['data'].forEach(function(r) {
					console.log(r);
				});
			}
		});
	}
</script>
@endsection