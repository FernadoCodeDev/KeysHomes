<?php
include  __DIR__ . '/../Config/DataBases.php';
$DB = conectarDB();
$query = "SELECT * FROM obras LIMIT $limite";
$ConsultaBD = mysqli_query($DB, $query);
?>

<div class="ContainerAds">
    <?php while ($obra = mysqli_fetch_assoc($ConsultaBD)) : ?>
        <div class="Advertisement">
            <img src="../../imagenesBD/<?php echo $obra['imagen']; ?>" alt="Image">
            <div class="ContentAdvertisement">
                <h3><?php echo $obra['titulo']; ?></h3>
                <p class="price">$<?php echo $obra['precio']; ?></p>
                <a href="Advertisement.php?id=<?php echo $obra['id']; ?>" class="button-tomato-block">Ver la propiedad</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php
//Cerrar la conexión
mysqli_close($DB);
?>