<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\ColorController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-email',[UserController::class,'sendEmail']);
Route::get('/admin',function(){return view('admin.index');});
Route::get('/admin/products',function(){return view('admin.products');});
Route::get('/admin/pedidos',function(){return view('admin.pedidos');});
Route::get('/admin/ventas',function(){return view('admin.ventas');});
Route::get('/admin/categorias',[CategoriaController::class,'index']);
Route::get('/admin/marcas',function(){return view('admin.marcas');});
Route::get('/admin/envios',function(){return view('admin.envios');});
Route::get('/admin/pagos',function(){return view('admin.pagos');});
Route::get('/admin/clientes',function(){return view('admin.clientes');});
Route::resource('categorias', CategoriaController::class);
Route::resource('marcas', MarcaController::class);
Route::resource('modelos', ModeloController::class);
Route::resource('tallas', TallaController::class);
Route::resource('colores', ColorController::class);
Route::resource('categorias', CategoriaController::class);
Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categorias.store');
Route::post('/marcas/store', [MarcaController::class, 'store'])->name('marcas.store');
Route::post('/modelos/store', [ModeloController::class, 'store'])->name('modelos.store');
Route::post('/tallas/store', [TallaController::class, 'store'])->name('tallas.store');
Route::post('/colores/store', [ColorController::class, 'store'])->name('colores.store');








Route::get('/admin/products', [ProductoController::class, 'index'])->name('admin.products');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');








Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin',function(){
    return view('admin.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
