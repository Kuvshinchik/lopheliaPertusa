<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Tovar extends Model
{
	public $categories;
	public $massivTovars;
	public $nameCategories;
	public  $alias;
    public $nameTovar;
    public $nameContent;

	protected $fillable = ['title', 'content', 'status', 'price', 'categories', 'foto', 'fotoforcategories', 'nasklade'];

    /*
    public function __construct ($alias = null)  {
        $this->alias = $alias;
    }
*/

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        if(isset($attributes['alias']))   {
            //dd(+$attributes['alias']);
            $this->alias = +$attributes['alias'];
        }
    }

//Вывод всей таблицы товаров
	public function bdtovar(){
	$this->massivTovars = Tovar::all()->toArray();
	//dd($this->massivTovars);
	return $this->massivTovars;
	}

//Вывод наменования категории для страницы single ТОВАРА
	public function nameCategories(){
	$this->nameCategories = DB::table('tovars')->where('id', $this->alias)->first()->categories;
	//dd($this->nameCategories); //'браслеты'
	return $this->nameCategories;
	}
//Вывод наменования товара для страницы single ТОВАРА
    public function nameTovar(){
        $this->nameTovar = DB::table('tovars')->where('id', $this->alias)->first()->title;
        //dd($this->nameTovar); //'Серьги из коралла'
        return $this->nameTovar;
    }
//Вывод контента товара для страницы single ТОВАРА
    public function nameContent(){
        $this->nameContent = DB::table('tovars')->where('id', $this->alias)->first()->content;
        //dd($this->nameTovar); //'Серьги из коралла'
        return $this->nameContent;
    }
//Формирование массива категорий для передачи во view
	public function bdworking(){
	//dd($this->bdtovar());
	$this->categories = DB::table('tovars')->pluck('categories')->toArray();
	$this->categories = array_unique($this->categories);
	//array_unshift($this->categories, 'Показать все категории');
	//dd($this->categories);
	return $this->categories;
	}

}
