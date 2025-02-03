<?php
// Добавить товар в корзину
function Add_To_Korzina($Id)
 {
 $objResponse = new xajaxResponse();
 $objResponse->assign("flag_ajax","value",'yes');
 // добавить товар в корзину
 $content=f_add_to_korzina($Id);

 if($content=='no')
 {
 // получить контент для корзины
 $content1=f_korzina_right();
 // запустить javascript – если корзина подробно видна
 // изменить ее содержимое
 $script2="if(document.forms.Flags.flag_korzina.value=='yes')";
 $script2.="{xajax_View_Korzina();}";
 $objResponse->script($script2);
 $objResponse->assign("right2","innerHTML",$content1);
 // перенести видимость на блок корзины
 $objResponse->script("document.getElementById
 ('right2').scrollIntoView();");
 }
 else
 $objResponse->alert("Такой товар уже есть в корзине !!!");
 $objResponse->assign("flag_ajax","value",'no');
 return $objResponse;
 }
?>
