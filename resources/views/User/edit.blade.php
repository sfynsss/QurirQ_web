@extends('layouts.app')
@section('content')

<div class="card card-bordered card-preview">
	<div class="card-inner">
		<div class="preview-block">
			<span class="preview-title-lg overline-title">Edit User</span>
			<form action="{{url('/updateUser')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="row gy-4">
					<input type="text" name="id_user" value="{{$user->id}}" readonly="" hidden="">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="form-label" for="default-06">Outlet</label>
							<div class="form-control-wrap ">
								<div class="form-control-select">
									<select class="form-control" id="default-06" required name="kd_outlet">
										<option disabled="true" selected="none">Pilih Salah Satu</option>
										@foreach($outlet as $outlet)
										<option value="{{$outlet->kd_outlet}}">{{$outlet->nama_outlet}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="form-label" for="default-01">Nama</label>
							<div class="form-control-wrap">
								<input type="text" class="form-control" id="default-01" placeholder="Input placeholder" value="{{$user->name}}" name="name" required>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="form-label" for="default-01">Email</label>
							<div class="form-control-wrap">
								<input type="text" class="form-control" id="default-01" placeholder="Input placeholder" value="{{$user->email}}" name="email" required>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="form-label" for="default-01">Telepon</label>
							<div class="form-control-wrap">
								<input type="text" class="form-control" id="default-01" placeholder="Input placeholder" value="{{$user->no_telp}}" name="no_telp" required>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="form-label" for="default-01">Password</label>
							<div class="form-control-wrap">
								<input type="password" class="form-control" id="default-01" placeholder="Input placeholder" name="password" required>
							</div>
						</div>
					</div>
				</div>
				<hr class="preview-hr">
				<button type="submit" class="btn btn-success waves-effect text-left">Submit</button>
			</div>
		</form>
	</div>
</div>

@endsection
