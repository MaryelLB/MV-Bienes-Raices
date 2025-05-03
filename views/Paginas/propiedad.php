<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $anuncio->titulo ?></h1>
            <picture>
                <img loading="lazy" src="imagenes/<?php echo $anuncio->imagen ?>" alt="I">
            </picture>
        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $anuncio->precio ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono"  loading="lazy" src="build/img/icono_wc.svg" alt="icono-wc">
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

            <p><?php echo $anuncio->descripcion ?></p>
        </div>
</main>