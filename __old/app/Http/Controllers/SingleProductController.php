<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tovar;
use App\Models\Cart;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class SingleProductController extends Controller
{
   protected $Tovar;
   protected $Blog;
   
   public function __construct ()  {
	   $this->Tovar = new Tovar();
	   $this->Blog = new Blog();
   }
	
	public function singleProduct () {
		$massivNavigator = ["category-section" => "Категории", "featured-products" => "Товары", "blog-section" => "Блог", "contact-form-details" => "Контакты"];
		$massivCategories = $this->Tovar->bdworking();		
		$arrayKeysTovar = array_keys($massivCategories);
		
		$zagalovokViewTovars = 'Все товары';
		$massivTovars = $this->Tovar->bdtovar();
		$massivIdTovar = $massivTovars;
		
		$massivAllFromBlog = $this->newsFromBlog ();
		//return view('index', compact('massivNavigator'));
		//return view('index', array('massivNavigator'=> $massivNavigator));
		return view('index', ['massivNavigator'=> $massivNavigator,
							  'massivCategories'=> $massivCategories,
							  'arrayKeysTovar'=> $arrayKeysTovar,
							  'zagalovokViewTovars'=> $zagalovokViewTovars,
							  'massivTovars' => $massivTovars,
							  'massivIdTovar' => $massivIdTovar,
							  'massivBlogsPrev' => $massivAllFromBlog[0],
							  'dateBlogsPrev' => $massivAllFromBlog[1],
							  'restPrev' => $massivAllFromBlog[2],
							  'massivBlogsActual' => $massivAllFromBlog[3],
							  'dateBlogsActual' => $massivAllFromBlog[4],
							  'rest' => $massivAllFromBlog[5]
								]);
	}
	
	
	public function navigatorCategories () {	
		
	}
	
	
	public function featuredProducts () {
		
	}
	
	public function newsFromBlog () {	
		$massivBlog = $this->Blog->bdBlog();

		$massivBlogsPrev = $massivBlog[count($massivBlog) - 2];
		$dateBlogsPrev = str_replace('_', '/', $massivBlogsPrev['dateComment']);
		$restPrev = mb_substr($massivBlogsPrev['content'], 0, 140) . '...';

		$massivBlogsActual = $massivBlog[count($massivBlog) - 1];
		$dateBlogsActual = str_replace('_', '/', $massivBlogsActual['dateComment']);
		$rest = mb_substr($massivBlogsActual['content'], 0, 140) . '...';
		
		$massivAllFromBlog = [$massivBlogsPrev, $dateBlogsPrev, $restPrev, $massivBlogsActual, $dateBlogsActual, $rest];   
		return $massivAllFromBlog;
	}
	
}
