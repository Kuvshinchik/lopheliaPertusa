@php
    /**
     * @var array $massivRazdelovSayta
     *
    */

//dd($massivRazdelovSayta);

    $massivTovars = $massivRazdelovSayta['massivTovars'];
    $massivCart = $massivRazdelovSayta['Cart'];
    $massivIdTovarInCartUserNumberTwo = [];
    $massivUniqueTovarInCart = [];
    //Это индефикатор пользователя, заменить после активации блока авторизации!
    $userId = Auth::id();
	//$userId = 4;
    //Это индефикатор пользователя, заменить после активации блока авторизации!

//формируем массив товаров в корзине покупателя $userId, где ключ это просто индекс, а значение idTovar
    foreach ($massivCart as $key => $value) {
        if($value['idUser'] === $userId){
            array_push($massivIdTovarInCartUserNumberTwo, $massivCart[$key]['idTovar']);
        }

    }
    //dd($massivIdTovarInCartUserNumberTwo);
    /*
     Это массив корзины пользователя номер 2, где ключ - id товара, значение количество
    array:3 [▼ // resources/views/layouts/header/cartheader.blade.php
      1 => 2
      4 => 1
      11 => 1
    ]
     */
//по старой схеме создаем массив количества каждого уникального товара, где ключ idTovar, а значение - сколько единиц этого товара в корзине

 /*
    foreach ($massivIdTovarInCartUserNumberTwo as $key => $value) {
        if(array_key_exists($value, $massivUniqueTovarInCart)){
            $massivUniqueTovarInCart[$value] = $massivUniqueTovarInCart[$value] + 1;
        }else{
                $massivUniqueTovarInCart[$value] = 1;
            }

    }
  */

    //массив ключей $massivUniqueTovarInCart, которые являются id товара в БД товаров
    $arrayKeysTovarInCart = array_keys($massivIdTovarInCartUserNumberTwo);
    //dd($massivUniqueTovarInCart);
    //$zaprosUserCategories = $massivRazdelovSayta[3];


    //$numberIdTovar = +str_replace('_single_product.php', '', $massivRazdelovSayta[3]);
    //$nameCategories = $massivTovars[$numberIdTovar]['categories'];
    //$numberCategories = array_search($nameCategories, $massivCategories);
    //dd($numberCategories);
     //dd($arrayKeysTovarInCart);
    $totalCheckCart = 0;
@endphp
<!-- cartheader -->
<div class="col-12 col-sm-6 col-md-6 col-lg-5 cart-link ow-right-padding" style="float: right; padding-top: 20px;">
        <img class="svg_new" src="assets/images/svg/cart.svg" alt="cart">
		Товаров (<span class="cart__num" id="cart_num">{{count($massivIdTovarInCartUserNumberTwo)}}</span>)
        <div class="cart-dropdown">
            <table>

                @for ($i = 0; $i < count($massivIdTovarInCartUserNumberTwo); $i++)
                <tr>
                    <td class="product-thumb"><a href="#"><img src="assets/images/featured/cart-hover-{{$massivIdTovarInCartUserNumberTwo[$i]}}.png"
                                alt="cart-hover-{{$massivIdTovarInCartUserNumberTwo[$i]}}" /></a></td>
                    <td><a title="{{$massivTovars[$massivIdTovarInCartUserNumberTwo[$i]]['title']}}" href="#">{{$massivTovars[$massivIdTovarInCartUserNumberTwo[$i]]['title']}}</a></td>
{{--                    <td>кол-во: {{$massivUniqueTovarInCart[$arrayKeysTovarInCart[$i]]}}</td>  --}}
                    <td>{{$massivTovars[$massivIdTovarInCartUserNumberTwo[$i]]['price']}} ₽</td>
                    <td><a title="close" href="#"><i class="fa fa-close"></i></a></td>
                </tr>
                    @php
                        $totalCheckCart = $totalCheckCart + $massivTovars[$massivIdTovarInCartUserNumberTwo[$i]]['price'];
                    @endphp
                @endfor
            </table>
            <div class="sub-total">
<!--                <p><span>Sub Total</span> $160.00</p> -->
                <p><span>Итого</span>{{$totalCheckCart}} ₽</p>
            </div>
            <div class="cart-button">
 <!--  -->      <a title="Перейти в корзину" href="{{$userId}}_cartSummary">Перейти в корзину</a>
                <a title="Оплатить" href="#">Оплатить</a>
            </div>
        </div>
</div>
<!-- cartheader/ -->
