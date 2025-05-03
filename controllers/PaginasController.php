<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        $anuncios = Propiedad::get(3);
        $inicio = true;
        $router->render('Paginas/index', [
            'anuncios' => $anuncios,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router) {
        $router->render('Paginas/nosotros', []);
    }
    public static function propiedades(Router $router) {
        $anuncios = Propiedad::all();
        $router->render('Paginas/propiedades',[
            'anuncios' => $anuncios
        ]);
    }
    public static function propiedad(Router $router) {
        $id=validarORedireccionar('/propiedades');
        $anuncio = Propiedad::find($id);
        $router->render('Paginas/propiedad', [
            'anuncio' => $anuncio
        ]);
    }
    public static function blog(Router $router) {
        $router->render('Paginas/blog', []);
    }
    public static function entrada(Router $router) {
        $router->render('Paginas/entrada',[]);
    }
    public static function contacto(Router $router) {
        $mensaje = null;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuesta = $_POST['contacto'];
            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io'; //Dominio
            $mail->SMTPAuth = true;
            $mail->Username = '0d9747b5869c87';
            $mail->Password = '5dee8f1e6526d3';
            $mail->SMTPSecure = 'tls'; //Encriptacion
            $mail->Port = '2525';

            //Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com','BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido  =  "<html>";
            $contenido .= "<p>Tienes un nuevo mensaje</p>";
            $contenido .= "<p>Nombre: " .$respuesta['nombre']. "</p>";
            
            //Enviar de forma condicional algunos campos de email o telefono

            if($respuesta['contacto'] === 'telefono') {
                $contenido .= "<p>Eligio ser contactado por telefono</p>";
                $contenido .= "<p>Telefono: " .$respuesta['telefono']. "</p>";
                $contenido .= "<p>Fecha: " .$respuesta['fecha']. "</p>";
                $contenido .= "<p>Hora: " .$respuesta['hora']. "</p>";
            } else {
                //Email
                $contenido .= "<p>Eligio ser contactado por email:</p>";
                $contenido .= "<p>Email: " .$respuesta['email']. "</p>";
            }
            $contenido .= "<p>Mensaje: " .$respuesta['mensaje']. "</p>";
            $contenido .= "<p>Vende o Compra: " .$respuesta['tipo']. "</p>";
            $contenido .= "<p>Precio o Presupuesto: $" .$respuesta['precio']. "</p>";
            $contenido .= "</html>";
            $mail->Body = $contenido; //El cuerpo del contenido
            $mail->AltBody = 'Esto es un texto alternativo sin HTML';
            
            //Enviar el email
            if($mail->send()) {
                $mensaje = 'Mensaje enviado correctamente';
            } else {
                $mensaje = 'El mensaje no se pudo enviar....';
            }
        }
        $router->render('Paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }

}