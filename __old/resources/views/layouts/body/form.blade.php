<form method="POST" action="{{route('page', ['alias' => $alias])}}" enctype="multipart/form-data">
@csrf
@honeypot
{{--dd($zagalovokViewTovars)--}}
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">
	<p>Спасибо за покупку!</p>
<p>Ваш товар - "{{$nameTovar}}".</p>
<p>Стоимость товара - {{$massivTovars[$alias]['price']}} ₽</p>
</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Напишите Ваш email">
    <div id="emailHelp" class="form-text">После отправки формы на Ваш адрес мы пришлем подтверждение и реквизиты для оплаты.</div>
  </div>
  {{--  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Пароль</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Проверить меня</label>
  </div>
  --}}
  <button type="submit" class="btn btn-primary">Отправить</button>
</form>