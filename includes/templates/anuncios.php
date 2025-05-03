<?php 

use App\Propiedad;

if($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
    $anuncios = Propiedad::all();
} else {
    $anuncios = Propiedad::get(3);
}
?>


<div class="contenedor-anuncios">
    <?php foreach($anuncios as $anuncio) { ?>
        <div class="anuncio">
            <picture>
                <img loading="lazy" src="/imagenes/<?php echo $anuncio->imagen; ?>" alt="">
            </picture>
            <div class="contenido-anuncio">
                <h3><?php echo $anuncio->titulo ?></h3>
                <p><?php echo  $anuncio->descripcion ?></p>
                <p class="precio"><?php echo $anuncio->precio ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono-wc">
                        <p><?php echo $anuncio->wc ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono-estacionamiento">
                        <p><?php echo $anuncio->estacionamiento ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono-dormitorio">
                        <p><?php echo $anuncio->habitaciones ?></p>
                    </li>
                </ul>
                <a href="../../anuncio.php?id=<?php echo $anuncio->id ?>" class="boton-amarillo-block">
                    Ver propiedad
                </a>
            </div>
        </div> <!--Anuncio1-->
        <?php }; ?>
    </div> <!--Contenedor-Anuncio-->
