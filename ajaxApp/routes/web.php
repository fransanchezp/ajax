<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\PaisController;
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

Route::get('/', [AjaxController::class, 'main'])->name('ajax.main');
Route::get('pais', [PaisController::class, 'index'])->name('pais.index');
Route::post('pais', [PaisController::class, 'store'])->name('pais.store');

Route::get('log',[\Rap2hpoutre\LaravelLogViewer\LogViewerController::class,'index']);


Route::put('pais/{code}',[PaisController::class, 'update'])->name('pais.update');
Route::delete('pais/{code}', [PaisController::class, 'destroy'])->name('pais.destroy');
