	<a id="top"></a>
<!-- Header Section -->
	<header id="header" class="header">
<!-- top-header -->
		<div class="top-header">
			<!-- container -->
			<div class="container">
				<div class="row">
					<!-- facebooktwittergoogleheader -->
				@include('layouts.header.facebooktwittergoogleheader')
					<!-- facebooktwittergoogleheader/ -->
					
                    <!-- checkoutloginregister -->
					
					@include('layouts.header.checkoutloginregister')
				{{--
				перенес в layouts.header.checkoutloginregister
				@include('layouts.header.cartheader')
				--}}
					<!-- checkoutloginregister/ -->
					
				</div>
			</div><!-- container /- -->
		</div><!-- top-header /- -->
		@include('layouts.header.logoSearchBlock')
		
	</header>
	<!-- Header Section /- -->
