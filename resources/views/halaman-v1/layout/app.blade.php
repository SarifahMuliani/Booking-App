<!DOCTYPE html>
<html lang="">
<!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link href="{{asset('home-v1/layout/styles/layout.css')}}" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
	<?php 
	$profil=DB::table('profil')->get();
	?>
	@foreach($profil as $pf)
	@include('halaman-v1/layout/sidebar')


	@yield('content')

	@include('halaman-v1/layout/footer')
	@endforeach
	<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
	<script src="{{asset('home-v1/layout/scripts/jquery.min.js')}}"></script>
	<script src="{{asset('home-v1/layout/scripts/jquery.backtotop.js')}}"></script>
	<script src="{{asset('home-v1/layout/scripts/jquery.mobilemenu.js')}}"></script>
	<script src="{{asset('home-v1/layout/scripts/jquery.easypiechart.min.js')}}"></script>
</body>
</html>