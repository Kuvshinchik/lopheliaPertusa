
Напиши блок в файле js для реализации blade-шаблона код которого представляю ниже.  


<!-- cartheader -->
<div class="col-12 col-sm-6 col-md-6 col-lg-5 cart-link ow-right-padding" style="float: right; padding-top: 20px;">
        <img class="svg_new" src="assets/images/svg/cart.svg" alt="cart">
		Товаров (<span class="cart__num" id="cart_num"></span>)
        <div class="cart-dropdown">
            <table>

                @for ($i = 0; $i < count($massivIdTovarInCartUserNumberTwo); $i++)
                <tr>
                    <td class="product-thumb"><a href="#"><img src="assets/images/featured/cart-hover-{{$massivIdTovarInCartUserNumberTwo[$i]}}.png"
                                alt="cart-hover-{{$massivIdTovarInCartUserNumberTwo[$i]}}" /></a></td>
                    <td><a title="{{$massivTovars[$massivIdTovarInCartUserNumberTwo[$i]]['title']}}" href="#"></a></td>
{{--                    <td>кол-во: </td>  --}}
                    <td> ₽</td>
                    <td><a title="close" href="#"><i class="fa fa-close"></i></a></td>
                </tr>
                   
                @endfor
            </table>
            <div class="sub-total">
<!--                <p><span>Sub Total</span> $160.00</p> -->
                <p><span>Итого</span> ₽</p>
            </div>
            <div class="cart-button">
 <!--  -->      <a title="Перейти в корзину" href="{{$userId}}_cartSummary">Перейти в корзину</a>
                <a title="Оплатить" href="#">Оплатить</a>
            </div>
        </div>
</div>
<!-- cartheader/ -->