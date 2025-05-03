<?php
namespace Model;

class admin extends activeRecord {
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columndasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {

        if(!$this->email) {
            self::$errores [] = 'El email es obligatorio o no es valido';
        }
        if(!$this->password) {
            self::$errores [] = 'El password es obligatorio o no es valido';
        }

        return self::$errores;
    }
    public function existeUsuario(){
        //Revisar si el usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "'LIMIT 1";
        $resultado = self::$db->query($query);
        
        if(!$resultado->num_rows) {
            //Verificar si el usuario existe
            self::$errores[] = 'El usuario no existe';
            return;
        }
        return $resultado;
    }
    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object();
        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado) {
            self::$errores[] = 'El password es incorrecto';
        }

        return $autenticado;
    }
    public function autenticar() {
        session_start();

        //Llenar el arreglo
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');

    }

}