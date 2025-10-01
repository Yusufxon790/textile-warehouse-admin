<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\StatisticController;










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

Route::get('/', function () {
    return view('welcome');
});
Route::get('hello/{ism?}',function($ism=" Sanjar"){
    return "Hello World!".$ism;
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


//Textile 
Route::resource('textile',CatController::class);
Route::resource('types',TypeController::class);
Route::resource('colors',ColorController::class);
Route::get('cat/search',[CatController::class,'search'])->name('cats.search');
Route::get('type/search',[TypeController::class,'search'])->name("types.search");
Route::get('color/search',[ColorController::class,'search'])->name("colors.search");
Route::resource('incomes',IncomeController::class)->middleware('auth');
Route::get('income/cat_search',[IncomeController::class,'cat_search'])->name("incomes.cat_search");
Route::get('income/type_search',[IncomeController::class,'type_search'])->name("incomes.type_search");
Route::get('income/search_input',[IncomeController::class,'search_input'])->name("incomes.search_input");
Route::get('color/color_cat_change',[ColorController::class,'color_cat_change'])->name("colors.color_cat_change");
Route::get('/get-types-by-category/{cat_id}', [ColorController::class, 'getTypesByCategory']);
Route::get('income_edit2/{id}',[IncomeController::class,'income_edit2'])->name('income_edit2');
Route::post('income_update2/{id}',[IncomeController::class,'income_update2'])->name('income_update2');
Route::get('income_view_edit/{id}',[IncomeController::class,'income_view_edit'])->name("income_view_edit");
Route::post('income_view_update/{id}',[IncomeController::class,'income_view_update'])->name("income_view_update");
Route::resource('statistics',StatisticController::class);
Route::get('statistic/cat_search',[StatisticController::class,'cat_search'])->name('statistics.cat_search');
Route::get('statistic/date_search',[StatisticController::class,'date_search'])->name('statistics.date_search');
Route::get('statistic/month_search',[StatisticController::class,'month_search'])->name('statistics.month_search');

