
	<!-- contactformdetails -->
	<div class="contact-form-details">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12 col-lg-6" style="margin-left: auto; margin-right: auto;">
					<!-- Section Header -->
					<div class="section-header">
						<h3>ПОЖАЛОВАТЬСЯ</h3>
					</div><!-- Section Header /- -->
					<!-- Contact Form -->
					<div class="contact-form">
						<form class="form-horizontal" action="{{route('index')}}" method="POST">
							@csrf
							<div class="form-group row">
								<label for="name" class="col-12 col-md-4">Ваше имя</label>
								<div class="col-12 col-md-8">
									<input type="text" class="form-control" id="name" placeholder="Введите Ваше имя"
										required class="require" name="full_name" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-12 col-md-4">Ваш Email</label>
								<div class="col-12 col-md-8">
									<input type="email" class="form-control" id="txt_email"
										placeholder="Введите Ваш email" required  class="require" name="email"/>
								</div>
							</div>
							<div class="form-group row">
								<label for="comment" class="col-12 col-md-4">Текст обращения</label>
								<div class="col-12 col-md-8">
									<textarea class="form-control" id="comment" rows="2" class="require" name="message"></textarea>
								</div>
							</div>
							<div class="drop-line bottom-shadow"></div>
							<div class="form-group">
								<div class="response"></div>
								<a title="Lipsum dolar sit amet" href="#" class="pull-left submitForm"></a>
								<input type="submit" value="отправить"  name="form_type" class="btn btn-default  pull-right">
							</div>
						</form>
					</div><!-- Contact Form /- -->
				</div>
			</div><!-- Row /- -->
		</div><!-- container /- -->
	</div><!-- contactformdetails /- -->

