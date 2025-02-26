<?php
include  __DIR__ . '/../Config/DataBases.php';
$DB = conectarDB();
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /');
    exit;
}

$query = "SELECT * FROM obras WHERE id = {$id}";
$ConsultaBD = mysqli_query($DB, $query);

if ($ConsultaBD) {
    $obra = mysqli_fetch_assoc($ConsultaBD); 
} else {
    echo "Error en la consulta: " . mysqli_error($DB);
}

?>  
<!--Single Announcement.scss-->
<section>
    <h1>Conoce mejor la propiedad</h1>
    <div class="ContainerAdvertisement">
        <?php if ($obra): ?>
            <div class="Advertisement">
                <img src="../../imagenesBD/<?php echo $obra['imagen']; ?>" alt="Obra">

                <div class="AnnouncementInfo">
                    <h3><?php echo $obra['titulo']; ?></h3>
                    <p><?php echo $obra['descripcion']; ?></p>
                    <p class="price">$<?php echo $obra['precio']; ?></p>
                </div>
                <div class="PropertyContact">
                    <p>Te interesa la propiedad <span><?php echo $obra['titulo']; ?></span> Completa el Formulario</p>
                    <a href="contact.php" class="button-SeaGreen-inline-block">Formulario de Contacto</a>
                </div>
            </div>

        <?php else: ?>
            <h1>No se encontró ninguna Propiedad con ese ID.</h1>
        <?php endif; ?>
    </div>
</section>

<?php
mysqli_close($DB);
?>