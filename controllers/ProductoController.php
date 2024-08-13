<?php

namespace Controllers;

use Exception;
use Model\Producto;
use MVC\Router;

class ProductoController
{
    public static function index(Router $router)
    {
        $router->render('producto/index', []);
    }

    public static function guardarAPI()
    {
        $_POST['prod_nombre'] = htmlspecialchars($_POST['prod_nombre']);
        $_POST['prod_precio'] = filter_var($_POST['prod_precio'], FILTER_VALIDATE_FLOAT);

        try {
            $producto = new Producto($_POST);
            $resultado = $producto->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Guardado Correctamente'
            ]);
        } catch (Exception $error) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Guardar Registro',
                'detalle' => $error->getMessage()
            ]);
        }
    }

    public static function BuscarAPI()
    {
        try {

            $productos = Producto::all();
            http_response_code(200);
            echo json_encode($productos);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar productos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
