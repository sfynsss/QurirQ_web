@extends('layouts.attr2')

@section('content')

<section id="wrapper" class="error-page">
	<div class="error-body text-center">
		<h1>{{$data}}</h1>
		<h3 class="text-uppercase" style="color: black;"> {{$data1}}</h3>
		{{-- <p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p> --}}
		{{-- <a href="index.html" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div> --}}
		<footer class="footer text-center">© 2021 Larisso Group.</footer>
	</div>
</section>

@endsection