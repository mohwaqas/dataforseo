<?php

use Illuminate\Support\Facades\Route;

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
//Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dataforseo', function () {   //dataforseo
    return view('dataforseo');
});
*/
Route::get('/dataforseo', [App\Http\Controllers\DataForSEOController::class, 'dataforseo'])->name('dataforseo');


Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\HomeController;
//use App\Http\Controllers\Auth\LoginController

Route::get('employee/home', [HomeController::class, 'employeeHome'])->name('employee.home')->middleware('is_employee'); 
 
Route::post('/get-rank', [App\Http\Controllers\DataForSEOController::class, 'getRank'])->name('get-rank');

 

