<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AdminTableController;
use App\Http\Controllers\AdminSocialController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminTableEditController;
use App\Http\Controllers\AdminTableDeleteController;
use App\Http\Controllers\AdminTableUpdateController;
use App\Http\Controllers\AdminTableAddController;
use App\Http\Controllers\AdminTableSaveController;
use App\Http\Controllers\AdminController;
use Spatie\Honeypot\ProtectAgainstSpam;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//$GLOBALS['alias_temp'] = '11';

Route::group([],function() {
	Route::match(['get','post'],'/',[IndexController::class, 'execute'])->name('index');
	//Route::get('/page/{alias}',[PageController::class, 'execute'])->name('alias');
	Route::match(['get','post'], '/page/{alias}', function ($alias) {
		$PageController = new PageController($alias);
		return $PageController->execute();
	})->name('page');
    Route::get('/categories/{alias}', function ($alias) {
        $CategoriesController = new CategoriesController($alias);
        return $CategoriesController->execute();

    });

//=====================================================================================
//admin/
//!!! Возможно - главную страницу администратора следует в дальнейшем переименовать с 'dashboard.admin'  на 'dashboard.social'  со всеми вытекающими, иначе путаница
Route::group(['prefix'=>'admin'], function() {
	
/*	Route::get('/', function() {
		$Iduser = Auth::id();		
		$massivCartUser = DB::table('users')->where('id', $Iduser)->get()->toArray();
		//dd($massivCartUser[0]->level);
		//session_start();
		//dd($_SESSION);
		if(array_key_exists(level, $massivCartUser[0]) && $massivCartUser[0]->level==5){
			return view('dashboard.admin',[
            'pathAdmin'=> 'admin',
            'namePage'=>'Страница администратора'
        ]);
		}else{
			return abort(403);
		}
        
    })->name('admin');
*/
//admin/
Route::get('/', function() {
            $AdminController = new AdminController();
            return $AdminController->execute();        
    })->name('admin');


	
//admin/Social/alias
    Route::group(['prefix'=>'Social'], function() {
        Route::match(['get','post'],'/{alias}', function($alias) {
            $AdminSocialController = new AdminSocialController($alias);
            return $AdminSocialController->execute();
        })->name('adminSocial');
        //в admin.blade.php ссылка на этот name Route
    });
//admin/Table/alias
    Route::group(['prefix'=>'Table'], function() {
        Route::match(['get','post'],'/{alias}', function($alias) {
            $AdminTableController = new AdminTableController($alias);
            return $AdminTableController->execute();
        })->name('adminTable');  //в admin.blade.php ссылка на этот name Route

//admin/Table/edit/alias
        Route::group(['prefix'=>'edit'],function() {
            Route::match(['get','post'],'/{alias}', function($alias) {
                //$alias = $alias . 'Edit';
                $AdminTableEditController = new AdminTableEditController($alias);
                return $AdminTableEditController->execute();
            })->name('adminTableEdit');  //в adminTable.blade.php ссылка на этот name Route
    });
//admin/Table/delete/alias
        Route::group(['prefix'=>'delete'],function() {
            Route::match(['get','post'],'/{alias}', function($alias) {
                //$alias = $alias . 'Edit';
                $AdminTableDeleteController = new AdminTableDeleteController($alias);
                return $AdminTableDeleteController->execute();
            })->name('adminTableDelete');  //в adminTable.blade.php ссылка на этот name Route
        });
//admin/Table/update/alias
        Route::group(['prefix'=>'update'],function() {
            Route::match(['get','post'],'/{alias}', function($alias, Request $request) {
                //$alias = $alias . 'Edit';
                $AdminTableUpdateController = new AdminTableUpdateController($alias, $request);
                return $AdminTableUpdateController->execute();
            })->name('adminTableUpdate');  //в adminTable.blade.php ссылка на этот name Route
        });
//admin/Table/Add/alias
		Route::group(['prefix'=>'add'],function() {
            Route::match(['get','post'],'/{alias}', function($alias, Request $request) {
                //dd($request);
                //$alias = $alias . 'Edit';
                $AdminTableAddController = new AdminTableAddController($alias, $request);
                return $AdminTableAddController->execute();
            })->name('adminTableAdd');  //в adminTable.blade.php ссылка на этот name Route
        });
		//admin/Table/Save/alias
		Route::group(['prefix'=>'save'],function() {
            Route::match(['get','post'],'/{alias}', function($alias, Request $request) {
                //dd($request);
                //$alias = $alias . 'Edit';
                $AdminTableSaveController = new AdminTableSaveController($alias, $request);
                return $AdminTableSaveController->execute();
            })->name('adminTableSave');  //в adminTable.blade.php ссылка на этот name Route
        });

});
});

    Route::middleware(ProtectAgainstSpam::class)->group(function() {
        Route::auth();
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*	
		Route::group(['prefix'=>'cartSaveUserShopping'],function() {		
		Route::match(['get','post'],'/{alias}', function($alias, Request $request) {
			//dd($request);
			//$alias = $alias . 'Edit';
			$AdminTableSaveController = new AdminTableSaveController($alias, $request);
			return $AdminTableSaveController->execute();
		})->name('adminPageSave');  //в adminTable.blade.php ссылка на этот name Route
	});
*/		
    });


});
