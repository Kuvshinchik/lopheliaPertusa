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
use Illuminate\Support\Facades\URL;

class AdminTableDeleteController extends Controller
{
    use massivForViewTrait;
    protected $User;
    protected $Cart;
    protected $Tovar;
    protected $Blog;
    protected $alias;

    public function __construct ($alias=null)  
	{
        $this->alias = $alias;
        $this->User = new User();
        $this->Tovar = new Tovar();
        $this->Blog = new Blog();
        $this->Cart = new Cart();
    }
    public function execute () 
	{
    $urlPrevious = URL::previous();	//"https://laravelbot.ru/page/2" 
//dd($urlPrevious);
//url взять значение после последнего слеша
//substr(strrchr(rtrim($urlPrevious, '/'), '/'), 1)
//
if(str_contains($urlPrevious, 'admin')){
	//если мы в админке, то оставляем все по-старому
	return view($this->viewBDtable()['nameView'], $this->viewBDtable());
}elseif(str_contains($urlPrevious, 'page')){
	//Это удаление на странице товара
	$this->specialRemove();
	//контроллер изначально для Админки, в Админке $this->alias равен "carts", т.е. если мы таблице пользователей,
	//то $this->alias равен "users"
	// но если мы на других страницах, то мы меняем это значение на адекватное
	//url взять значение после последнего слеша
	$this->alias = substr(strrchr(rtrim($urlPrevious, '/'), '/'), 1);
	return redirect()->route('page', ['alias'=>$this->alias]);
	//$urlPrevious = 'singleProduct';
}else{
	//Это удаление на главной странице
	//удаляем запись, чтобы не применять метод для админки
	$this->specialRemove();
	return redirect()->route('index');
	//$urlPrevious = 'index';
}
        
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


$massivForViewOne = $this->massivFinal('adminTable',$massivForNameTable[$this->alias][2],$massivForNameTable[$this->alias][3],'dashboard.adminTable', $this->alias, $massivForNameTable[$this->alias][1]);
 
 return $massivForViewOne;   
	}
	
private function  specialRemove():void {
	//удаляем запись из базы данных и папку с фотографиями полностью
	if(isset($_GET['id'])){
		
		DB::table($this->alias)->where('id', '=', $_GET['id'])->delete();
/*		
//Закончил здесь, сначала нужен блок добавить товар
if(in_array($this->alias, ['tovars', 'blogs'])){
			
			$this->recursiveRemoveDir($dir);
		}
//Закончил здесь, сначала нужен блок добавить товар
*/		
	}

        
}

private function massivTable()  {
	
	$this->specialRemove();
	
	if (in_array($this->alias, ['users', 'tovars', 'carts', 'blogs'])) {

            if ($this->alias == 'users') {
                $massivTable = User::all()->toArray();
            } elseif ($this->alias == 'tovars') {
                $massivTable = Tovar::all()->toArray();
            } elseif ($this->alias == 'carts') {
                $massivTable = Cart::all()->toArray();
            } elseif ($this->alias == 'blogs') {
                $massivTable = Blog::all()->toArray();
            }
			
		}
		
		return $massivTable;
}

private function  recursiveRemoveDir($dir):void {
	$includes = new FilesystemIterator($dir);

	foreach ($includes as $include) {

		if(is_dir($include) && !is_link($include)) {

			recursiveRemoveDir($include);
		}

		else {

			unlink($include);
		}
	}

	rmdir($dir);
}

}

/*
There are at least two options available nowadays.
Before deleting the folder, delete all its files and folders (and this means recursion!). Here is an example:function deleteDir(string $dirPath): void { if (! is_dir($dirPath)) { throw new InvalidArgumentException("$dirPath must be a directory"); } if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') { $dirPath .= '/'; } $files = glob($dirPath . '*', GLOB_MARK); foreach ($files as $file) { if (is_dir($file)) { deleteDir($file); } else { unlink($file); } } rmdir($dirPath); }
And if you are using 5.2+ you can use a RecursiveIterator to do it without implementing the recursion yourself:function removeDir(string $dir): void { $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS); $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST); foreach($files as $file) { if ($file->isDir()){ rmdir($file->getPathname()); } else { unlink($file->getPathname()); } } rmdir($dir); }



function recursiveRemoveDir($dir) {

	$includes = glob($dir.'/*');
	//ниже две строки для скрытых файлов и файлов с точкой, при этом первую строку закоментить
	//$includes = glob($dir.'/{,.}*', GLOB_BRACE);
	//$systemDots = preg_grep('/\.+$/', $includes);
	
	foreach ($includes as $include) {

		if(is_dir($include)) {

			recursiveRemoveDir($include);
		}

		else {

			unlink($include);
		}
	}

	rmdir($dir);
}

//Удалим из текущей директории директорию tmp
recursiveRemoveDir('tmp');


Код рабочий, но на самом деле можно было сделать и проще. В PHP существует класс FilesystemIterator, который уже по умолчанию имеет необходимые нам настройки. В конструктор передается путь до директории, листинг которой нам нужен. Нам достаточно просто создать объект.

function recursiveRemoveDir($dir) {

	$includes = new FilesystemIterator($dir);

	foreach ($includes as $include) {

		if(is_dir($include) && !is_link($include)) {

			recursiveRemoveDir($include);
		}

		else {

			unlink($include);
		}
	}

	rmdir($dir);
}


//Удалим из текущей директории директорию tmp
recursiveRemoveDir('tmp');

*/


