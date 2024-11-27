<?php
session_start(); // Iniciar sesión

// Verificar si el usuario está autenticado
if (empty($_SESSION['login'])) {
    // Redirigir a la página de inicio si no hay sesión iniciada
    header('Location: /');
    exit; // Detener ejecución después de la redirección
}

// Conexión a la base de datos
include '../../includes/Config/DataBases.php';
$DB = conectarDB(); 

// Navegación
include '../../includes/templades/Navegacion.php';

$query = "SELECT * FROM obras";
$ConsultaBD = mysqli_query($DB, $query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

    if ($id) {
        // Eliminar el archivo de imagen
        $query = "SELECT imagen FROM obras WHERE id = {$id}";
        $resultado = mysqli_query($DB, $query);
        $obra = mysqli_fetch_assoc($resultado);

        if ($obra && file_exists('../../imagenesBD/' . $obra['imagen'])) {
            unlink('../../imagenesBD/' . $obra['imagen']);
        }

        // Eliminar la propiedad
        $query = "DELETE FROM obras WHERE id = {$id}";
        $resultado = mysqli_query($DB, $query);

        if ($resultado) {
            header('Location: /Admin/propiedades/Administrador.php');
            exit;
        }
    }
}
?>


<main class="contenedor">
  <h1>Administrador de Keys Homes</h1>

  <a href="/Admin/propiedades/crear.php" class="boton-tomato-inline-block">Crear una Nueva Propiedad</a>

</main>

<section class="seccion contenedor">
  <div class="contenedor-publicaciones-AdminPHP">

    <?php while ($obra = mysqli_fetch_assoc($ConsultaBD)) : ?>

      <div class="anuncio-AdminPHP">
        <pinture>
          <img class="image-adminPHP" src="../../imagenesBD/<?php echo $obra['imagen']; ?>" alt="Imagen de la obra">
        </pinture>
        <h1 class="titulo-AdminPHP"><?php echo $obra['titulo']; ?></h1>
        <p class="descripcion-AdminPHP"><?php echo $obra['descripcion']; ?></p>

        <div class="id-and-precio">
          <p class="precio-AdminPHP">$<?php echo $obra['precio']; ?></p>
        </div>

        <div class="boton-adminPHP">
          <a href="/Admin/propiedades/Actualizar.php?id=<?php echo $obra['id']; ?>" class="boton-Actualizar-AdminPHP">Actualizar</a>

          <form method="post" class="form-bt-eliminar">
              <input type="hidden" name="id" value="<?php echo $obra['id'];?>">
            <input type="submit" class="boton-Eliminar-AdminPHP" value="Eliminar">
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

//Cerrar la conexión
mysqli_close($DB);
//footer
include '../../includes/templades/footer.php';
?>