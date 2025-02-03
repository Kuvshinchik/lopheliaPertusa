<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
	public $massivCarts;
	protected $fillable = ['idTovar', 'idUser', 'status'];

//Вывод всех корзин	
	public function bdCart(){
	$this->massivCarts = Cart::all()->toArray();
	//dd($this->massivCarts);
	return $this->massivCarts;
	}
	
}
