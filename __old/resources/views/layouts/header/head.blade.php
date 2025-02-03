<!doctype html>
<html class="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Lophelia Pertusa</title>

	@include('layouts.header.headCss')

</head>

<body data-offset="200" data-spy="scroll" data-target=".primary-navigation">

<!--==============================

	Header Area
==============================-->

@include('layouts.header.header')

<!--==============================

	Content Area
==============================-->

@yield('head')

<!--==============================

	Footer Area
==============================-->
{{--
@include('layouts.footer.footer')
--}}

@include('layouts.header.headJavascript')

</body>

</html>
