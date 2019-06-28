<?php

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

Route::get('/', function () {
    return view('comprar');
});
//rutas de producto
Route::get('/productos','ProductoController@index');
Route::post('/productos/setproducto','ProductoController@setProducto');
Route::get('/productos/getproducto','ProductoController@getProducto');
Route::post('/productos/putproducto','ProductoController@putProducto');

//Rutas de producto_proveedor
Route::get('/productos_proveedor','ProductoProveedorController@index');
Route::post('/productos_proveedor/setproducto_proveedor','ProductoProveedorController@setProducto_proveedor');
Route::get('/productos_proveedor/getproducto_proveedor','ProductoProveedorController@getProducto_proveedor');
Route::post('/productos_proveedor/putproducto','ProductoProveedorController@putProducto');
// Route::get('/productos_proveedor/viewproducto','ProductoProveedorController@viewProducto');

//rutas de facturacion
Route::get('/comprar','FacturaController@index');
Route::post('/comprar/setfactura','FacturaController@setFactura');

//rutas de historial de factura
Route::get('/hisorial','DetalleFacturaController@index');
Route::get('/hisorial/getfactura','DetalleFacturaController@getFactura');
Route::post('/hisorial/deletefactura','DetalleFacturaController@deletefactura');
Route::get('/hisorial/pdf/{factura}','DetalleFacturaController@pdf');

