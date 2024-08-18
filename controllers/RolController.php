<?php

namespace Controllers;

use Exception;
use Model\Rol;
use MVC\Router;
use Model\ActiveRecord;

class RolController
{
    public static function index(Router $router)
    {
        $router->render('rol/index', []);
    }

    public static function guardarAPI()
    {
        $_POST['rol_nombre'] = htmlspecialchars($_POST['rol_nombre']);
        $_POST['rol_nombre_ct'] = htmlspecialchars($_POST['rol_nombre_ct']);
        $_POST['rol_app'] = htmlspecialchars($_POST['rol_app']);

    

        try {
            $roles = new Rol($_POST);
            $resultado = $roles->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Rol Guardado Correctamente'
                  // echo json_encode($producto);
            // exit;
            ]);
//   echo json_encode($producto);
//   exit;
        } catch (Exception $error) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Guardar Rol',
                'detalle' => $error->getMessage()
            ]);
        }
    }

    public static function BuscarAPI()
    {
        try {

            $sql = "SELECT * FROM rol where rol_situacion = 1";

            $resultado = Rol::fetchArray($sql);
            http_response_code(200);
            echo json_encode($resultado);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar Roles',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        $_POST['rol_nombre'] = htmlspecialchars($_POST['rol_nombre']);
        $_POST['rol_nombre_ct'] = htmlspecialchars($_POST['rol_nombre_ct']);
        $_POST['rol_app'] = htmlspecialchars($_POST['rol_app']);

        $id = filter_var($_POST['rol_id'], FILTER_SANITIZE_NUMBER_INT);
        try {

            $resultado = Rol::find($id);
            $resultado->sincronizar($_POST);
            $resultado->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 3,
                'mensaje' => 'Rol modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar Aplicacion',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {

        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        try {

            $roles = Rol::find($id);
             $roles->sincronizar([
                 'app_situacion' => 0
             ]);
            // echo json_encode($producto);
            // exit;
            $roles->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 4,
                'mensaje' => 'Rol eliminado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar Rol',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
