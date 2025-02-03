<!-- body.latestfromourblog -->
	<Section id="blog-section" class="blog-section bottom-shadow">
		<!-- container -->
		<div class="container">				
			<div class="row">
				<div class="col-12 col-md-12 col-lg-6 blog-content" style="margin-left: auto; margin-right: auto; ">
				<!-- Section Header -->
				<div class="section-header">
					<h3>Новости из социальных сетей.</h3>
				</div><!-- Section Header /- -->
					<article>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-4 ow-left-padding">
								<a class="post-thumbnail"><img src="{{asset('assets/images/blog')}}/{{$massivBlogsPrev['dateComment']}}/post-thumbnail-1.jpg"
										alt="post-thumbnail" /></a>
							</div>
							<div class="col-md-8 col-sm-8 col-xs-8">
								<header class="entry-header">
									<h2 class="entry-title"><a href="https://vk.com">{{$massivBlogsPrev['title']}}</a></h2>
								</header>
								<footer class="entry-footer">
									<span class="posted-on">
										<span class="sr-only">Дата публикации: </span>
										<a rel="bookmark" href="https://vk.com">
											<span class="entry-date">{{$dateBlogsPrev}}</span>	
										</a>
									</span>	
								</footer>
								<div class="entry-content">
									<p>{{$restPrev}}</p>
								</div>
								<a href="https://vk.com" class="read-more">Подробнее...</a>
							</div>
						</div>
					</article>

					<article>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-4 ow-left-padding">
								<a class="post-thumbnail"><img src="{{asset('assets/images/blog')}}/{{$massivBlogsActual['dateComment']}}/post-thumbnail-2.jpg"
										alt="post-thumbnail" /></a>
							</div>
							<div class="col-md-8 col-sm-8 col-xs-8">
								<header class="entry-header">
									<h2 class="entry-title"><a href="https://vk.com">{{$massivBlogsActual['title']}}</a></h2>
								</header>
								<footer class="entry-footer">
									<span class="posted-on">
										<span class="sr-only">Дата публикации: </span>
										<a rel="bookmark" href="https://vk.com">
											<span class="entry-date">{{$dateBlogsActual}}				
											</span>
										</a>
								</footer>
								<div class="entry-content">
									<p>{{$rest}}</p>
								</div>
								<a href="https://vk.com" class="read-more">Подробнее...</a>
							</div>
						</div>
					</article>
				</div>	
			</div>
		</div> <!-- Container /- -->
	</section>
<!-- body.latestfromourblog /- -->