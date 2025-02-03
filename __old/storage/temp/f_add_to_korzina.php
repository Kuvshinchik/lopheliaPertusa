<?php
function f_add_to_korzina($Id)
 {
 $text1="no";
 // подключаемся к базе данных
 require_once("mybaza.php");
 // открываем файл корзины
 $file1="tmp1/f-".$_SESSION[session]."-".$_SESSION[user].".txt";
 $fp=fopen($file1,"r");
 $tofile='';$kol=1;
 // считываем данные
 while($str=fgetcsv($fp,1000,";"))
 {
 $tofile1=implode($str,";")."\r\n";
 // есть такой товар
 if($str[0]==$Id)
 {
 $text1='yes';
 $kol=$str[1]+1;
 }
 // нет такого товара
 // запоминаем в новый контент строки

 else
 $tofile.=$tofile1;
 }
 //if($text1=='no')
 //{
 $query1="SELECT pay_rub,new_pay_rub FROM tovars WHERE id=".$Id." ";
 $query2="SELECT discount FROM users WHERE id='".$_SESSION[user]."' ";
 $discount=mysql_result(mysql_query($query2),0);
 if(mysql_result(mysql_query($query1),0,"new_pay_rub")>0)
 $pay_rub=mysql_result(mysql_query($query1),0,"new_pay_rub");
 else
 $pay_rub=mysql_result(mysql_query($query1),0,"pay_rub");
 // цена сразу считается по скидке
 $pay_rub=trim(sprintf("%10.2f",$pay_rub*(100-$discount)/100));
 // добавляем в новый контент строки
 $tofile.=$Id.";".$kol.";".$pay_rub."\r\n";
 //}
 fclose($fp);
 // запись новых данных в файл корзины
 $fp=fopen($file1,"w");
 fwrite($fp,$tofile);
 fclose($fp);
 return $text1;
 }
?>