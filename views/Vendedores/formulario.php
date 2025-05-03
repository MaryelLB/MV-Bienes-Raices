<fieldset>
            <legend>Informacion General</legend>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del Vendedor" value="<?php echo s($vendedor->nombre); ?>">

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido del Vendedor" value="<?php echo s($vendedor->apellido); ?>">

                <!-- <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
                <?php if($propiedad->imagen) {?>
                    <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
                <?php } ?> -->   
        </fieldset>

        <fieldset>
            <legend>Informacion extra</legend>
            <label for="telefono">Telefono</label>
            <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Telefono del Vendedor" value="<?php echo s($vendedor->telefono); ?>">

        </fieldset>
