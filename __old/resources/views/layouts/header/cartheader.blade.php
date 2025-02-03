@php
    //dd($massivCartUser[$i]->id);
	$massivIdTovarInCartUserNumberTwo = $massivCartUser;
	$massivKey = array_keys($massivCartUser);
    $totalCheckCart = 0;
	
@endphp
<!-- cartheader 
<div class="col-12 col-sm-6 col-md-6 col-lg-5 cart-link ow-right-padding" style="float: right; padding-top: 20px;">-->
<div class="cart-link ow-right-padding">
		<img class="svg_new" src="{{ asset('assets/images/svg/cart.svg') }}" alt="cart">
		<span> 
		Товаров (
        
		</span>
        
            
		<span id="cart_num"> 
		{{count($massivIdTovarInCartUserNumberTwo)}}
        </span>
		<span> 
		)
        </span>
		<div class="cart-dropdown" id="cart">
           <table id="parentCart">
 
                @for ($i = 0; $i < count($massivCartUser); $i++)
                <tr id="{{$i}}">
                    <td class="product-thumb">
					<a href="{{asset('/page')}}/{{$massivTovars[$massivCartUser[$i]->idTovar]['id']}}">
					<img src="{{ asset('assets/images/featured/cart-hover-' . $massivTovars[$massivCartUser[$i]->idTovar]['id'] . '.png') }}"
                    alt="cart-hover-$massivCartUser[$i]->idTovar}}"/>
					</a>
					</td>
                    <td>
					<a 
					title="{{$massivTovars[$massivCartUser[$i]->idTovar]['title']}}" 
					href="{{asset('/page')}}/{{$massivTovars[$massivCartUser[$i]->idTovar]['id']}}">
					{{mb_substr($massivTovars[$massivCartUser[$i]->idTovar]['title'],  0, 12) . '...'}}
					</a>
					</td>
                     
                    <td>{{$massivTovars[$massivCartUser[$i]->idTovar]['price']}} ₽</td>
                    <td>
					<a title="close" href="{{route('adminTableDelete', ['alias'=>'carts', 'id'=>$massivCartUser[$i]->id])}}">
					<i class="fa fa-close">
					</i>
					</a>
					</td>
                </tr>
                    @php
                        $totalCheckCart = $totalCheckCart + $massivTovars[$massivCartUser[$i]->idTovar]['price'];
                    @endphp
                @endfor
            </table>
            <div class="sub-total">
<!--                <p><span>Sub Total</span> $160.00</p> -->
                <p><span>Итого</span>{{$totalCheckCart}} ₽</p>
            </div>
            <div class="cart-button">
 <!--  -->  {{--    <a title="Перейти в корзину" href="{{$userId}}_cartSummary">Перейти в корзину</a> --}}
                <a title="Оплатить" href="#">Оплатить</a>
            </div>
        </div>
</div>
<!-- cartheader/ -->
