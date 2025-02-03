<?php
//layouts.header.menublock
//php artisan make:model Blog -m
//php artisan make:migration create_blogs_table
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tovar;
use App\Models\Cart;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class MenublocksController extends Controller
{
	//protected
	public $i;
	public $Tovar;
	public $Blog;
	public $Cart;
    public $User;
	public $massivNavigator;
	public $massivRazdelovSayta;
	public $massivTovars;
	public $massivIdTovar;
	public $zagalovokViewTovars;
	public $massivCategories;

    public function __construct($i = -1)
    {
		//передавать необходимо ассоциативный массив, потому что ключи в дальнейшем конвертируются в переменные
		//поэтом создаем массив $this -> massivNavigator элементы становятся ключами в массиве, созданным из базы данных
		// создаем массив массивов $this -> massivRazdelovSayta, где ключи это элементы $this -> massivNavigator (см. выше)
		// и передаем туда все необходимые для представлений массивы данных
		//первичные массивы данных для представлений создаем методами этого класса

		$this -> i =  $i;
		$this -> Tovar = new Tovar();
		$this -> Blog = new Blog();
		$this -> Cart = new Cart();
        $this -> User = new User();
		$this -> massivNavigator = ['navigator', 'massivCategories', 'massivTovars', 'zaprosUserCategories', 'Blog', 'Cart'];

		//$this -> massivRazdelovSayta = [$this -> massivNavigator[0]=>["Категории", "Товары", "Блог", "Контакты"], $this -> massivNavigator[1]=>$this -> Tovar->bdworking(), $this -> massivNavigator[2]=>$this -> Tovar->bdtovar(), $this -> massivNavigator[3]=>$this -> i, $this -> massivNavigator[4]=>$this -> Blog->bdBlog(), $this -> massivNavigator[5]=>$this -> Cart->bdCart()];

		$this -> massivRazdelovSayta = [$this -> massivNavigator[0]=>["category-section" => "Категории", "featured-products" => "Товары", "blog-section" => "Блог", "contact-form-details" => "Контакты"], $this -> massivNavigator[1]=>$this -> Tovar->bdworking(), $this -> massivNavigator[2]=>$this -> Tovar->bdtovar(), $this -> massivNavigator[3]=>$this -> i, $this -> massivNavigator[4]=>$this -> Blog->bdBlog(), $this -> massivNavigator[5]=>$this -> Cart->bdCart()];
		$this -> massivTovars = $this -> massivRazdelovSayta['massivTovars'];
		$this -> massivIdTovar = [];
		$this -> zagalovokViewTovars = '';
		$this -> massivCategories = $this -> massivRazdelovSayta['massivCategories'];

	}

	public function menuRazdelovSayta()
    {
        //dd($this -> Cart);
		$massivRazdelovSayta = $this -> massivRazdelovSayta;
		$zagalovokViewTovars = $this -> zagalovokViewTovars;
		$massivTovars = $this -> massivTovars;

		if (str_contains($this -> i, '_single_product')) {
			$numberIdTovar = +str_replace('_single_product.php', '', $this -> massivRazdelovSayta['zaprosUserCategories']);
			$nameCategories = $this -> massivTovars[$numberIdTovar]['categories'];
			$numberCategories = array_search($nameCategories, $this -> massivCategories);
			return view('layouts.body.singleProduct', compact('massivTovars', 'numberIdTovar', 'numberCategories'));
		}elseif(str_contains($this -> i, '_categories')){
			$zaprosUserCategories = $massivRazdelovSayta['zaprosUserCategories'];
			foreach ($this -> massivTovars as $key => $value) {
				$zaprosUserCategoriesNew = +str_replace('_categories.php', '', $zaprosUserCategories);
				if($value['categories'] == $this -> massivCategories[$zaprosUserCategoriesNew]){
				array_push($this -> massivIdTovar, $key);
				}
			}
			$massivIdTovar = $this -> massivIdTovar;
			$zagalovokViewTovars = 'Изделия из категории ' . $this -> massivCategories[$zaprosUserCategoriesNew];
			return view('index', compact('massivRazdelovSayta', 'zagalovokViewTovars', 'massivTovars', 'massivIdTovar'));
        }elseif(str_contains($this -> i, '_cartSummary')){
            //получаем массив всех Userов
			$massivUsers = $this -> User -> bdUser();
			//вытаскиваем массив всех корзин всех пользователей
            $massivAllUserCart = $massivRazdelovSayta['Cart'];
            $zaprosUserCart = +str_replace('_cartSummary.php', '', $this -> i);
			//формируем таблицу User в виде массива, который запросил корзину
            foreach ($massivUsers as $value) {
                if($value['id'] == $zaprosUserCart) {
                    $massivUsers = $value;
                    break;
                }
            }
            //dd($massivUsers);
			//формируем массив massivIdTovar товаров активного пользователя
            foreach ($massivAllUserCart as $key => $value) {
                if($value['idUser'] == $zaprosUserCart){
                    array_push($this -> massivIdTovar, $value['idTovar']);
                }
            }
            //dd($this -> massivIdTovar);
            $massivIdTovar = $this -> massivIdTovar;
            $zagalovokViewTovars = 'Корзина покупателя ' . $zaprosUserCart;
            return view('layouts.body.cartSummary', compact('massivRazdelovSayta', 'zagalovokViewTovars', 'massivIdTovar', 'massivUsers'));
        }else{
			foreach ($this -> massivTovars as $key => $value) {
				array_push($this -> massivIdTovar, $key);
				}

			if($this -> i == -1||str_contains($this -> i, 'index')){
				$index = 'index';
			}else{
				$this -> i = str_replace('.html', '', $this -> i);
				$this -> i = str_replace('.php', '', $this -> i);
				$index = $this -> i;
			}
			$massivIdTovar = $this -> massivIdTovar;
			$zagalovokViewTovars = 'Все товары';
			return view($index, compact('massivRazdelovSayta', 'zagalovokViewTovars', 'massivTovars', 'massivIdTovar'));
		}
	}
}
