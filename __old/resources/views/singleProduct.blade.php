@extends('layouts.header.head')

@section('head')

{{--@include('layouts.header.head')--}}
{{-- массив всех товаров
dd($massivTovars)--}}
<!-- Single Product -->

<section class="justify-content-center align-items-center" style="display: flex">
	<div class="col-12 col-md-12 col-lg-5 single-product-sidebar">
		<div class="container">
				<div class="page-breadcrumb">
					<ol class="breadcrumb">
						<li><a title="Home" href={{route('index')}}>Home</a></li>
						<li><a title="Категория" href="{{ asset('/categories')}}/{{$numberCategories}}">{{$nameCategories}}</a></li>
<li><a title="Товар" href="{{$alias}}">{{$nameTovar}}</a></li>

					</ol>

				</div>
			@include('layouts.body.carouselProductSingle')
			<br><br>
			<div class="card" style="width: 50%;">
				<h3 class="card__caption">{{$nameTovar}}</h3>
				<span class="amount card__title">{{$nameContent}}</span><br><br>
				<h3>Стоимость</h3>
				<span class="amount card__price--common">{{$massivTovars[$alias]['price']}} ₽</span><br><br>
				
				<button type="button" class="btn btn-secondary card__add">В корзину</button>
			
			
			{{--	
				<button type="button" class="btn btn-secondary card__add" data-bs-toggle="modal" data-bs-target="#exampleModal{{$alias}}">>В корзину</button>
				
								@include('layouts.body.modal') --}}	
			
			
			</div>
		</div>
	</div>
</section><br><br>
@include('layouts.footer.footer')
@endsection

{{----}}
