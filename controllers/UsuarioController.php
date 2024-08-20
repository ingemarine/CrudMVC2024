<?php

namespace Controllers;

use Exception;
use Model\Usuario;
use MVC\Router;

class UsuarioController
{
    public static function index(Router $router)
    {   
        $sql = "SELECT * FROM usuario WHERE usu_situacion = 1";

        $resultado = Usuario::fetchArray($sql);
        $router->render('usuario/index', [
            'usuario' => $resultado
        ]);
    }

    public static function guardarAPI()
    {
        getHeadersApi();
        $_POST['usu_nombre'] = htmlspecialchars($_POST['usu_nombre']);
        $_POST['usu_catalogo'] = filter_var($_POST['usu_catalogo'], FILTER_SANITIZE_NUMBER_INT);
        
        // Confirmación de contraseña
        if (empty($_POST['usu_password']) || $_POST['usu_password'] !== $_POST['usu_password_confirm']) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Las contraseñas no coinciden o están vacías.'
            ]);
            return;
        }
        
        // Verificar si el catálogo ya existe
        $catalogoExistente = Usuario::findByCatalogo($_POST['usu_catalogo']);
        if ($catalogoExistente) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'El catálogo ingresado ya existe.'
            ]);
            return;
        }
    
        $_POST['usu_password'] = password_hash($_POST['usu_password'], PASSWORD_BCRYPT);
    
        try {
            $usuario = new Usuario($_POST);
            $resultado = $usuario->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Usuario guardado correctamente'
            ]);
        } catch (Exception $error) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar usuario',
                'detalle' => $error->getMessage()
            ]);
        }
    }
    public static function buscarAPI()
    {
        try {
            $sql = "SELECT usu_id, usu_nombre, usu_catalogo FROM usuario WHERE usu_situacion = 1";
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
        $_POST['usu_catalogo'] = filter_var($_POST['usu_catalogo'], FILTER_SANITIZE_NUMBER_INT);

        if (!empty($_POST['usu_password'])) {
            // Confirmación de contraseña
            if ($_POST['usu_password'] !== $_POST['usu_password_confirm']) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Las contraseñas no coinciden.'
                ]);
                return;
            }
            $_POST['usu_password'] = password_hash($_POST['usu_password'], PASSWORD_BCRYPT);
        }

        $id = filter_var($_POST['usu_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $resultado = Usuario::find($id);
            $resultado->sincronizar($_POST);
            $resultado->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 3,
                'mensaje' => 'Usuario modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar usuario',
                'detalle' => $e->getMessage(),
            ]);
        }
    }


    //funcion eliminar
    public static function eliminarAPI()
    {
        getHeadersApi();
        $input = json_decode(file_get_contents('php://input'), true);
        $id = filter_var($input['usu_id'], FILTER_SANITIZE_NUMBER_INT);
    
        try {
            $resultado = Usuario::find($id);
            if ($resultado) {
                $resultado->sincronizar(['usu_situacion' => 0]);
                $resultado->actualizar();
                http_response_code(200);
                echo json_encode([
                    'codigo' => 4,
                    'mensaje' => 'Usuario eliminado exitosamente',
                ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Usuario no encontrado',
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar usuario',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}


