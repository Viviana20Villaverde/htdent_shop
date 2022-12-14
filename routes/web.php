<?php

use App\Http\Controllers\Frontend\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\InicioController;
use App\Http\Controllers\Frontend\ProductoController;
use Gloudemans\Shoppingcart\Facades\Cart;

require_once __DIR__ . '/fortify.php';

Route::get('/', InicioController::class)->name('inicio');

Route::get('categoria/{categoria}', [CategoriaController::class, 'mostrar'])->name('categoria.index');

Route::get('producto/{producto}', [ProductoController::class, 'mostrar'])->name('producto.index');

//Eliminar el carrito
Route::get('eliminar-carrito', function () {
    Cart::destroy();
});

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});*/
