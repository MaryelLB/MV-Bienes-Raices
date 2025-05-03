<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadController {

    public static function index(Router $router) {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('Propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }
    public static function crear(Router $router) {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);
             //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true) ) . ".jpg";
             //Subir la imagen
             //debuguear($_FILES);
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            //debuguear(CARPETA_IMAGENES);
    
            $errores = $propiedad->validar();
            //Revisar que el arreglo de errores este vacio
            if(empty($errores)) {
                //Subida de los archivos
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                //debuguear(CARPETA_IMAGENES);
                $imagen->save(CARPETA_IMAGENES. $nombreImagen);
                //Insertar en la base de datos
            $propiedad->crear();
        }
        }

        $router->render('Propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        //Consulta para obtener los datos de los vendedores
        $vendedores = Vendedor::all();
        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        //METODO POST PARA ACTUALIZAR
        //Ejecutar el codigo despues del que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Asignar los atributos
        $args = $_POST['propiedad'];
        $propiedad->sincronizar($args);
        //Validacion
        $errores = $propiedad->validar();
        //Generar el nombre unico
        $nombreImagen = md5(uniqid(rand(), true) ) . ".jpg";
        //Subir la imagen
        //Subida de archivos
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
        }
        //Revisar que el arreglo de errores este vacio
        if(empty($errores)) {
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }   
            $propiedad->crear();
    }
    }

    $router->render('Propiedades/actualizar', [
        'propiedad' => $propiedad,
        'vendedores' => $vendedores,
        'errores' => $errores
    ]);


    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $tipo = $_POST['tipo'];
            if($id) {
                if(validarTipoContenido($tipo)) {
                        $propiedad = Propiedad::find($id);
                        $propiedad->eliminar();
                } 
            }
        }
    }

}