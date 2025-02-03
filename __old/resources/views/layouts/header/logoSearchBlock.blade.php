<!-- logo-search-block -->
		<div class="logo-search-block">
			<!-- container -->
			<div class="container">
				<div class="row">
						<!-- searchproducts -->
{{-- в дочернем blade оставил пустой div, чтобы верстка не поползла, поэтому не отключать!!! 	--}}
						@include('layouts.header.searchproducts')
						<!-- searchproducts/ -->
					<div class="col-12 col-md-12 col-lg-6 logo-block">
						<a title="Logo" href={{route('index')}}>
 							<img class="img-fluid" src="https://laravelbot.ru/assets/images/logo_Lophelia_Pertus_rastr_02.png" alt="lopheliapertusa">
                        </a>
					</div>
{{-- 					@include('layouts.header.cartheader')	--}}
				</div>
				
			</div><!-- container /- -->
		</div>
		<!-- logo-add-block /- -->