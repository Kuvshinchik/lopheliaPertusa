<?php
//контроллер формирования страницы товара с модальным окном заказа товара
//page/{alias} - singleProduct.blade.php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Tovar;
use App\Models\MailPertusa;
use Illuminate\Support\Facades\Auth;
//use App\Models\Cart;
//use App\Models\Blog;
//use App\Models\User;
//use Illuminate\Support\Facades\View;
//use Illuminate\Support\Facades\Route;


class PageController extends Controller
{
	protected Tovar $Tovar;
	//public $Blog;
	protected array $massivNavigator;
	protected array $massivCategories;
	protected array $massivFeaturedProducts;
	protected int $countKatalogs;
	protected $alias;

    public function __construct ($alias)  {
        $this->alias = $alias;
        //$this->Tovar = new Tovar($this->alias);
        $this->Tovar = new Tovar(['alias'  => $alias]);

        //dd($this->Tovar);
        //$this->Blog = new Blog();

    }
    //protected $attributes  = ['alias'  => $alias];
//nameCategories($this->alias);
	public function execute () {
	if (!$this->alias) {
			abort(404);
		}
		//dd($alias);
		if(view()->exists('singleProduct')) {
			
			$this->cartSaveUserShopping();
			
			
			return view('singleProduct', [
                                        //массив всех товаров из БД
                                        'massivTovars' => $this->featuredProducts()[2],
                                        //имя категории из которой запрашиваемый товар
                                        'nameCategories'=>$this->featuredProducts()[3],
                                        //номер категории, нужен для формирования адреса для отбора по категории
                                        'numberCategories'=>array_search($this->featuredProducts()[3], $this->navigatorCategories()),

										'massivNavigator'=> $this->navigatorHead(),
										'countKatalogs'=>$this->countKatalog(),
										'alias'=>$this->alias,

                                        'nameTovar'=>$this->Tovar->nameTovar(),
                                        'nameContent'=>$this->Tovar->nameContent(),
										'massivCartUser' => $this->cartUser()

			]);
		}
        abort(404);
	}

protected function cartSaveUserShopping()
    {
		if(isset($_POST['email'])){
			$idUser = '';
			//DB::table($this->alias)->where('id', $_POST['id'])->update($massivForBD_01);
			//DB::insert('insert into users (id, name) values (?, ?)', [1, 'Marc']);
			//Пользователь в форме указывает только контактный email, поэтому имя и пароль генерим самостоятельно и записываем данные в базу данных, предваритель но проверив есть ли такой пользователь в базе
			$email=$_POST['email'];
			$user = DB::table('users')->where('email', $email)->first();
		if(!$user){	
			$name=$email;
			$name=str_replace('@','',$name);
			$password=$name;
			//$password = Hash::make($password);
			$idUser = DB::table('users')->insertGetId(['email' => $email, 'name' => $name, 'password' => $password]);
	/*		$mail = new MailPertusa("laravelbot@laravelbot.ru"); // Создаём экземпляр класса
		    $mail->setFromName("Иван Иванов"); // Устанавливаем имя в обратном адресе
		    $mail->send("maseykinav@dzvr.ru", "Тестирование", "Тестирование<br /><b>письма<b>");
	*/		
			
		}else{
			//dd($user);
			$idUser = $user->id;
		}
		
		$idCart = DB::table('carts')->insertGetId(['idUser' => $idUser, 'idTovar' => $this->alias, 'status' => 1]);
		
		//dd($idCart);		
		
		}
	}

//формируем массив Навигатора по сайту - Категории, Товары, Блог, Контакты
	protected function navigatorHead(): array
    {
		$this->massivNavigator = ["category-section" => "Категории", "featured-products" => "Товары", "blog-section" => "Блог", "contact-form-details" => "Контакты"];
		return $this->massivNavigator;
	}

//формируем массив категорий - серьги, бусы, браслеты
	protected function navigatorCategories(): array
    {
		$this->massivCategories = $this->Tovar->bdworking();
		return $this->massivCategories;
	}

	protected function featuredProducts(): array
    {
		$zagalovokViewTovars = 'Все товары';
		$massivTovars = $this->Tovar->bdtovar();
		$nameCategories = $this->Tovar->nameCategories();
//dd($massivTovars);      //браслеты
		$massivIdTovar = $massivTovars;
		$this->massivFeaturedProducts = [$zagalovokViewTovars, $this->alias, $massivIdTovar, $nameCategories];
		return $this->massivFeaturedProducts;
	}

	protected function countKatalog(): int
    {
	//Подсчет файлов в каталоге $dir
    $dir = "assets/images/single-product/" . $this->alias . "/";
    $this->countKatalogs = count(glob("$dir/*"))/2;

	return $this->countKatalogs;
	}
	
	protected function cartUser() {
		$Iduser = Auth::id();		
		$massivCartUser = DB::table('carts')->where('Iduser', $Iduser)->get()->toArray();
		return $massivCartUser;
	}

}
