<?php

namespace Controllers;

use Exception;
use Model\Permiso;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    //funcion para entrar a menu
    public static function login(Router $router)
    {
        isNotAuth();
        $router->render('auth/login', []);
    }

    public static function logout()
    {
        isAuth();
        $_SESSION = [];
        session_destroy();
        header('Location: /CrudMVC2024/');
        exit;
    }

    //funcion para que tenga permisos 
    
    // public static function registro(Router $router)
    // {
    //     isAuth();
    //     hasPermission(['TIENDA_ADMIN']);
    //     $router->render('auth/registro', [], 'layouts/menu');
    // }

    //ESTA FUNCION ES PARA QUE INGRESE SOLO EL QUE ES TIENDA_ADMIN
    public static function menu(Router $router)
    {
        // isAuth();
        // hasPermission(['TIENDA_ADMIN', 'TIENDA_USER']);
        $router->render('pages/menu', [], 'layouts/menu');
    }


    public static function loginAPI()
    {
        getHeadersApi();

        // Sanitización de entradas
        $usu_catalogo = filter_var($_POST['usu_catalogo'], FILTER_SANITIZE_NUMBER_INT);
        $usu_password = htmlspecialchars($_POST['usu_password']);

        try {
            // Validación del usuario
            $usuario = new Usuario(['usu_catalogo' => $usu_catalogo]);
            if ($usuario->validarUsuarioExistente()) {
                $usuarioBD = $usuario->getUsuarioExistente();

                // Verificación de la contraseña
                if (password_verify($usu_password, $usuarioBD['usu_password'])) {
                    session_start();
                    $_SESSION['user'] = $usuarioBD;

                    // Obtención y configuración de permisos en la sesión
                    $permisos = Permiso::fetchArray("SELECT * FROM permiso INNER JOIN rol ON permiso_rol = rol_id WHERE permiso_usuario = " . $usuarioBD['usu_id']);
                    foreach ($permisos as $permiso) {
                        $_SESSION[$permiso['rol_nombre_ct']] = 1;
                    }

                    http_response_code(200);
                    echo json_encode([
                        'codigo' => 1,
                        'mensaje' => 'Bienvenido a nuestro sistema, ' . $usuarioBD['usu_nombre'],
                    ]);
                } else {
                    http_response_code(401); // Código de estado para credenciales inválidas
                    echo json_encode([
                        'codigo' => 0,
                        'mensaje' => 'La contraseña no coincide',
                        'detalle' => 'Verifique la contraseña ingresada',
                    ]);
                }
            } else {
                http_response_code(404); // Código de estado para usuario no encontrado
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'El usuario no existe',
                    'detalle' => 'No existe un usuario registrado con el catálogo proporcionado',
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500); // Código de estado para errores del servidor
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al iniciar sesión',
                'detalle' => $e->getMessage(),
            ]);
        }
        exit;
    }
}
