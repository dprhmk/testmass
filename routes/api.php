<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Не захищена частина
Route::get('test/{code}', 'Api\TestController@getTestByCode'); //Конкретний опитувальник

//MIDDLEWARE
//Route::group()
    Route::post('test', 'Api\TestController@createTest'); //Створення опитувалиника
    //put
    //delete
    Route::get('tests', 'Api\TestController@getAllTests'); //Показ вже створених опитувальників з витаннями і відповідями
    Route::get('ratio/sector', 'Api\TestController@getSector'); //Секторна діаграма
    Route::get('ratio/bar', 'Api\TestController@getBar'); //Стовчикова діаграма

