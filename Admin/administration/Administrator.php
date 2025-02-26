<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: /');
  exit;
}

include '../../includes/Config/DataBases.php';
$DB = conectarDB();
include '../../includes/templades/Navigation.php';

$query = "SELECT * FROM obras";
$ConsultaBD = mysqli_query($DB, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

  if ($id) {
    $query = "SELECT imagen FROM obras WHERE id = {$id}";
    $resultado = mysqli_query($DB, $query);
    $obra = mysqli_fetch_assoc($resultado);

    if ($obra && file_exists('../../imagenesBD/' . $obra['imagen'])) {
      unlink('../../imagenesBD/' . $obra['imagen']);
    }

    $query = "DELETE FROM obras WHERE id = {$id}";
    $resultado = mysqli_query($DB, $query);

    if ($resultado) {
      header('Location: /Admin/administration/Administrator.php');
      exit;
    }
  }
}
?>


<main >
  <h1>Administrador de Keys Homes</h1>

  <a href="/Admin/administration/create.php" class="button-tomato-inline-block">Crear una Nueva Propiedad</a>

</main>
<!--Same classes as Properties.php. Everything is located in Properties.scss-->//
<section>
  <div class="AllAds">

    <?php while ($obra = mysqli_fetch_assoc($ConsultaBD)) : ?>

      <div class="Advertisement">
        <img src="../../imagenesBD/<?php echo $obra['imagen']; ?>" alt="Imagen de la obra">
        <div class="InfoAdvertisement">
          <h3><?php echo $obra['titulo']; ?></h3>
          <p><?php echo $obra['descripcion']; ?></p>
          <p class="price">$<?php echo $obra['precio']; ?></p>
        </div>
        <div class="AdministrationButtons">
            <a href="/Admin/administration/update.php?id=<?php echo $obra['id']; ?>" class="UpdateButton">Actualizar</a>

            <form method="post">
              <input type="hidden" name="id" value="<?php echo $obra['id']; ?>">
              <input type="submit" class="DeleteButton" value="Eliminar">
            </form>
          </div>
      </div>

    <?php endwhile; ?>
  </div>
</section>


<script src="/build/js/bundle.min.js"></script>

</body>

</html>
<?php
mysqli_close($DB);
include '../../includes/templades/footer.php';
?>