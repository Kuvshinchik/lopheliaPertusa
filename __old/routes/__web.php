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
	dd(User::all()->toArray());
	Route::get('/', function() {
        return view('dashboard.admin',[
            'pathAdmin'=> 'admin',
            'namePage'=>'Страница администратора'
        ]);
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

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



/*
Route::get('/admin/tableBootstrapBasic', function() {
        return view('dashboard.tableBootstrapBasic');
    });
<li><a href="admin/tableBootstrapBasic">Bootstrap</a></li>
<li><a href="admin/tableDatatableBasic">Datatable</a></li>
//admin/service
Route::group(['prefix'=>'admin','middleware'=>'auth'], function() {

	//admin
	Route::get('/',function() {

		if(view()->exists('admin.index')) {
			$data = ['title' => 'Панель администратора'];

			return view('admin.index',$data);
		}
		return abort(404);
	});

	//admin/pages
	Route::group(['prefix'=>'pages'],function() {

		///admin/pages
		Route::get('/',['uses'=>'PagesController@execute','as'=>'pages']);

		//admin/pages/add
		Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execute','as'=>'pagesAdd']);
		//admin/edit/2
		Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PagesEditController@execute','as'=>'pagesEdit']);

	});


	Route::group(['prefix'=>'portfolios'],function() {


		Route::get('/',['uses'=>'PortfolioController@execute','as'=>'portfolio']);


		Route::match(['get','post'],'/add',['uses'=>'PortfolioAddController@execute','as'=>'portfolioAdd']);

		Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'PortfolioEditController@execute','as'=>'portfolioEdit']);

	});


	Route::group(['prefix'=>'services'],function() {


		Route::get('/',['uses'=>'ServiceController@execute','as'=>'services']);


		Route::match(['get','post'],'/add',['uses'=>'ServiceAddController@execute','as'=>'serviceAdd']);

		Route::match(['get','post','delete'],'/edit/{service}',['uses'=>'ServiceEditController@execute','as'=>'serviceEdit']);

	});

});
*/


/*
	Route::get('/{name}_single_product.php', function ($name) {
            $SingleProductController = new SingleProductController($name . '_single_product.php');
            return $SingleProductController->singleProduct();
        })-> where('name', '[0-9]+')->name('singleProduct');
*/
//	Route::match(['get','post'],'/',[MenublocksController::class, 'menuRazdelovSayta'])->name('home');
//	Route::match(['get','post'],'/',['uses'=>'IndexController@execute','as'=>'home']);
//	Route::get('/page/{alias}',['uses'=>'PageController@execute','as'=>'page']);





/*
Route::get('/', [MenublocksController::class, 'menuRazdelovSayta']);
Route::get('/index.php', [MenublocksController::class, 'menuRazdelovSayta']);
Route::get('/mail.php', function () {
	return view('layouts.mail');
});

Route::get('/{name}_single_product.php', function ($name) {
            $MenublocksController = new MenublocksController($name . '_single_product.php');
            return $MenublocksController->menuRazdelovSayta();
        })-> where('name', '[0-9]+');

Route::get('/{name}_categories.php', function ($name) {
            $MenublocksController = new MenublocksController($name . '_categories.php');
            return $MenublocksController->menuRazdelovSayta();
        })-> where('name', '[0-9]+');


Route::get('/{name}_cartSummary.php', function ($name) {
            $MenublocksController = new MenublocksController($name . '_cartSummary.php');
            return $MenublocksController->menuRazdelovSayta();
        })-> where('name', '[0-9]+');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/


/*
Auth::routes();

Route::get('/loginTest', function () {
    $MenublocksController = new MenublocksController();
    $massivRazdelovSayta = $MenublocksController->menuRazdelovSayta();
    return view('auth.loginTest', compact('massivRazdelovSayta'));
});

Route::get('/cartSummary', function () {
    $MenublocksController = new MenublocksController();
    $massivRazdelovSayta = $MenublocksController->menuRazdelovSayta();
    return view('layouts.body.cartSummary', compact('massivRazdelovSayta'));
});

Route::controller(MenublocksController::class)->group(function () {
    Route::get('/', 'menuRazdelovSayta');
    Route::get('/home', 'menuRazdelovSayta');
       Route::get('/{name}_single_product.php', function ($name) {
            $MenublocksController = new MenublocksController($name);
            return $MenublocksController->menuRazdelovSayta();
        })-> where('name', '[0-9]+');

  	Route::get('/{i}/', function ($i) {
        $MenublocksController = new MenublocksController($i);
        return $MenublocksController->menuRazdelovSayta();
    });

});
*/



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/', [MenublocksController::class, 'menuCategory']);
/*
Route::get('/', [MenublocksController::class, 'menuRazdelovSayta']);

Route::get('/{i}/', function ($i) {
	$MenublocksController = new MenublocksController($i);
	$MenublocksController->menuRazdelovSayta();
});




Route::get('/{i}/', function ($i) {
	$menublocksController = new MenublocksController;
	$massivRazdelovSayta = $menublocksController -> menuRazdelovSayta();
	if (str_contains($i, '_single_product')) {
		array_push($massivRazdelovSayta, $i);
    	return view('layouts.body.singleProduct', compact('massivRazdelovSayta'));
//dd($massivRazdelovSayta);
	}elseif(str_contains($i, '_categories')){
		array_push($massivRazdelovSayta, $i);
//dd($massivRazdelovSayta);
		return view('index', compact('massivRazdelovSayta'));
	}else{
	array_push($massivRazdelovSayta, -1);
//dd($i);
	$i = str_replace('.html', '', $i);
    return view($i, compact('massivRazdelovSayta'));
}

});

*/
