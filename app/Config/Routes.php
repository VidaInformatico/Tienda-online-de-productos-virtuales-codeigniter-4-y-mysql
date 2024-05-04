<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('logout', 'LoginController::logout');
$routes->get('search', 'TiendaController::search');

$routes->get('login', 'LoginController::index');
$routes->get('registro', 'LoginController::registro');
$routes->post('login', 'LoginController::login');
$routes->post('registro', 'LoginController::register');
$routes->post('contactos', 'TiendaController::contactenos');

$routes->get('tienda', 'TiendaController::index');
$routes->get('carrito', 'TiendaController::carrito');
$routes->get('deseo', 'TiendaController::miListaDeseo');
$routes->get('contactos', 'TiendaController::contactos');
$routes->get('producto/(:any)', 'TiendaController::detail/$1');
$routes->get('categorias/(:any)', 'TiendaController::categorias/$1');

//AUTHORIZATION
$routes->group('', ['filter' => 'roleAdminFilter'], function ($routes) {
    $routes->get('perfil', 'PerfilController::index');
    $routes->put('perfil', 'PerfilController::updatePerfil');
    $routes->put('updatePassword', 'PerfilController::updatePassword');
    $routes->get('dashboard', 'AdminController::index');

    $routes->get('admin/empresa', 'ConfigController::index');
    $routes->put('admin/empresa/(:num)', 'ConfigController::update/$1');
    $routes->get('admin/pedidos', 'AdminController::pedidos');
    $routes->get('admin/pedidos/show', 'AdminController::showPedido');
    $routes->get('admin/pedidos/(:num)/detalle', 'AdminController::detallePedido/$1');
    $routes->get('admin/pedidos/total', 'AdminController::totalPedidos');

    $routes->get('admin/productos/(:num)/galeria', 'ProductoController::galeria/$1');
    $routes->post('admin/imageProductos', 'ProductoController::subirImagenes');
    $routes->get('admin/deleteImagen/(:num)/(:any)', 'ProductoController::deleteImagen/$1/$2');

    $routes->resource('admin/productos', ['controller' => 'ProductoController']);
    $routes->resource('admin/categorias', ['controller' => 'CategoriaController']);
    $routes->resource('admin/sliders', ['controller' => 'SliderController']);
    $routes->resource('admin/usuarios', ['controller' => 'UsuarioController']);
});

$routes->group('', ['filter' => 'roleClienteFilter'], function ($routes) {
    $routes->get('perfil', 'PerfilController::index');
    $routes->put('perfil', 'PerfilController::updatePerfil');
    $routes->put('updatePassword', 'PerfilController::updatePassword');
    $routes->get('dashboard', 'AdminController::index');
    
    $routes->get('checkout', 'TiendaController::checkout');
    $routes->get('pagos', 'AdminController::pagos');
    $routes->post('registrarPedido', 'AdminController::registrarPedido');
    $routes->post('calificacion/agregar', 'CalificacionController::agregar');
    $routes->get('descargas', 'DescargaController::index');
});
