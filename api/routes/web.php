<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-email',[UserController::class,'sendEmail']);
Route::get('/admin',function(){return view('admin.index');});
//Route::get('/admin/products',function(){return view('admin.products');});
Route::get('/admin/pedidos',function(){return view('admin.pedidos');});
Route::get('/admin/ventas',function(){return view('admin.ventas');});
Route::get('/admin/categorias',function(){return view('admin.categorias');});
Route::get('/admin/marcas',function(){return view('admin.marcas');});
Route::get('/admin/envios',function(){return view('admin.envios');});
Route::get('/admin/pagos',function(){return view('admin.pagos');});
Route::get('/admin/clientes',function(){return view('admin.clientes');});
Route::get('/admin/detalles/{id}', [PedidoController::class, 'show'])->name('admin.detalles');




Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');



Route::get('/admin/categorias', [CategoriaController::class, 'index'])->name('admin.categorias');
Route::post('/admin/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/admin/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/admin/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/admin/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');





Route::get('/admin/products', [ProductoController::class, 'index'])->name('admin.products');
Route::post('/productoss', [ProductoController::class, 'store'])->name('productos.store');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');








Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin',function(){
    return view('admin.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
