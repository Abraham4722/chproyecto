<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de administración
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    
    Route::get('/send-email', [UserController::class, 'sendEmail']);
    
    // Productos
    Route::get('/products', [ProductoController::class, 'index'])->name('admin.products');
    Route::post('/products', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/products/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/products/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/products/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    
    // Pedidos
    Route::get('/pedidos', function () {
        return view('admin.pedidos');
    });
    Route::get('/detalles/{id}', [PedidoController::class, 'show'])->name('admin.detalles');
    
    // Categorías
    // Categorías
Route::get('/categorias', [CategoriaController::class, 'index'])->name('admin.categorias');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('admin.categorias.store');
Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('admin.categorias.edit');
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('admin.categorias.update');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy');

    // Otras rutas administrativas
    Route::view('/ventas', 'admin.ventas');
    Route::view('/marcas', 'admin.marcas');
    Route::view('/envios', 'admin.envios');
    Route::view('/pagos', 'admin.pagos');
    Route::view('/clientes', 'admin.clientes');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');