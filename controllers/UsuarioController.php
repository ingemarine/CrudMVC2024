<?php

namespace Controllers;

use Exception;
use Model\Usuario;
use MVC\Router;
use Model\ActiveRecord;

class UsuarioController
{
    public static function index(Router $router)
    {
        $router->render('usuario/index', []);
    }

    public static function guardarAPI()
    {
        $_POST['usu_nombre'] = htmlspecialchars($_POST['usu_nombre']);
        $_POST['usu_catalogo'] = htmlspecialchars($_POST['usu_catalogo']);
        $_POST['usu_password'] = htmlspecialchars($_POST['usu_password']);
        $_POST['usu_confirmar_password'] = htmlspecialchars($_POST['usu_confirmar_password']);

        // Confirmar que las contraseñas coinciden
        if ($_POST['usu_password'] !== $_POST['usu_confirmar_password']) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Las contraseñas no coinciden'
            ]);
            return;
        }

        try {
            $usuarios = new Usuario($_POST);
            $resultado = $usuarios->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Usuario Guardado Correctamente'
            ]);
        } catch (Exception $error) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Guardar Usuario',
                'detalle' => $error->getMessage()
            ]);
        }
    }

    public static function BuscarAPI()
    {
        try {
            $sql = "SELECT * FROM usuario WHERE usu_situacion = 1";
            $resultado = Usuario::fetchArray($sql);
            http_response_code(200);
            echo json_encode($resultado);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar usuarios',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        $_POST['usu_nombre'] = htmlspecialchars($_POST['usu_nombre']);
        $_POST['usu_catalogo'] = htmlspecialchars($_POST['usu_catalogo']);
        $_POST['usu_password'] = htmlspecialchars($_POST['usu_password']);
        $_POST['usu_confirmar_password'] = htmlspecialchars($_POST['usu_confirmar_password']);
        $id = filter_var($_POST['usu_id'], FILTER_SANITIZE_NUMBER_INT);

        // Confirmar que las contraseñas coinciden
        if ($_POST['usu_password'] !== $_POST['usu_confirmar_password']) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Las contraseñas no coinciden'
            ]);
            return;
        }

        try {
            $usuario = Usuario::find($id);
            $usuario->sincronizar($_POST);
            $usuario->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 3,
                'mensaje' => 'Usuario modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar Usuario',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $usuario = Usuario::find($id);
            $usuario->sincronizar([
                'usu_situacion' => 0
            ]);
            $usuario->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 4,
                'mensaje' => 'Usuario eliminado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar Usuario',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
