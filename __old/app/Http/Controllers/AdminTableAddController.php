<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Blog;
use App\Models\User;
use App\Models\Tovar;
use Illuminate\Http\Request;
use App\Traits\massivForViewTrait;

/*



use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
*/

class AdminTableAddController extends Controller
{
    use massivForViewTrait;
    protected $alias;
    protected $request;
	protected $User;
    protected $Tovar;
	protected $Blog;
    protected $Cart;

    public function __construct ($alias=null, $request=null)  {
        $this->alias = $alias;
		$this->request = $request;
		
        $this->User = new User();
        $this->Tovar = new Tovar();
        $this->Blog = new Blog();
        $this->Cart = new Cart();	
    }

	public function execute () {
		/*
		if($this->request){
			$massivScandir = scandir('./assets/images/single-product/1');
			$nameFile_1 = 'product-large-' . (count($massivScandir)-3) . '.jpg';
			$nameFile_2 = 'product-thumb-' . (count($massivScandir)-3) . '.jpg';
			$file = $this->request->file('file');
            $uploaddir_1 = public_path() . '/assets/images/single-product/1/';
			$uploaddir_2 = public_path() . '/assets/images/single-product/1/thumb/';
            $uploadfile_1 = $uploaddir_1 . $nameFile_1;
			$uploadfile_2 = $uploaddir_2 . $nameFile_2;
			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile_1);
			copy($uploadfile_1, $uploadfile_2);

		}
		*/
        return view($this->viewBDtable()['nameView'], $this->viewBDtable());
    }

    public function viewBDtable ()
    {
//Это массив из Базы данных, в соответсвии с запросом либо 'users', либо 'id', либо 'tovars', или 'blogs'

	$massivTable = $this->massivTable();

	
//Это массив, где именам таблиц в БД соответсвуют нужные данные
//Прописан в Трейте massivForViewTrait
    $massivForNameTable=$this->massivForNameTable($massivTable);
		
//если alias соответствует названию таблиц в БД, то администратор запросил просто просмотр таблицы
//alias формируется в файле admin.blade.php в ссылке, которую нажал администратор
//первая переменная 'tableDatatableBasic' для подключения скриптов js в шаблоне layouts\admin.blade
//вторая переменная $massivForNameTable[$this->alias][2] для заголовка в dashboard.tableDatatableBasic
//третья переменная $massivForNameTable[$this->alias][3] для breadcrumb в dashboard.tableDatatableBasic
//четвертая переменная 'dashboard.tableDatatableBasicIndex' - вызываемая страница, куда нужны все эти данные
//пятая переменная $this->alias, передает полученный alias, !!!ЗДЕСЬ НЕ ИСПОЛЬЗУЕТСЯ!!!
//шестая переменная $massivForNameTable[$this->alias][1] - это массив двух массивов данных одной из четырех таблиц из БД, !!!НУЖНО ОПТИМИЗИРОВАТЬ!!!
//Прописан в Трейте massivForViewTrait

    $massivForViewOne = $this->massivFinal('adminTable',$massivForNameTable[$this->alias][2],$massivForNameTable[$this->alias][3],'dashboard.adminTableAdd',$this->alias,$massivForNameTable[$this->alias][1]);

 return $massivForViewOne;   
	}
private function  massivTable() {
	//если в БД будут добавлены таблицы, то и сюда нужно будет внести изменения

        if (in_array($this->alias, ['users', 'tovars', 'carts', 'blogs'])) {

            if ($this->alias == 'users') {
                $massivTable = User::all()->first()->toArray();
            } elseif ($this->alias == 'tovars') {
                $massivTable = Tovar::all()->first()->toArray();
            } elseif ($this->alias == 'carts') {
                $massivTable = Cart::all()->first()->toArray();
            } elseif ($this->alias == 'blogs') {
                $massivTable = Blog::all()->first()->toArray();
            }
			
		}
		return $massivTable;
    }

}
