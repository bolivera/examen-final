<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->name('home');
Route::get('categoria/{id}/{slug}', 'Front\ProductosController@prodcutosByCategoria')->name('front.categoria');
Route::get('producto/{id}/{slug}', 'Front\ProductosController@productoDetalle')->name('front.productoDetalle');
Route::get('buscar/{slug}', 'Front\ProductosController@buscarProducto')->name('front.buscar');


Route::get('todos-los-productos', 'Front\ProductosController@productos')->name('front.productos');
Route::get('iniciar-login', 'Auth\LoginClienteController@index')->name('loginCliente');
Route::post('iniciar-sesion', 'Auth\SocialAuthController@iniciar')->name('loginPost');
Route::group(['prefix' => 'admin', 'middleware' => 'auth:administrator'], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('nueva-categoria', 'AdminController@formCategoria')->name('formCategoria');
    Route::get('editar-categoria/{id}', 'AdminController@formCategoria')->name('editarCategoria');
    Route::post('guardar-categoria', 'AdminController@saveCategoria')->name('saveCategoria');
    Route::get('todas-las-categorias', 'AdminController@allCategorias')->name('allCategorias');
    Route::get('todos-los-productos', 'AdminController@allProductos')->name('allProductos');
    Route::get('nuevo-producto', 'AdminController@formProducto')->name('formProducto');
    Route::post('guardar-producto', 'AdminController@saveProducto')->name('saveProducto');
    Route::get('editar-producto/{id}', 'AdminController@formProducto')->name('editarProducto');
    Route::post('eliminar-producto', 'AdminController@deleteProducto');
    Route::post('eliminar-imagen', 'RecursosController@deleteImagen');
    Route::get('todas-las-colecciones', 'AdminController@allColecciones')->name('allColecciones');
    Route::get('nueva-coleccion', 'AdminController@formColeccion')->name('formColeccion');
    Route::get('editar-coleccionn/{id}', 'AdminController@formColeccion')->name('editarColeccion');
    Route::post('eliminar-coleccion', 'AdminController@deleteColeccion');
    Route::post('eliminar-categoria', 'AdminController@deleteCategoria');
    Route::post('eliminar-color', 'AdminController@deleteColor');
    Route::post('eliminar-talla', 'AdminController@deleteTall');
    Route::post('uploads', 'RecursosController@subir_imagenes');
    Route::post('buscar-producto-por-id', 'AdminController@productoById')->name('productoById');
    Route::post('guardar-coleccion', 'AdminController@saveColeccion')->name('saveColeccion');

    Route::get('ver-ventas', 'AdminController@verVenta')->name('verVenta');
    Route::get('all-ventas', 'AdminController@allVenta')->name('allVenta');
    Route::get('extra-ventas/{id_venta}', 'AdminController@extraVenta')->name('extraVenta');
    Route::get('productos-ventas/{id_venta}', 'AdminController@productosVenta')->name('productosVenta');
   
    Route::get('nuevo-color', 'AdminController@formColor')->name('formColor');
    Route::get('editar-color/{id}', 'AdminController@formColor')->name('editarColor');
    Route::post('guardar-color', 'AdminController@saveColor')->name('saveColor');
    Route::get('todas-los-colores', 'AdminController@allColor')->name('allColor');

    Route::get('nueva-talla', 'AdminController@formTalla')->name('formTalla');
    Route::get('editar-talla/{id}', 'AdminController@formTalla')->name('editarTalla');
    Route::post('guardar-talla', 'AdminController@saveTalla')->name('saveTalla');
    Route::get('todas-las-tallas', 'AdminController@allTalla')->name('allTalla');
});

Route::get('auth/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::group(['prefix' => 'mi-panel', 'middleware' => 'auth'], function () {
    Route::get('/', 'Front\panelController@index')->name('miPanel');
    Route::get('perfil', 'Front\panelController@perfil')->name('panel.perfil');
    Route::post('actualizar-contrasenna', 'Front\panelController@cambiarPassword')->name('panel.cambiarPassword');
    Route::post('actualizar-datos-peresonales', 'Front\panelController@actualizarDatos')->name('panel.actualizarDatos');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

});

Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['prefix' => 'carrito'], function () {
    Route::post('agregar-producto', 'CartController@addCart')->name('cart.add');
    Route::post('quitar-producto', 'CartController@remove')->name('cart.delete');
    Route::get('ver-carrito', 'CartController@listaCarrito')->name('cart');
    Route::get('pagar-ahora', 'CartController@pagarAhora')->name('cart.pagar');
    Route::post('actualizar-cantidad-producto', 'CartController@actualizarCantidadProducto');
    Route::post('realizar-pago', 'CheckoutController@createOrder')->name('cart.createOrder');
    Route::post('finalizar-pago', 'CartController@finalizaPago')->name('finalizar');

});

Route::get('ajax_get_provincias', 'RecursosController@ajax_get_provincias');
Route::get('ajax_get_distritos', 'RecursosController@ajax_get_distritos');
Auth::routes();
Route::post('login', 'Auth\LoginController@login');

Route::group(['prefix' => 'api'], function () {
    Route::get('filter', 'Front\panelController@filter');
});
