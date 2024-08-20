<?php

namespace Controllers;

use Exception;
use Model\Permiso;
use Model\Rol;
use Model\Usuario;
use MVC\Router;

class PermisoController
{
    public static function index(Router $router)
    {
        $usuarios = static::buscarUsuario();
        $roles = static::buscarRol();

        $router->render('permiso/index', [
            'usuarios' => $usuarios,
            'roles' => $roles,
        ]);
    }

    public static function buscarUsuario()
    {
        $sql = "SELECT * FROM usuario WHERE usu_situacion = 1";

        try {
            return Usuario::fetchArray($sql);
        } catch (Exception $e) {
            // Manejo de errores
            return [];
        }
    }

    public static function buscarRol()
    {
        $sql = "SELECT * FROM rol WHERE rol_situacion = 1";

        try {
            return Rol::fetchArray($sql);
        } catch (Exception $e) {
            // Manejo de errores
            return [];
        }
    }

    public static function guardarAPI()
    {
        getHeadersApi(); // funcion para convertir JSON html

        $permisoUsuario = filter_var($_POST['permiso_usuario'] ?? null, FILTER_SANITIZE_NUMBER_INT);
        $permisoRol = filter_var($_POST['permiso_rol'] ?? null, FILTER_SANITIZE_NUMBER_INT);

        if (!$permisoUsuario || !$permisoRol) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Datos incompletos',
            ]);
            return;
        }

        try {
            $permiso = new Permiso([
                'permiso_usuario' => $permisoUsuario,
                'permiso_rol' => $permisoRol,
            ]);
            $permiso->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Permiso guardado correctamente'
            ]);
        } catch (Exception $error) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar permiso',
                'detalle' => $error->getMessage()
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {
            $sql = "SELECT permiso_id, permiso_usuario, usu_nombre, permiso_rol, rol_nombre
                    FROM permiso
                    INNER JOIN usuario ON usu_id = permiso_usuario
                    INNER JOIN rol ON rol_id = permiso_rol
                    WHERE permiso_situacion = 1";

            $resultado = Permiso::fetchArray($sql);
            http_response_code(200);
            echo json_encode($resultado);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar los permisos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        getHeadersApi(); 
        $permisoUsuario = filter_var($_POST['permiso_usuario'] ?? null, FILTER_SANITIZE_NUMBER_INT);
        $permisoRol = filter_var($_POST['permiso_rol'] ?? null, FILTER_SANITIZE_NUMBER_INT);
        $id = filter_var($_POST['permiso_id'] ?? null, FILTER_SANITIZE_NUMBER_INT);

        if (!$permisoUsuario || !$permisoRol || !$id) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Datos incompletos',
            ]);
            return;
        }

        try {
            $permiso = Permiso::find($id);
            if (!$permiso) {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Permiso no encontrado',
                ]);
                return;
            }

            $permiso->sincronizar([
                'permiso_usuario' => $permisoUsuario,
                'permiso_rol' => $permisoRol,
            ]);
            $permiso->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 3,
                'mensaje' => 'Permiso modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar permiso',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {
        $id = filter_var($_POST['permiso_id'] ?? null, FILTER_SANITIZE_NUMBER_INT);

        if (!$id) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'ID de permiso no proporcionado',
            ]);
            return;
        }

        try {
            $permiso = Permiso::find($id);
            if (!$permiso) {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Permiso no encontrado',
                ]);
                return;
            }

            $permiso->sincronizar([
                'permiso_situacion' => 0
            ]);
            $permiso->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 4,
                'mensaje' => 'Permiso eliminado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar permiso',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
