
<!-- Feature Product -->
<Section id="featured-products" class="featured-products bottom-shadow">
		<!-- container -->
	<div class="container">
		<!-- Section Header -->
		<div class="section-header">
			<h3>{{$zagalovokViewTovars}}</h3>

		</div><!-- Section Header /- -->

		<div class="category-box-main product-box-main row">

@for ($i = 0; $i < count($massivIdTovar); $i++)

			<div class="col-lg-3 col-md-6 col-12">
				<div class="main-product">
				<div class="category-box product-box">
					<div class="inner-product">
						<img src="{{asset($massivTovars[$massivIdTovar[$i]]['foto'])}}" alt="featured-img" />
						<div class="product-box-inner">						
							<a title="Подробнее" href="/page/{{$massivTovars[$massivIdTovar[$i]]['id']}}" class="btn">Подробнее</a>
						</div>
					</div>
				</div>
				
					<a href="{{ asset('/page')}}/{{$massivTovars[$massivIdTovar[$i]]['id']}}" class="product-title">{{$massivTovars[$massivIdTovar[$i]]['title']}}</a>
				<span class="amount">{{$massivTovars[$massivIdTovar[$i]]['price']}} ₽</span>
			  </div>
			</div>
@endfor

		</div>
	</div><!-- container /- -->
</section>
<!-- Feature Product /- -->
