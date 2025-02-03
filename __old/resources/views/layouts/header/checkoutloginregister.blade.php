<!-- checkoutloginregister -->

				<div class="col-12 col-md-12 col-lg-6 ow-right-padding  ow-right-padding2 d-flex align-content-center justify-content-end">
<!--						<ul class="top-menu">
 						<li><a title="My whishlist" href="#">My whishlist</a></li>
							<li><a title="CheckOut" href="#">CheckOut</a></li>
						</ul> -->
                    @auth

                        <ul class="top-menu">
						<li>
							
							@include('layouts.header.cartheader')
							
							</li>
                            <li><a title="{{Auth::user()->name}}" href="login">{{Auth::user()->name}}</a></li>

                        </ul>
                    @endauth
                    @guest
						<ul class="top-menu">
							<li>
							
							@include('layouts.header.cartheader')
							
							</li>
							<li><a title="Войти" href="login">Войти</a></li>
							<li><a title="Регистрация" href="register">Регистрация</a></li>
						</ul>
                    @endguest
				</div>

<!-- checkoutloginregister /-->

