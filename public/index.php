<?php
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ProductoController;
use Controllers\AplicacionController;
use Controllers\RolController;
use Controllers\UsuarioController;
use Controllers\PermisoController;
use Controllers\LoginController;


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

//ESTO ES DE PERMISOS//
$router->get('/permiso', [PermisoController::class, 'index']);
$router->get('/API/permiso/buscar', [PermisoController::class, 'buscarAPI']);
$router->post('/API/permiso/guardar', [PermisoController::class, 'guardarAPI']);
$router->post('/API/permiso/modificar', [PermisoController::class, 'modificarAPI']);
$router->post('/API/permiso/eliminar', [PermisoController::class, 'eliminarAPI']);


//ESTO ES DE LOGIN//
$router->get('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/menu', [LoginController::class, 'menu']);
$router->get('/registro', [LoginController::class, 'registro']);
$router->post('/API/registro', [LoginController::class, 'registroAPI']);
$router->post('/API/login', [LoginController::class, 'loginAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

