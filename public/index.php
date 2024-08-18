<?php
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ProductoController;
use Controllers\AplicacionController;
use Controllers\RolController;
use Controllers\UsuarioController;





$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);


//ESTO ES PRODUCTO//
$router->get('/', [AppController::class, 'index']);
$router->get('/producto', [ProductoController::class, 'index']);
$router->get('/API/producto/buscar', [ProductoController::class, 'buscarAPI']);
$router->post('/API/producto/guardar', [ProductoController::class, 'guardarAPI']);
$router->post('/API/producto/modificar', [ProductoController::class, 'modificarAPI']);
$router->post('/API/producto/eliminar', [ProductoController::class, 'eliminarAPI']);


//ESTO ES APLICACION//
$router->get('/aplicacion', [AplicacionController::class, 'index']);
$router->post('/API/aplicacion/guardar', [AplicacionController::class, 'guardarAPI']);
$router->get('/API/aplicacion/buscar', [AplicacionController::class, 'buscarAPI']);
$router->post('/API/aplicacion/modificar', [AplicacionController::class, 'modificarAPI']);
$router->post('/API/aplicacion/eliminar', [AplicacionController::class, 'eliminarAPI']);

//ESTO ES DE ROL//
$router->get('/rol', [RolController::class, 'index']);
$router->post('/API/rol/guardar', [RolController::class, 'guardarAPI']);
$router->get('/API/rol/buscar', [RolController::class, 'buscarAPI']);
$router->post('/API/rol/modificar', [RolController::class, 'modificarAPI']);
$router->post('/API/rol/eliminar', [RolController::class, 'eliminarAPI']);


//ESTO ES USUARIO//
$router->get('/usuario', [UsuarioController::class, 'index']);
$router->post('/API/usuario/guardar', [UsuarioController::class, 'guardarAPI']);
$router->get('/API/usuario/buscar', [UsuarioController::class, 'buscarAPI']);
$router->post('/API/usuario/modificar', [UsuarioController::class, 'modificarAPI']);
$router->post('/API/usuario/eliminar', [UsuarioController::class, 'eliminarAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

