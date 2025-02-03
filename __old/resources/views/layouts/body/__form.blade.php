{{--<section id="form">--}}
	<div class="container text-center wow fadeInDown">
		<div class="row_00">
			<div class="col-md-12">
				<h2>Спасибо за покупку!</h2>
		
	@php	$vibran_tovar = 'Ваша покупка &quot;'.$alias.'&quot' @endphp	
				<p class="large">{{$vibran_tovar}}</p>
				<img src="images/{{$alias}}/1.jpg" class="w_100" alt="">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="section-form wow zoomIn">
					<form id="myForm" action="#" method="POST" ">
						<div class="row">
							<div class="form-group col-md-12">
								<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="напишите Ваш Email">
								<input type="hidden" name="name_tovar" value="{{$alias}}">
								<input type="hidden" name="articul_tovar" value="{{$alias}}">
								<small id="emailHelp" class="form-text text-muted">После отправки формы на Ваш адрес мы пришлем подтверждение и реквизиты для оплаты.</small>
								</div>
						</div>
								<input type="submit" value="Купить" class="btn btn-primary">
					</form>
				</div>
			</div>
		</div>
	</div>
	{{--</section>--}}







	