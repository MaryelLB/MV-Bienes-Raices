<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raices</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>
<header class="header <?php echo $inicio ? 'inicio' : '' ?>">
    <div class="contenedor contenido-header">
        <div class="barra"> 
            <a href="Index.php">
                <img src="/build/img/logo.svg" alt="">
            </a>
            <div class="mobile-menu">
                <img src="/build/img/barras.svg" alt="icono meu-responsive">
            </div>
            <div class="derecha">
                <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="modoOscuro">
                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Anuncios</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                    <?php if($auth): ?>
                        <a href="/logout">Cerrar sesion</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div> <!--.barra-->
        <?php  echo $inicio ? "<h1>Venta de casas y departamentos exclusivos de lujo</h1>" : '';?>
    </div>
</header>

<?php echo $contenido; ?>

<footer class="footer seccion">
    <div class="contenedor contenedor--footer">
        <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
    </div>
    <p class="copyright">Todos los derechos reservados <?php echo date('Y') ?> &copy;</p>
</footer>
<script src="../build/js/bundle.min.js"></script>
</body>
</html>