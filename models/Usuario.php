<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuario';
    protected static $idTabla = 'usu_id';
    protected static $columnasDB = [ 'usu_nombre', 'usu_catalogo', 'usu_password', 'usu_situacion'];

    public $usu_id;
    public $usu_nombre;
    public $usu_catalogo;
    public $usu_password;
    public $usu_situacion;

    public function __construct($args = [])
    {
        $this->usu_id = $args['usu_id'] ?? null;
        $this->usu_nombre = $args['usu_nombre'] ?? '';
        $this->usu_catalogo = $args['usu_catalogo'] ?? null;
        $this->usu_password = $args['usu_password'] ?? '';
        $this->usu_situacion = $args['usu_situacion'] ?? 1;
    }

    public static function obtenerUsuariosActivos()
    {
        $sql = "SELECT * FROM usuario WHERE usu_situacion = 1";
        return self::fetchArray($sql);
    }
}
