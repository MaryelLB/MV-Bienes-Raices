<?php
namespace Model;

class Vendedor extends activeRecord {
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id','nombre','apellido','telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = 'Debes ingresar un nombre';
        }
        if(!$this->apellido){
            self::$errores[] = 'Debes ingresar un apellido';
        }
        if(!$this->telefono){
            self::$errores[] = 'Debes ingresar un telefono';
        }
        if(!preg_match('/[0-9]{10}/',$this->telefono)) {
            self::$errores[] = 'Formato no valido del telefono';
        }

        return self::$errores;
    }
}