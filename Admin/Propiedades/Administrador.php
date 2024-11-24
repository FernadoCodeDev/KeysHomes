<?php
// Navegación
include '../../includes/templades/Navegacion.php';

// Conexión a la base de datos
require '../../includes/Config/DataBases.php';
$DB = conectarDB(); // Base de datos conectada 

$exito = ''; // Variable para el mensaje de éxito

session_start(); // Iniciar sesión

// Verificar si el usuario está autenticado
$auth = isset($_SESSION['login']) ? $_SESSION['login'] : false; // Verifica si la clave existe
$exito = 'Bienvenido al administrador';
if (!$auth) {
    // Redirigir a la página de inicio si no hay sesión iniciada
    header('Location: /');
}


//Escribir el Query

$query = "SELECT * FROM obras";

//Consultar la Base de datos

$ConsultaBD = mysqli_query($DB, $query);

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if($id) {

    //Eliminar el archivo
    $query = "SELECT imagen FROM obras WHERE id = ${id}";

    $resultado = mysqli_query($DB, $query);
    $obra = mysqli_fetch_assoc($resultado);

    unlink('../../imagenesBD/' . $obra['imagen']);

    //Eliminar la obra
    $query = "DELETE FROM obras WHERE id = ${id}";
   $resultado = mysqli_query($DB, $query);
   
   if($resultado) {
    header('location: /Admin/Propiedades/Administrador.php');
   }
  }
}

// Mostrar los mensajes de error o éxito
if (!empty($errores)) {
  foreach ($errores as $error) {
      echo "<p class='mensaje-error'>$error</p>";
  }
} else if ($exito) {
  echo "<p class='mensaje-exito'>$exito</p>"; 
}

?>

<main class="contenedor">
  <h1>Administrador de Keys Homes</h1>

  <a href="/Admin/Propiedades/crear.php" class="boton-tomato-inline-block">Crear una Nueva Propiedad</a>

</main>

<!--AdministradorPHP.Scss-->
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
          <a href="/Admin/Propiedades/Actualizar.php?id=<?php echo $obra['id']; ?>" class="boton-Actualizar-AdminPHP">Actualizar</a>

          <!-- Nuevas etiquetas -->
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