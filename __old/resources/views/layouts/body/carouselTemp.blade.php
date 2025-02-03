<!-- Slider Section 

-->

	<div id="slider-section" class="slider-section">
		<div id="carouselexamplegeneric" class="carousel slide slider-indexone" data-bs-ride="carousel">
			<!-- Indicators -->
			<div class="carousel-indicators">
			
@for ($i = 0; $i < $countKatalogs; $i++)						
	@if($i == 0)
	<button	type="button" data-bs-target="#carouselexamplegeneric" data-bs-slide-to="{{$i}}" class="active"></button>
	@else
		<button type="button" data-bs-target="#carouselexamplegeneric" data-bs-slide-to="{{$i}}"></button>
	@endif

@endfor					
			</div>
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
			
@for ($i = 0; $i < $countKatalogs; $i++)						
@if($i == 0)
	<div class="carousel-item active">
		<img src="assets/images/single-product/{{$numberIdTovar}}/product-large-{{$i}}.jpg" alt="product-large-{{$i}}">
		<div class="container">	
		</div>
	</div>
@else
	<div class="carousel-item">
		<img src="assets/images/single-product/{{$numberIdTovar}}/product-large-{{$i}}.jpg" alt="product-large-{{$i}}">
		<div class="container">				
		</div>
	</div>
@endif
@endfor					
				
			</div>
			<!-- Controls -->
			<a title="Previous" class="carousel-control-prev" data-bs-target="#carouselexamplegeneric" role="button"
				data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</a>
			<a title="Next" class="carousel-control-next" data-bs-target="#carouselexamplegeneric" role="button"
				data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</a>
		</div>
	</div>
	
<!-- Slider Section /- -->
