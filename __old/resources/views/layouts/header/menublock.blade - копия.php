<!-- menublock -->		
		<div class="menu-block">
			<!-- container -->
			<div class="container">
				<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-static-top">
					<div class="collapse navbar-collapse" id="navbar">
						<ul class="nav navbar-nav">						
{{--$massivRazdelovSayta подтягиватся через route "web.php", который получает этот массив из MenublocksController.php array_keys($massivRazdelovSayta['navigator']) - выводит массив ключей ассоциативного массива--}}											
@for ($i = 0; $i < (count($massivRazdelovSayta['navigator'])); $i++)						
	<li class="nav-item">
		<a title="{{$massivRazdelovSayta['navigator'][array_keys($massivRazdelovSayta['navigator'])[$i]]}}" href="#{{array_keys($massivRazdelovSayta['navigator'])[$i]}}" class="nav-link">{{$massivRazdelovSayta['navigator'][array_keys($massivRazdelovSayta['navigator'])[$i]]}}</a>
	</li>
	
@endfor
						</ul>
					</div><!--/.nav-collapse -->
				</nav>
			</div><!-- container /- -->
		</div>
<!-- menublock/ -->