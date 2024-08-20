<?php

namespace Model;

class Permiso extends ActiveRecord
{
    protected static $tabla = 'permiso';
    protected static $idTabla = 'permiso_id';
    protected static $columnasDB = ['permiso_usuario', 'permiso_rol', 'permiso_situacion'];

    protected $permiso_id;
    protected $permiso_usuario;
    protected $permiso_rol;
    protected $permiso_situacion;

    public function __construct($args = [])
    {
        $this->permiso_id = $args['permiso_id'] ?? null;
        $this->permiso_usuario = $args['permiso_usuario'] ?? '';
        $this->permiso_rol = $args['permiso_rol'] ?? '';
        $this->permiso_situacion = $args['permiso_situacion'] ?? 1;
    }

   
    public function getPermisoId()
    {
        return $this->permiso_id;
    }

   
    public function setPermisoId($id)
    {
        $this->permiso_id = $id;
    }
}
