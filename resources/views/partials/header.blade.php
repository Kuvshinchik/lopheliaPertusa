<!doctype html>
<html class="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Lophelia Pertusa</title>

	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
	<link href="{{ asset('assets/libraries/bootstrap/bootstrap.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('assets/libraries/fuelux/jquery-ui.min.css') }}">
	<link href="{{ asset('assets/libraries/owl-carousel/owl.carousel.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/libraries/owl-carousel/owl.theme.default.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/libraries/fonts/font-awesome.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/libraries/animate/animate.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/libraries/flexslider/flexslider.css') }}" rel="stylesheet" /> <!-- flexslider -->
	<link href="{{ asset('assets/libraries/magnific-popup.css') }}" rel="stylesheet" /> <!-- Light Box -->
	<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/css/media.css') }}" rel="stylesheet" />
	<link id="color" href="{{ asset('assets/css/color-schemes/default.css') }}" rel="stylesheet" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="js/html5/html5shiv.min.js"></script>
      <script src="js/html5/respond.min.js"></script>
    <![endif]-->

	<link href='http://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic' rel='stylesheet'
		type='text/css'>
	<link
		href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,400italic,300italic,500,500italic,700,700italic,900,900italic'
		rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic,900,900italic'
		rel='stylesheet' type='text/css'>

</head>



<body data-offset="200" data-spy="scroll" data-target=".primary-navigation">
	<!-- LOADER -->
	<!-- <div id="site-loader" class="load-complete">
		<div class="load-position">
			<div class="logo"><img src="images/logo.png" alt="logo"></div>
			<h6>Please wait, loading...</h6>
			<div class="loading">
				<div class="loading-line"></div>
				<div class="loading-break loading-dot-1"></div>
				<div class="loading-break loading-dot-2"></div>
				<div class="loading-break loading-dot-3"></div>
			</div>
		</div>
	</div> -->
	<!-- Loader /- -->

<!--==============================

	Header Area
==============================-->

{{--@include('layouts.header.header')--}}

<!--==============================

	Content Area
==============================-->

@yield('head')

<!--==============================

	Footer Area
==============================-->
{{--
@include('layouts.footer.footer')


@include('layouts.header.headJavascript')--}}

<!-- Footer Section /- -->

	<!-- jQuery Include -->
	
	
	<script src="{{ asset('assets/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false'></script>
	<script src="{{ asset('assets/libraries/gmap/jquery.gmap.min.js') }}"></script> <!-- Light Box -->
	<script src="{{ asset('assets/libraries/jquery.easing.min.js') }}"></script><!-- Easing Animation Effect -->
	<script src="{{ asset('assets/libraries/bootstrap/bootstrap.bundle.min.js') }}"></script> <!-- Core Bootstrap v3.3.4 -->
	<script src="{{ asset('assets/libraries/fuelux/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/libraries/jquery.animateNumber.min.js') }}"></script> <!-- Used for Animated Numbers -->
	<script src="{{ asset('assets/libraries/jquery.appear.js') }}"></script> <!-- It Loads jQuery when element is appears -->
	<script src="{{ asset('assets/libraries/jquery.knob.js') }}"></script> <!-- Used for Loading Circle -->
	<script src="{{ asset('assets/libraries/wow.min.js') }}"></script> <!-- Use For Animation -->
	<script src="{{ asset('assets/libraries/owl-carousel/owl.carousel.min.js') }}"></script> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
	<script src="{{ asset('assets/libraries/expanding-search/modernizr.custom.js') }}"></script> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
	<script src="{{ asset('assets/libraries/flexslider/jquery.flexslider-min.js') }}"></script> <!-- flexslider -->
	<script src="{{ asset('assets/libraries/jquery.magnific-popup.min.js') }}"></script> <!-- Light Box -->
	<!-- Customized Scripts -->
	<script src="{{ asset('assets/js/functions.js') }}"></script>

</body>

</html>
