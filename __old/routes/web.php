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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Здесь регистрируются веб-маршруты для вашего приложения. Эти маршруты
| загружаются RouteServiceProvider внутри группы, которая содержит
| middleware группу "web". Теперь создайте что-то великое!
|
*/

// Группа маршрутов для основного сайта
Route::group([], function () {
    // Главная страница
    Route::match(['get', 'post'], '/', [IndexController::class, 'execute'])->name('index');

    // Страница с динамическим alias (например, /page/about)
    Route::match(['get', 'post'], '/page/{alias}', function ($alias) {
        $PageController = new PageController($alias);
        return $PageController->execute();
    })->name('page');

    // Страница категории с динамическим alias (например, /categories/category-name)
    Route::get('/categories/{alias}', function ($alias) {
        $CategoriesController = new CategoriesController($alias);
        return $CategoriesController->execute();
    });
});

// Группа маршрутов для административной панели
Route::group(['prefix' => 'admin'], function () {
    // Главная страница административной панели
    Route::get('/', function () {
        $AdminController = new AdminController();
        return $AdminController->execute();
    })->name('admin');

    // Группа маршрутов для управления социальными элементами
    Route::group(['prefix' => 'Social'], function () {
        Route::match(['get', 'post'], '/{alias}', function ($alias) {
            $AdminSocialController = new AdminSocialController($alias);
            return $AdminSocialController->execute();
        })->name('adminSocial');
    });

    // Группа маршрутов для управления таблицами
    Route::group(['prefix' => 'Table'], function () {
        // Основной маршрут для таблиц
        Route::match(['get', 'post'], '/{alias}', function ($alias) {
            $AdminTableController = new AdminTableController($alias);
            return $AdminTableController->execute();
        })->name('adminTable');

        // Группа маршрутов для редактирования таблиц
        Route::group(['prefix' => 'edit'], function () {
            Route::match(['get', 'post'], '/{alias}', function ($alias) {
                $AdminTableEditController = new AdminTableEditController($alias);
                return $AdminTableEditController->execute();
            })->name('adminTableEdit');
        });

        // Группа маршрутов для удаления записей в таблицах
        Route::group(['prefix' => 'delete'], function () {
            Route::match(['get', 'post'], '/{alias}', function ($alias) {
                $AdminTableDeleteController = new AdminTableDeleteController($alias);
                return $AdminTableDeleteController->execute();
            })->name('adminTableDelete');
        });

        // Группа маршрутов для обновления записей в таблицах
        Route::group(['prefix' => 'update'], function () {
            Route::match(['get', 'post'], '/{alias}', function ($alias, Request $request) {
                $AdminTableUpdateController = new AdminTableUpdateController($alias, $request);
                return $AdminTableUpdateController->execute();
            })->name('adminTableUpdate');
        });

        // Группа маршрутов для добавления записей в таблицы
        Route::group(['prefix' => 'add'], function () {
            Route::match(['get', 'post'], '/{alias}', function ($alias, Request $request) {
                $AdminTableAddController = new AdminTableAddController($alias, $request);
                return $AdminTableAddController->execute();
            })->name('adminTableAdd');
        });

        // Группа маршрутов для сохранения записей в таблицах
        Route::group(['prefix' => 'save'], function () {
            Route::match(['get', 'post'], '/{alias}', function ($alias, Request $request) {
                $AdminTableSaveController = new AdminTableSaveController($alias, $request);
                return $AdminTableSaveController->execute();
            })->name('adminTableSave');
        });
    });
});

// Группа маршрутов для аутентификации с защитой от спама
Route::middleware(ProtectAgainstSpam::class)->group(function () {
    Route::auth(); // Маршруты аутентификации (вход, регистрация, сброс пароля и т.д.)
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); // Домашняя страница после аутентификации
});

/*
Вот отредактированный файл `web.php` с удалением лишнего кода и добавлением комментариев для каждой команды:


### Что было удалено:
1. Удалены закомментированные блоки кода, которые не используются.
2. Удалены лишние комментарии, которые не несут полезной информации.
3. Удалены неиспользуемые импорты и переменные.

### Что добавлено:
1. Добавлены комментарии к каждому маршруту, объясняющие его назначение.
2. Упрощена структура кода для улучшения читаемости.

Теперь файл стал более чистым и понятным, с четким описанием каждого маршрута.
*/