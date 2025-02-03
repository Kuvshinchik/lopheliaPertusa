<?php

namespace App\Http\Controllers;

use App\Models\Tovar;
use App\Models\Cart;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Traits\massivForViewTrait;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

class AdminUsersController extends Controller
{
    use massivForViewTrait;
    protected $User;
    protected $Cart;
    protected $Tovar;
    protected $Blog;
    protected $alias;
//    public $massivForViewOne;
    public function __construct ($alias=null)  {
        $this->alias = $alias;
        $this->User = new User();
        $this->Tovar = new Tovar();
        $this->Blog = new Blog();
        $this->Cart = new Cart();
    }
    public function execute () {
        //dd($this->tovars());
        return view($this->viewBDtable()['nameView'], $this->viewBDtable());
    }

    public function viewBDtable (){
//dashboard.workoutStatisticIndex - единый шаблон VIEW для страницы каждой соцсети, но со своими данными
//dashboard.tableDatatableBasicIndex - единый шаблон VIEW для всех таблиц БД
//Формируем массив, где именам таблиц в БД соответсвуют нужные данные
//если в БД будут добавлены таблицы, то и сюда нужно будет внести изменения
//!!!В дальнейшем этот массив нужно перенести в .env!!!
	//Массив из ТРЕЙТА через функцию $this->massivForNameTable() 	
	
	$massivForNameTable = $this->massivForNameTable();

	if(in_array($this->alias, ['users', 'tovars', 'carts', 'blogs'])) {
//если alias соответствует названию таблиц в БД, то администратор запросил просто просмотр таблицы
//alias формируется в файле admin.blade.php в ссылке, которую нажал администратор
//первая переменная 'tableDatatableBasic' для подключения скриптов js в шаблоне layouts\admin.blade
//вторая переменная $massivForNameTable[$this->alias][2] для заголовка в dashboard.tableDatatableBasic
//третья переменная $massivForNameTable[$this->alias][3] для breadcrumb в dashboard.tableDatatableBasic
//четвертая переменная 'dashboard.tableDatatableBasicIndex' - вызываемая страница, куда нужны все эти данные
//пятая переменная $this->alias, передает полученный alias, !!!ЗДЕСЬ НЕ ИСПОЛЬЗУЕТСЯ!!!
//шестая переменная $massivForNameTable[$this->alias][1] - это массив двух массивов данных одной из четырех таблиц из БД, !!!НУЖНО ОПТИМИЗИРОВАТЬ!!!

    $massivForViewOne = $this->massivFinal('tableDatatableBasic',$massivForNameTable[$this->alias][2],$massivForNameTable[$this->alias][3],'dashboard.tableDatatableBasicIndex',$this->alias,$massivForNameTable[$this->alias][1]);

	}else{
		return abort(404);
	}
		return $massivForViewOne;
    }


}
