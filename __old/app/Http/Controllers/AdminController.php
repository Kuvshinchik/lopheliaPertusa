<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //protected $alias;

    public function __construct ()  {
        $Iduser = Auth::id();		
		$massivCartUser = DB::table('users')->where('id', $Iduser)->get()->toArray();		
		if(!(array_key_exists(0, $massivCartUser) && $massivCartUser[0]->level==5)){
			return abort(403);
		}
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

                $massivForViewOne = [
                    //переменная pathAdmin для подключения скриптов js в шаблоне layouts\admin.blade
                    'pathAdmin'=> 'admin',
                    'namePage'=>'Страница администратора',
                    'nameView'=>'dashboard.admin'
                ];

        return $massivForViewOne;
    
}
}
