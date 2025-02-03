<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


class AdminTableSaveController extends Controller
{ 
    protected $alias;
	protected $request;

    public function __construct ($alias=null, $request=null)  
	{
        $this->alias = $alias;
		$this->request = $request;
  }
    public function execute () 
	{
		$this->massivTable();
		$this->imageAdd();
		return redirect()->route('adminTable', ['alias'=>$this->alias]); 
    }
 
	private function  massivTable(): void {
		//если в БД будут добавлены таблицы, то и сюда нужно будет внести изменения
		if(isset($_POST)){
			dd($_POST);
			$massivForBD_01 = [];
			foreach($_POST as $key=>$value){
				if (in_array($key, ['_token', 'example3_length', 'id', 'created_at', 'updated_at', 'email_verified_at', 'ДЕЙСТВИЕ', 'file'])){
					continue;
				}else{				
					$massivForBD_01  += [$key=>$value];
				}
			}
			DB::table($this->alias)->where('id', $_POST['id'])->update($massivForBD_01);
		}	
					
	}
	
	private function imageAdd (): void {
		//загрузка картинки
		if($this->request->file('file')){
			$papkaForZapisi = +$_POST['id'];
			$massivScandir = scandir('./assets/images/single-product/' . $papkaForZapisi);
			$nameFile_1 = 'product-large-' . (count($massivScandir)-3) . '.jpg';
			$nameFile_2 = 'product-thumb-' . (count($massivScandir)-3) . '.jpg';
			$file = $this->request->file('file');
            $uploaddir_1 = public_path() . '/assets/images/single-product/' . $papkaForZapisi . '/';
			$uploaddir_2 = public_path() . '/assets/images/single-product/' . $papkaForZapisi . '/thumb/';
            $uploadfile_1 = $uploaddir_1 . $nameFile_1;
			$uploadfile_2 = $uploaddir_2 . $nameFile_2;
			//dd($uploadfile_1 . '---' . $uploadfile_2);
			move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile_1);
			copy($uploadfile_1, $uploadfile_2);

		}
      
    }

	
}
