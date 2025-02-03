<!-- menublock -->		
		<div class="menu-block">
			<!-- container -->
			<div class="container">
				<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-static-top">
					<div class="collapse navbar-collapse" id="navbar">
						<ul class="nav navbar-nav">
@for ($i = 0; $i < (count($massivNavigator)); $i++)						
	<li class="nav-item">
		<a title="{{$massivNavigator[array_keys($massivNavigator)[$i]]}}" href="#{{array_keys($massivNavigator)[$i]}}" class="nav-link">{{$massivNavigator[array_keys($massivNavigator)[$i]]}}</a>
	</li>
	
@endfor
						</ul>
					</div><!--/.nav-collapse -->
				</nav>
			</div><!-- container /- -->
		</div>
<!-- menublock/ -->