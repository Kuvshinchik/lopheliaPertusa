<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
	public $massivBlogs;
	protected $fillable = ['title', 'content', 'status', 'foto', 'comment', 'autorComment', 'dateComment', 'socialNetworkComment'];

	//Вывод всей таблицы постов	
	public function bdBlog(){
	$this->massivBlogs = Blog::all()->toArray();
	//dd($this->massivBlogs);
	return $this->massivBlogs;
	}
	
}
