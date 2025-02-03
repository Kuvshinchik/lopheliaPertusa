@php
use App\Models\MailPertusa;

$mail = new MailPertusa("laravelbot@laravelbot.ru"); // Создаём экземпляр класса
$mail->setFromName("Иван Иванов"); // Устанавливаем имя в обратном адресе
if ($mail->send("maseykinav@dzvr.ru", "Тестирование", "Тестирование<br /><b>письма<b>")) echo "Письмо отправлено";
else echo "Письмо не отправлено";

/*
//$to  = "<qwelle09@yandex.ru> ";
$to  = "<maseykinav@dzvr.ru> " ; 
//$to  = "<m7208231@yandex.ru>"; 
//$to .= "<laravelbot@laravelbot.ru> ";
$subject = "PROBA"; 
$message = ' <p>PROBA</br>'."\r\n";
$message .= ' Покупатель с почтовым адресом: </br>'."\r\n";
//$message .= '' .$new_zakupka.'';
$message .= '</br>заказал '."\r\n";
//$message .= ''.$name_01.'';
$message .= '!</br>Артикул заказанного товара - ';
//$message .=''.$articul_01.''."\r\n";
$message .= '</br>IP покупателя - ';
//$message .= ''.$ip.''."\r\n";
$message .= '</p>';

//$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
$headers  = "Content-type: text/html; charset=".'utf-8'."\r\n"; 
$headers .= "From:<laravelbot@laravelbot.ru"; 
//$headers .= "Reply-To: reply-to@example.com\r\n";
mail($to, $subject, $message, $headers);*/
@endphp
	
<h1>Здравствуйте Иван Иванов!</h1>
	<p>
		Уважаемый покупатель, заказ принят и ему присвоен номер <strong>1953</strong>.
		<br />Используйте этот номер для уточнения заказа.
		<br />Пожалуйста проверьте информацию ниже и в случае ошибки свяжитесь с нами.
	</p>
	<ul>
		<li><strong>Имя:</strong> Иван Иванов</li>
		<li><strong>E-mail:</strong> ivan@site.com</li>
		<li><strong>Способ доставки:</strong> самовывоз</li>
	</ul>
	<h2>Данные о товарах:</h2>
	<table>
		<thead>
			<tr>
				<th>№</th>
				<th>Наименование товара</th>
				<th>Кол-во</th>
				<th>Цена</th>
				<th>Сумма</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="text-align: center;">1</td>
				<td>
					Настенный газовый котел Buderus Logamax U072-12K 7736900359RU
					<br>Артикул: 7736900359RU
				</td>
				<td style="text-align: center;">2 шт.</td>
				<td style="text-align: center;">30 0000 руб.</td>
				<td style="text-align: center;">60 0000 руб.</td>
			</tr>
		</tbody>
	</table>
	<h4>ИТОГО: 60 0000 руб.</h4>
	<hr>
	<p>
		С уважением, Site.com
		<br><a href="http://site.com">http://site.com</a>
	</p>
 