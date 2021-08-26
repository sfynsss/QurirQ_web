@extends('layouts.app')

@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail Order Penjualan</h5>
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
								<label class="form-label" for="default-01">No Resi</label>
								<div class="form-control-wrap" id="input_resi">
									<input type="text" class="form-control" id="no_resi" name="no_resi">
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
				<h3 class="nk-block-title page-title">Order Penjualan</h3>
			</div><!-- .nk-block-head-content -->
			<div class="nk-block-head-content">
				<div class="toggle-wrap nk-block-tools-toggle">
					<a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
					<div class="toggle-expand-content" data-content="pageMenu">
						<ul class="nk-block-tools g-3">
							<li>
								<div class="drodown">
									<a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
									<div class="dropdown-menu dropdown-menu-right">
										<ul class="link-list-opt no-bdr">
											<li><a href="#"><span>Last 30 Days</span></a></li>
											<li><a href="#"><span>Last 6 Months</span></a></li>
											<li><a href="#"><span>Last 1 Years</span></a></li>
										</ul>
									</div>
								</div>
							</li>
							<li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
						</ul>
					</div>
				</div>
			</div><!-- .nk-block-head-content -->
		</div><!-- .nk-block-between -->
	</div>
	<div class="col-xxl-12">
		<div class="card card-bordered card-full">
			<div class="card-inner">
				<div class="card-title-group">
					<div class="card-title">
						<h6 class="title"><span class="mr-2">Transaction</span> <a href="#" class="link d-none d-sm-inline">See History</a></h6>
					</div>
					<div class="card-tools">
						<ul class="card-tools-nav">
							<li><a href="#"><span>Paid</span></a></li>
							<li><a href="#"><span>Pending</span></a></li>
							<li class="active"><a href="#"><span>All</span></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-inner p-0 border-top">
				<div class="nk-tb-list nk-tb-orders">
					<div class="nk-tb-item nk-tb-head">
						<div class="nk-tb-col"><span>Order No.</span></div>
						<div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
						<div class="nk-tb-col tb-col-md"><span>Date</span></div>
						<div class="nk-tb-col"><span>Total</span></div>
						<div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
						<div class="nk-tb-col"><span>&nbsp;</span></div>
					</div>
					@foreach($data as $data)
					<div class="nk-tb-item">
						<div class="nk-tb-col">
							<span class="tb-lead"><a href="#">{{$data->NO_ENT}}</a></span>
						</div>
						<div class="nk-tb-col tb-col-sm">
							<div class="user-card">
								<div class="user-name">
									<span class="tb-lead">{{$data->NM_CUST}}</span>
								</div>
							</div>
						</div>
						<div class="nk-tb-col tb-col-md">
							<span class="tb-sub">{{substr($data->TANGGAL, 0, 10)}}</span>
						</div>
						<div class="nk-tb-col">
							<span class="tb-sub tb-amount">@currency($data->TOTAL)</span>
						</div>
						<div class="nk-tb-col">
							@if($data->PROSES == null)
							<span class="badge badge-dot badge-dot-xs badge-danger">Order</span>
							@elseif($data->PROSES == "JUAL")
							<span class="badge badge-dot badge-dot-xs badge-success">Penjualan</span>
							@endif
						</div>
						<div class="nk-tb-col nk-tb-col-action">
							@if($data->PROSES == null)
							<div class="dropdown">
								<a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
									<ul class="link-list-plain">
										<li><a href="{{url('detailOrder')}}/{!! str_replace('/', '-', $data->NO_ENT) !!}">Detail</a></li>
									</ul>
								</div>
							</div>
							@endif
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

	function setNoEnt($id) {
		$('#no_ent').val($id);
	};
</script>
@endsection