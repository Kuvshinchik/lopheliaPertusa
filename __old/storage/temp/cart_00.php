<?php
// Изображение корзины
// и кол-во товара в корзине
function f_korzina_right()
 {
 // подключаемся к базе данных
 require_once("mybaza.php");
 $text1="";
 // проверка существования корзины
 $file1="tmp1/f-".$_SESSION[session]."-".$_SESSION[user].".txt";
 // если нет - создать
 if(!file_exists($file1))
 {
 $fp=fopen($file1,"w");chmod($file1,0777);
 $count=0;$kol=0;$summa=0;
 }
 // если есть, посчитать сумму и кол-во
 else
 {
 $fp=fopen($file1,"r");

 $count=0;$summa=0;
 while($str=fgetcsv($fp,1000,";"))
 {
 $count++;
 $kol+=$str[1];
 $summa+=$str[1]*$str[2];
 }
 }
 $text1.="<center><img id='imgkorzina'
 onmouseover='flag1.over=1;' onmouseout='flag1.over=0;'
 src='img/korzina.jpg'><br>";
 if($count>0) // корзина непустая
 {
 $text1.="<br>Товаров - ".$count;
 $text1.="<br>Кол-во - ".$kol;
 $text1.="<br>".$summa." rub";
 $query1="SELECT usd,eur FROM rate ORDER BY data DESC LIMIT 0, 1 ";
 $rez1=mysql_query($query1);
 $row1=mysql_fetch_assoc($rez1);
 $usd=$row1[usd];$eur=$row1[eur];
 $text1.="<br>".sprintf("%8.2f",$summa/$usd)." usd";
 $text1.="<br>".sprintf("%8.2f",$summa/$eur)." eur";
 $text1.="<br><a href='javascript:void();' onclick='xajax_View_
 Korzina();'>Подробно</a>";
 }
 else // корзина пустая
 {
 $text1.="<br>Корзина пустая";
 }
 $text1.="<center>";
 return $text1;
 }
?>
