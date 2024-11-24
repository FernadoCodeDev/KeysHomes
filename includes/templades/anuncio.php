<?php

//Conexion a la base de datos
include  __DIR__ . '/../Config/DataBases.php';
$DB = conectarDB(); // Base de datos conectada 

//Escribir el Query

$query = "SELECT * FROM obras LIMIT $limite";

//Consultar la Base de datos

$ConsultaBD = mysqli_query($DB, $query);


//<?php echo $obra['id']; ID
?>

    
<div class="contenedor-anuncios">
    <?php while ($obra = mysqli_fetch_assoc($ConsultaBD)) : ?>
        <!-- Anuncio 1 -->
        <div class="anuncio">

            <img src="../../imagenesBD/<?php echo $obra['imagen']; ?>" alt="Nuevo nombre">
            
            <div class="contenido-anuncio">
                <h3><?php echo $obra['titulo']; ?></h3>
                <p class="precio">$<?php echo $obra['precio']; ?></p>
                <!--<p>ID</p>-->
                <a href="Unico-anuncio.php?id=<?php echo $obra['id']; ?>" class="boton-tomato-block">Ver la propiedad</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>


<?php
//Cerrar la conexión
mysqli_close($DB);
?>