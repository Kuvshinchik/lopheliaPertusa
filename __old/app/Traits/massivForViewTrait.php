<?php

namespace App\Traits;

trait massivForViewTrait
{	
	private function massivFinal ($par1=null, $par2=null, $par3=null, $par4=null, $par5=null, $par6=null, $par7=null){
        //переменная pathAdmin для подключения скриптов js в шаблоне layouts\admin.blade
        return [
            'pathAdmin'=> $par1,
            'namePage'=>$par2,
            'breadcrumb'=>$par3,
            'nameView'=>$par4,
            'alias'=>$par5,
            'zagolovkiAndTovars'=>$par6,
			'massivLoadPicture'=>$par7
        ];

    }
	
	private function massivForNameTable ($massivTable) {
//Формируем массив, где именам таблиц в БД соответсвуют нужные данные
//!!!В дальнейшем этот массив нужно перенести в traits!!!
        return [
            'users'=>['Пользователи', $massivTable, 'Таблица пользователей', ['База данных','Пользователи']],
            'tovars'=>['Товары', $massivTable, 'Таблица товаров', ['База данных','Товары']],
            'carts'=>['Корзины', $massivTable, 'Корзины пользователей', ['База данных','Корзины']],
            'blogs'=>['Блоги', $massivTable, 'Блоги', ['База данных','Блоги']],
        ];
		
	}

/*
    private function tovars (){
        $massivTovars = $this->Tovar->bdtovar();
        //$massivZagolovkiTovars = ['фото товара', 'заголовок', 'текст', 'статус', 'цена', 'категория', 'остаток на складе'];
        $massivZagolovkiTovars = array_keys($massivTovars[0]);
        $massivForViewOne = [$massivTovars, $massivZagolovkiTovars];
        return $massivForViewOne;
    }

    private function users (){
        $massivTovars = $this->User->bdUser();
        //$massivZagolovkiTovars = ['имя', 'e-mail', 'статус'];
        $massivZagolovkiTovars = array_keys($massivTovars[0]);
        $massivForViewOne = [$massivTovars, $massivZagolovkiTovars];
        return $massivForViewOne;
    }

    private function carts (){
        $massivTovars = $this->Cart->bdCart();
        $massivZagolovkiTovars = array_keys($massivTovars[0]);
        $massivForViewOne = [$massivTovars, $massivZagolovkiTovars];
        return $massivForViewOne;
    }

    private function blogs (){
        $massivTovars = $this->Blog->bdBlog();
        $massivZagolovkiTovars = array_keys($massivTovars[0]);
        $massivForViewOne = [$massivTovars, $massivZagolovkiTovars];
        return $massivForViewOne;
    }
*/

}
