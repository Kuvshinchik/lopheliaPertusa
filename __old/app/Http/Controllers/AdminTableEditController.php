<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class AdminTableEditController extends Controller
{
    use massivForViewTrait;
    protected $User;
    protected $Cart;
    protected $Tovar;
    protected $Blog;
    protected $alias;
	protected $id;
	
    public function __construct ($alias=null)  
	{
        $this->alias = $alias;
        $this->User = new User();
        $this->Tovar = new Tovar();
        $this->Blog = new Blog();
        $this->Cart = new Cart();
		if(!empty($_GET['id'])){
			$this->id = $_GET['id'];
		}else{
			$this->id = null;
			}
    }
    public function execute () 
	{
       // dd($this->viewBDtable());
        return view($this->viewBDtable()['nameView'], $this->viewBDtable());
    }

    public function viewBDtable ()
    {
//Это массив из Базы данных, в соответсвии с запросом либо 'users', либо 'id', либо 'tovars', или 'blogs'
//Массив далее используется в трейте massivForViewTrait.php

	$massivTable = $this->massivTable();

	
//Это массив, где именам таблиц в БД соответсвуют нужные данные
//Прописан в Трейте massivForViewTrait
    $massivForNameTable=$this->massivForNameTable($massivTable);
	
	//$massivForNameTable[$this->alias][1]['massivLoadPicture'] = $this->imageRender();	
//если alias соответствует названию таблиц в БД, то администратор запросил просто просмотр таблицы
//alias формируется в файле admin.blade.php в ссылке, которую нажал администратор
//первая переменная 'tableDatatableBasic' для подключения скриптов js в шаблоне layouts\admin.blade
//вторая переменная $massivForNameTable[$this->alias][2] для заголовка в dashboard.tableDatatableBasic
//третья переменная $massivForNameTable[$this->alias][3] для breadcrumb в dashboard.tableDatatableBasic
//четвертая переменная 'dashboard.tableDatatableBasicIndex' - вызываемая страница, куда нужны все эти данные
//пятая переменная $this->alias, передает полученный alias, !!!ЗДЕСЬ НЕ ИСПОЛЬЗУЕТСЯ!!!
//шестая переменная $massivForNameTable[$this->alias][1] - это массив двух массивов данных одной из четырех таблиц из БД, !!!НУЖНО ОПТИМИЗИРОВАТЬ!!!
//шестая переменная $this->imageRender() - массив имен загруженных картинок в соответствующей папке, актуален в этом проекте пока только для товаров, в дальнейшем и для блога, но нужно будет изменить адрес размещения картинок
//Прописан в Трейте massivForViewTrait
if($this->alias == 'tovars'){
	$massivForViewOne = $this->massivFinal('adminTable',$massivForNameTable[$this->alias][2],$massivForNameTable[$this->alias][3],'dashboard.adminTableEdit',$this->alias,$massivForNameTable[$this->alias][1], $this->imageRender());
}else{
	$massivForViewOne = $this->massivFinal('adminTable',$massivForNameTable[$this->alias][2],$massivForNameTable[$this->alias][3],'dashboard.adminTableEdit',$this->alias,$massivForNameTable[$this->alias][1]);
}
    

 return $massivForViewOne;   
	}
	
private function  massivTable() {
	//если в БД будут добавлены таблицы, то и сюда нужно будет внести изменения

        if (in_array($this->alias, ['users', 'tovars', 'carts', 'blogs'])) {
			if (isset($_GET['id'])){
				if ($this->alias == 'users') {
					$massivTable = User::find($_GET['id'])->toArray();
				} elseif ($this->alias == 'tovars') {
					$massivTable = Tovar::find($_GET['id'])->toArray();
				} elseif ($this->alias == 'carts') {
					$massivTable = Cart::find($_GET['id'])->toArray();
				} elseif ($this->alias == 'blogs') {
					$massivTable = Blog::find($_GET['id'])->toArray();
				}
				return $massivTable;
			}else{return abort('404');}
		}else{return abort('404');}
		
    }
	
	private function imageRender () {
		//отображение загруженных картинок
		$papkaForZapisi = +$this->id;
		$pathPicture = './assets/images/single-product/' . $papkaForZapisi;
		$massivScandir2 = scandir($pathPicture);
		$massivScandir = []; 
		foreach ($massivScandir2 as $key=>$value){
    if (str_contains($value, 'product-thumb')){
		array_push($massivScandir, $value);
		}
	}
	if($this->alias == 'tovars'){
		return $massivScandir;
	}else{return false;}
		
		//return $massivImageForRender;
}

}
