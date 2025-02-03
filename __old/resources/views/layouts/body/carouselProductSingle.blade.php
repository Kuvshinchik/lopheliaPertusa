
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="width: 50%!important;">
  <div class="carousel-inner">
  @for ($i = 0; $i < $countKatalogs; $i++)
	@if($i == 0)
    <div class="carousel-item active">
      <img src="{{ asset('assets/images/single-product')}}/{{$alias}}/product-large-0.jpg" class="d-block card__image" alt="product-large-0">
    </div>
	@else
    <div class="carousel-item">
      <img src="{{ asset('assets/images/single-product')}}/{{$alias}}/product-large-{{$i}}.jpg" class="d-block card__image" alt="product-large-{{$i}}">
    </div>
	@endif
	@endfor
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="left: -85px;">
    <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url({{ asset('assets/images/icon/circle_left.png')}}); width: 3rem; height: 3rem;"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="right: -85px;">
    <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url({{ asset('assets/images/icon/circle_right.png')}}); width: 3rem; height: 3rem;"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


