<?php 

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear(Router $router) {
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') { 
        //Crear una instancia
        $vendedor = new Vendedor($_POST['vendedor']);

        //Validar que los campos no esten vacios
        $errores = $vendedor->validar();

        //Si no hay errores
        if(empty($errores)) {
        //Guarda los registros
        $vendedor->guardar();
    }
}
        $router->render('Vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
}

public static function actualizar(Router $router) {
    $id = validarORedireccionar('/admin');
    $vendedor = Vendedor::find($id);
    //Arreglo de vendedores
    $errores = Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $args = $_POST['vendedor'];
    $vendedor->sincronizar($args);
     //Validacion
    $errores = $vendedor->validar();
    if(empty($errores)) { 
        $vendedor->crear();

    }
}
    $router->render('Vendedores/actualizar', [
        'vendedor' => $vendedor,
        'errores' => $errores
    ]);
}
public static function eliminar() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $tipo = $_POST['tipo'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id) {
            if(validarTipoContenido($tipo)) {
                    $propiedad = Vendedor::find($id);
                    $propiedad->eliminar();
            } 
        }
    }
}
}