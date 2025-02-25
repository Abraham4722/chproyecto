<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-email',[UserController::class,'sendEmail']);
Route::get('/admin',function(){return view('admin.index');});
Route::get('/admin/products',function(){return view('admin.products');});
Route::get('/admin/pedidos',function(){return view('admin.pedidos');});
Route::get('/admin/ventas',function(){return view('admin.ventas');});
Route::get('/admin/categorias',function(){return view('admin.categorias');});
Route::get('/admin/marcas',function(){return view('admin.marcas');});
Route::get('/admin/envios',function(){return view('admin.envios');});
Route::get('/admin/pagos',function(){return view('admin.pagos');});
Route::get('/admin/clientes',function(){return view('admin.clientes');});





Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin',function(){
    return view('admin.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
