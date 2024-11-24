<?php

//Conexion a la base de datos
include  __DIR__ . '/../Config/DataBases.php';
$DB = conectarDB(); // Base de datos conectada 

//Escribir el Query

$query = "SELECT * FROM obras";

//Consultar la Base de datos

$ConsultaBD = mysqli_query($DB, $query);

?>


<main class="contenedor">
  <section >
      <h2>Todas Nuestras Porpiedades</h2>

      <div class="contenedor-propiedades-row">
          <?php while ($obra = mysqli_fetch_assoc($ConsultaBD)) : ?>

              <!-- Anuncio 1 -->
              <div class="propiedades">
                  <img src="../../imagenesBD/<?php echo $obra['imagen']; ?>" alt="propiedad">
                  <div class="contenido-propiedades">
                      <h3><?php echo $obra['titulo']; ?></h3>
                      <p class="precio">$<?php echo $obra['precio']; ?></p>
                      <a href="Unico-anuncio.php?id=<?php echo $obra['id']; ?>" class="boton-tomato-block">Ver la propiedad</a>
                  </div>
              </div>

          <?php endwhile; ?>
      </div>
  </section>
</main>

<?php
//Cerrar la conexión
mysqli_close($DB);
?>