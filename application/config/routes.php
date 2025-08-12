<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Sample REST API Routes
|--------------------------------------------------------------------------
|
| There is a RESTful API system under the hood that is used by the
| frontend to help with some functions. The main routes are:
|
|   $route['api/users']['GET'] = 'users';
|   $route['api/users/(:num)']['GET'] = 'users/show/$1';
|   $route['api/users']['POST'] = 'users/create';
|   $route['api/users/(:num)']['PUT'] = 'users/update/$1';
|   $route['api/users/(:num)']['DELETE'] = 'users/delete/$1';
|
| You can also remove the default $route['default_controller'] = 'welcome' line
| since its the default value anyway, and remove the welcome routes since
| the welcome controller no longer exists.
|
| If you have a custom default controller, you should change the following
| line to point to it.
|
*/

$route['default_controller'] = 'welcome';

// Rutas para el sistema de reseñas
$route['resenas/agregar/(:num)'] = 'resenas/agregar/$1';
$route['resenas/editar/(:num)'] = 'resenas/editar/$1';
$route['resenas/eliminar/(:num)'] = 'resenas/eliminar/$1';
$route['resenas/guardar'] = 'resenas/guardar';
$route['resenas/actualizar'] = 'resenas/actualizar';
$route['resenas/toggle_like'] = 'resenas/toggle_like';
$route['resenas/buscar'] = 'resenas/buscar';
$route['resenas/usuario'] = 'resenas/usuario';
$route['resenas/populares'] = 'resenas/populares';
$route['resenas/recientes'] = 'resenas/recientes';

// Rutas para ver reseñas desde el controlador de libros
$route['libros/resenas/(:num)'] = 'libros/resenas/$1';

// Rutas existentes
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Rutas de autenticación
$route['auth/guardar_registro'] = 'auth/guardar_registro';
$route['auth/iniciar_sesion'] = 'auth/iniciar_sesion';
$route['auth/panel'] = 'auth/panel';
$route['auth/salir'] = 'auth/salir';

// Rutas de libros
$route['libros'] = 'libros/index';
$route['libros/agregar'] = 'libros/agregar';
$route['libros/guardar'] = 'libros/guardar';
$route['libros/ver/(:num)'] = 'libros/ver/$1';
$route['libros/editar/(:num)'] = 'libros/editar/$1';
$route['libros/actualizar/(:num)'] = 'libros/actualizar/$1';
$route['libros/eliminar/(:num)'] = 'libros/eliminar/$1';
$route['libros/buscar'] = 'libros/buscar';
$route['libros/genero/(:any)'] = 'libros/genero/$1';
$route['libros/leer/(:num)'] = 'libros/leer/$1';

// Rutas del dashboard
$route['dashboard'] = 'dashboard/index';
$route['dashboard/chart-data'] = 'dashboard/get_chart_data';

// Favoritos
$route['favoritos'] = 'favoritos/index';
$route['favoritos/agregar/(:num)'] = 'favoritos/agregar/$1';
$route['favoritos/eliminar/(:num)'] = 'favoritos/eliminar/$1';


