<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;

use App\Models\Tovar;
use App\Models\Cart;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;


class CategoriesController extends Controller
{
	protected $Tovar;
	protected $Blog;
	protected $massivNavigator;
	protected $massivCategories;
	protected $massivFeaturedProducts;
	protected $massivAllFromBlog;
    protected $alias;


	public function __construct ($alias=null)  {
        $this->alias = +$alias;
        //$this->Tovar = new Tovar($this->alias);
        $this->Tovar = new Tovar(['alias'  => $alias]);
	   $this->Blog = new Blog();
	}

	public function execute () {

		return view('index', ['massivNavigator'=> $this->navigatorHead(),
							  'massivCategories'=> $this->navigatorCategories(),
							  'arrayKeysTovar'=> array_keys($this->navigatorCategories()),
							  'zagalovokViewTovars'=> $this->featuredProducts()[0],
							  'massivTovars' => $this->featuredProducts()[1],
							  'massivIdTovar' => $this->featuredProducts()[2],
							  'massivBlogsPrev' => $this->newsFromBlog()[0],
							  'dateBlogsPrev' => $this->newsFromBlog()[1],
							  'restPrev' => $this->newsFromBlog()[2],
							  'massivBlogsActual' => $this->newsFromBlog()[3],
							  'dateBlogsActual' => $this->newsFromBlog()[4],
							  'rest' => $this->newsFromBlog()[5],
							  'alias'  => $this->alias
								]);
	}

	protected function navigatorHead() {
		$this->massivNavigator = ["category-section" => "Категории", "featured-products" => "Товары", "blog-section" => "Блог", "contact-form-details" => "Контакты"];
		return $this->massivNavigator;
	}
	//формируем массив категорий - серьги, бусы, браслеты
	protected function navigatorCategories() {
		$this->massivCategories = $this->Tovar->bdworking();
		return $this->massivCategories;
	}

	protected function featuredProducts() {
		$zagalovokViewTovars = 'Товары из категории ' . $this->navigatorCategories()[$this->alias];
		$massivTovars = $this->Tovar->bdtovar();
		$massivCategories = $this-> navigatorCategories();

/**/        
		$zaprosUserCategories = $this->alias;
        $zaprosUserCategoriesNew = +$zaprosUserCategories;
        $massivIdTovar = [];
        foreach ($massivTovars as $key => $value) {
            //$zaprosUserCategoriesNew = +str_replace('_categories.php', '', $zaprosUserCategories);
            if($value['categories'] == $massivCategories[$zaprosUserCategoriesNew]){
                array_push($massivIdTovar, $key);
            }
        }

//dd($zaprosUserCategoriesNew);      //браслеты
		$this->massivFeaturedProducts = [$zagalovokViewTovars, $massivTovars, $massivIdTovar];
		return $this->massivFeaturedProducts;
	
	}

	protected function newsFromBlog() {
		$massivBlog = $this->Blog->bdBlog();

		$massivBlogsPrev = $massivBlog[count($massivBlog) - 2];
		$dateBlogsPrev = str_replace('_', '/', $massivBlogsPrev['dateComment']);
		$restPrev = mb_substr($massivBlogsPrev['content'], 0, 140) . '...';

		$massivBlogsActual = $massivBlog[count($massivBlog) - 1];
		$dateBlogsActual = str_replace('_', '/', $massivBlogsActual['dateComment']);
		$rest = mb_substr($massivBlogsActual['content'], 0, 140) . '...';

		$this->massivAllFromBlog = [$massivBlogsPrev, $dateBlogsPrev, $restPrev, $massivBlogsActual, $dateBlogsActual, $rest];
		return $this->massivAllFromBlog;
	}
}
