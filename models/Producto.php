<?php
namespace Model;

class Producto extends ActiveRecord {
    protected static $tabla = 'productos';
    protected static $idTabla = 'pro_id';
    protected static $columnasDB = ['prod_nombre', 'prod_precio', 'prod_situacion'];

    public $prod_id;
    public $prod_nombre;
    public $prod_precio;
    public $prod_situacion;

    public function __construct($args = [])
    {
        $this->prod_id = $args['prod_id'] ?? null;
        $this->prod_nombre = $args['prod_nombre'] ?? '';
        $this->prod_precio = $args['prod_precio'] ?? 0;
        $this->prod_situacion = $args['prod_situacion'] ?? 1;

        
    }
}
