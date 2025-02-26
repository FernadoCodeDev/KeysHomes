<?php
include  __DIR__ . '/../Config/DataBases.php';
$DB = conectarDB(); 
$query = "SELECT * FROM obras";
$ConsultaBD = mysqli_query($DB, $query);
?>


<main>
  <section >
      <h2>Todas Nuestras Propiedades</h2>

      <div class="AllAds">
          <?php while ($obra = mysqli_fetch_assoc($ConsultaBD)) : ?>

              <div class="Advertisement">
                  <img src="../../imagenesBD/<?php echo $obra['imagen']; ?>" alt="propiedad">
                  <div class="InfoAdvertisement">
                      <h3><?php echo $obra['titulo']; ?></h3>
                      <p class="price">$<?php echo $obra['precio']; ?></p>
                      <a href="Advertisement.php?id=<?php echo $obra['id']; ?>" class="button-tomato-block">Ver la propiedad</a>
                  </div>
              </div>

          <?php endwhile; ?>
      </div>
  </section>
</main>

<?php

mysqli_close($DB);
?>