<?php

use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\HomeChartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [AuthControllers::class, 'index'])->name('login');
Route::post('login', [AuthControllers::class, 'login'])->name('login');
Route::get('registration', [AuthControllers::class, 'registration_view'])->name('registration');
Route::post('registration', [AuthControllers::class, 'registration'])->name('registration');
Route::get('logout', [AuthControllers::class, 'logout'])->name('logout');
//------------------------reg-----------------------//
Route::get('/', [HomeControllers::class, 'index'])->name('index');
Route::get('home', [HomeControllers::class, 'index'])->name('index');
Route::post('home/AddBook', [HomeControllers::class, 'AddBook'])->name('AddBook');
Route::get('home/viewBook/{id}', [HomeControllers::class, 'viewBook'])->name('viewBook');
Route::get('home/ViewAssignList', [HomeControllers::class, 'ViewAssignList'])->name('ViewAssignList');
Route::get('home/AssignBook/{id}', [HomeControllers::class, 'AssignBook'])->name('AssignBook');
Route::get('home/UnAssignBook/{id}', [HomeControllers::class, 'UnAssignBook'])->name('UnAssignBook');
Route::post('home/BookAssign/{id}', [HomeControllers::class, 'BookAssign'])->name('BookAssign');
Route::post('home/EditBook/{id}', [HomeControllers::class, 'EditBook'])->name('EditBook');
Route::post('home/DeleteBook/{id}', [HomeControllers::class, 'DeleteBook'])->name('DeleteBook');

Route::get('chart', [HomeChartController::class, 'index'])->name('index');
//------------------------reg-----------------------//
