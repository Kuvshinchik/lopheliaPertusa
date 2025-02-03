<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class AdminSocialController extends Controller
{
    protected $alias;

    public function __construct ($alias=null)  {
        $this->alias = $alias;
    }
    public function execute () {
        return view($this->viewSocial()['nameView'], $this->viewSocial());
    }

    public function viewSocial (){
//dashboard.workoutStatisticIndex - единый шаблон VIEW для страницы каждой соцсети, но со своими данными
//dashboard.tableDatatableBasicIndex - единый шаблон VIEW для всех таблиц БД

//Через alias из файла admin.blade.php получаем название соцсети
//Формируем массив, чтобы по полученному имени соцсети добавить нужные для формирования страницы параметры
//!!!В дальнейшем этот массив нужно перенести в .env!!!
if(in_array($this->alias, ['vkontakte', 'pinterest', 'yarmarka', 'telegram'])) {
                $massivNameSocial=['vkontakte' =>'Аналитика ВКонтакте', 'pinterest'=>'Аналитика Pinterest',
                    'yarmarka'=>'Аналитика Ярмарка мастеров', 'telegram'=>'Аналитика Телеграм'];
                $massivForViewOne = [
                    //переменная pathAdmin для подключения скриптов js в шаблоне layouts\admin.blade
                    'pathAdmin'=> 'adminSocial',
                    'namePage'=>$massivNameSocial[$this->alias],
                    'nameView'=>'dashboard.adminSocial',
                    'alias'=>$this->alias
                ];

        return $massivForViewOne;
    }else{abort(404);}
}
}
