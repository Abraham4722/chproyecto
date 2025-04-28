<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\ColorController;
;

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
Route::get('/categorias', [CategoriaController::class, 'index'])->name('admin.categorias');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('admin.categorias.store');
Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('admin.categorias.edit');
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('admin.categorias.update');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy');

//MARCAS
Route::get('/marcas', [MarcaController::class, 'index'])->name('admin.marcas');
Route::post('/marcas', [MarcaController::class, 'store'])->name('admin.marca.store');
Route::get('/marcas/{marca}/edit', [MarcaController::class, 'edit'])->name('admin.marca.edit');
Route::put('/marcas/{marca}', [MarcaController::class, 'update'])->name('admin.marcas.update');
Route::delete('/marcas/{marca}', [MarcaController::class, 'destroy'])->name('admin.marcas.destroy');

    // MODELOS
Route::get('/modelos', [ModeloController::class, 'index'])->name('admin.modelos');
Route::post('/modelos', [ModeloController::class, 'store'])->name('admin.modelos.store'); // <-- Faltaba esta
Route::get('/modelos/{modelo}/edit', [ModeloController::class, 'edit'])->name('admin.modelos.edit'); // <-- Faltaba esta
Route::put('/modelos/{modelo}', [ModeloController::class, 'update'])->name('admin.modelos.update'); // <-- Faltaba esta
Route::delete('/modelos/{modelo}', [ModeloController::class, 'destroy'])->name('admin.modelos.destroy'); // <-- Faltaba esta
    
   
 // RUTAS PARA TALLAS
Route::get('/tallas', [TallaController::class, 'index'])->name('admin.tallas');
Route::post('/tallas', [TallaController::class, 'store'])->name('admin.tallas.store'); // <-- Faltaba esta
Route::get('/tallas/{talla}/edit', [TallaController::class, 'edit'])->name('admin.tallas.edit'); // <-- Faltaba esta
Route::put('/tallas/{talla}', [TallaController::class, 'update'])->name('admin.tallas.update'); // <-- Faltaba esta
Route::delete('/tallas/{talla}', [TallaController::class, 'destroy'])->name('admin.tallas.destroy');


   // COLORES
Route::get('/colores', [ColorController::class, 'index'])->name('admin.colores');
Route::post('/colores', [ColorController::class, 'store'])->name('admin.colores.store'); // <-- Faltaba esta
Route::get('/colores/{color}/edit', [ColorController::class, 'edit'])->name('admin.colores.edit'); // <-- Faltaba esta
Route::put('/colores/{color}', [ColorController::class, 'update'])->name('admin.colores.update'); // <-- Faltaba esta
Route::delete('/colores/{color}', [ColorController::class, 'destroy'])->name('admin.colores.destroy');




    //Route::view('/marcas', 'admin.marcas');
    Route::view('/envios', 'admin.envios');
    Route::view('/pagos', 'admin.pagos');
    Route::view('/clientes', 'admin.clientes');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');