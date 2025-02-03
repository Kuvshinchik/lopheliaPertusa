@php
/**
*@var array $massivRazdelovSayta
*@var array $massivUsers
*/
//
//	dd($massivIdTovar);
/*
//массив $massivIdTovar корзины активного покупателя
array:4 [▼ // resources/views/layouts/body/cartSummary.blade.php
  0 => 1
  1 => 1
  2 => 4
  3 => 11
]
*/
$userId = Auth::id();
@endphp

@include('layouts.header.headCss')
	<!-- Page Breadcrumb -->
	<!-- container -->
	<div class="container">
		<div class="page-breadcrumb">
			<ol class="breadcrumb">
				<li><a title="Home" href="home">Home</a></li>
				<li class="active">Корзина</li>
			</ol>
			<div class="return-home-link pull-right">
				<a title="Return Home Page " href="index.php">Home</a>
			</div>
		</div>
		<div class="page-header bottom-shadow">
			<h3>Оформление товара</h3>
			<p>Корзина покупателя {{$massivUsers['name']}} </p>
		</div><!-- Section Header /- -->
	</div><!-- container /- -->
	<!-- Page Breadcrumb /- -->

	<div class="page-wizard page-wizard1">
		<!-- container -->
		<div class="container">
			<ul class="bottom-shadow">
                <li title="Home"><a href="/">Главная</a></li>
                <li title="Корзина" class="active"><a href="{{$massivUsers['id']}}_cartSummary.php">Корзина</a></li>
				<li title="Способ доставки"><a href="{{$massivUsers['id']}}_Shipping_Address.php">Способ доставки</a></li>
				<li title="Оплата"><a href="{{$massivUsers['id']}}_payment.php">Оплата</a></li>
                <li title="Отзыв"><a href="{{$massivUsers['id']}}_otziv.php">Оставить отзыв</a></li>
			</ul>
			<!-- contact-form-details -->
			<div class="contact-form-details">
				
				<div class="contact-form order-summart-text bottom-shadow">
					<h2>Примечание.</h2>
					<p>Проверьте содержимое корзины. При необходимости Вы можете удалить или добавить товары. Если Вы окончательно определились с покупками, то можете перейти к следующему этапу - выбор способа доставки.</p>
				</div>
				<div class="section-header">
					<h3>Ваша корзина</h3>
				</div>
			</div><!-- Contact Form Details /- -->


			<!-- Shopping-cart-table -->
			<div class="shopping-cart-table bottom-shadow">
				<table class="shop_table cart">
					<thead>
						<tr>
							<th class="product-name">Продукт</th>
							<th class="product-description">Категория</th>
							<th class="product-brand">Название</th>
							<th class="blank-space">Описание</th>
							<th class="product-size">Удалить товар</th>
							<th class="product-size">Добавить еще такой же товар</th>
							<th class="product-quantity">Остаток на складе</th>
							<th class="product-price">Цена</th>
						</tr>
					</thead>
					<tbody>
@php
//$idTovarInCart = $massivIdTovar[3];
//возращает ключ найденного эллемента
//dd($massivRazdelovSayta['massivTovars']);
//$keyMassivTovars = array_search($idTovarInCart, $massivRazdelovSayta['massivTovars']);
//$massivRazdelovSayta['massivTovars'] массив всех товаров
//dd($keyMassivTovars);
$totalSumm = 0;
@endphp	
				
@for ($i = 0; $i < count($massivIdTovar); $i++)

						<tr>
							<td data-title="Product" class="product-tdumbnail">
								<a title="Summary" href="/{{$massivIdTovar[$i]}}_single_product.php"><img src="assets/images/summary/summary-{{$massivIdTovar[$i]}}.png" alt="summary" /></a>
							</td>
							<td data-title="Description" class="product-description">
								<a title="Order No" href="/{{$i}}_categories.php">
									<b>{{$massivRazdelovSayta['massivTovars'][$massivIdTovar[$i]-1]['categories']}}</b>									
								</a>
							</td>
							<td data-title="brand" class="product-brand">
								<span>{{$massivRazdelovSayta['massivTovars'][$massivIdTovar[$i]-1]['title']}}</span>								
							</td>
							<td data-title="Color" class="blank-space">
								<span>{{$massivRazdelovSayta['massivTovars'][$massivIdTovar[$i]-1]['content']}}</span>
							</td>
							<td>
								<span>		
								<a title="Delete" href="/{{$massivIdTovar[$i]}}_delete_product.php">
								<img src="assets/images/svg/close-svgrepo-com.svg" alt="delete" style="width: 28px;"/>
								</a>
								</span>
							</td>
							<td>
							<span>	
								<a title="plusProduct" href="/{{$massivIdTovar[$i]}}_sale_product.php">
								<img src="assets/images/svg/cart.svg" alt="plusProduct"  style="width: 28px;"/>
								</a>
								</span>
							</td>
							<td data-title="Quantity" class="product-quantity">
								<div class="quantity">
								{{$massivRazdelovSayta['massivTovars'][$massivIdTovar[$i]-1]['nasklade']}}									
								</div>
							</td>
							<td data-title="Price" class="product-price">
								<span class="amount">{{$massivRazdelovSayta['massivTovars'][$massivIdTovar[$i]-1]['price']}} ₽</span>
							</td>
						</tr>
@php
$totalSumm = $totalSumm + $massivRazdelovSayta['massivTovars'][$massivIdTovar[$i]-1]['price'];
@endphp	
@endfor


						</tr>
					</tbody>
				</table>
				<div class="row">
					<div class="product-content col-12 col-md-12 col-lg-8">
						<h3 class="block-title">Дисконтная политика.</h3>
						<p>Для получения привелигированного статуса Вам необходимо подключиться к дисконтной программе. Вы получите уведомление на электронный адрес с описанием условий участия и размера вознаграждений.</p>
					</div>
					<div class="product-total-price col-12 col-md-12 col-lg-4">
						<table>
							<tbody>
								<tr class="cart-subtotal">
									<th>Итого без скидок.</th>
									<td><span class="amount">{{$totalSumm}} ₽</span></td>
								</tr>
								<tr class="shipping">
									<th>Ваши скидки.</th>
									<td><span class="amount">-00.00 ₽</span></td>
								</tr>
								<tr class="order-total">
									<th>Итого</th>
									<td><strong><span class="amount">{{$totalSumm}} ₽</span></strong> </td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="wizard-footer">
				<a title="Back" href="/" class="btn btn-next btn-fill btn-warning btn-wd btn-sm">Главная</a>
				<a title="Continue" href="dostavka.php"
					class="btn btn-next btn-fill btn-warning btn-wd btn-sm">Доставка</a>
			</div>
		</div>
	</div>
@include('layouts.header.headJavascript')
