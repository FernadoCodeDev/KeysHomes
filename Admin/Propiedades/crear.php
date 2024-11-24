<?php
// Backend
require '../../includes/Config/DataBases.php';

//navegación
include '../../includes/templades/Navegacion.php';

session_start(); // Iniciar sesión

// Verificar si el usuario está autenticado
$auth = isset($_SESSION['login']) ? $_SESSION['login'] : false; // Verifica si la clave existe

if (!$auth) {
    // Redirigir a la página de inicio si no hay sesión iniciada
    header('Location: /');
}


//Code for this file
$DB = conectarDB(); // Base de datos conectada 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Inicializar un array para almacenar los errores
    $errores = []; // Variable para el mensaje de error
    $exito = ''; // Variable para el mensaje de éxito

    // Acceder a los datos de $_POST correctamente
    $titulo = mysqli_real_escape_string($DB, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($DB, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($DB, $_POST['precio']);
    $nombreAutor = mysqli_real_escape_string($DB, $_POST['autor']); // Nombre completo del autor

    // Verificar si los campos están vacíos
    if (empty($titulo) || empty($descripcion) || empty($precio) || empty($nombreAutor)) {
        $errores[] = 'Todos los campos son obligatorios. Por favor, completa todos los campos. :)';
    }

    // Asignar imagen a una variable
    $imagen = $_FILES['imagen'];

    // Validar si la imagen fue subida 
    if ($imagen['error'] === UPLOAD_ERR_OK) {
        // Validar por tamaño (1000 KB)
        $medida = 1024 * 4000; // 1000 KB exactos

        if ($imagen['size'] > $medida) {
            $errores[] = 'La imagen es muy pesada, la imagen debe tener un peso menor a 4 MB';
        } 

        // SUBIDA DE ARCHIVOS
        // CREAR CARPETA
        $carpetaImagenes = '../../imagenesBD/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes, 0755, true); // Crear la carpeta si no existe
        }

        // Generar un nombre único a la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);

        // Subir la imagen
        if (!move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen)) {
            //$errores[] = "Error al subir el archivo.";
        } else {
            //echo "Imagen subida con éxito.";
        }

    } else {
        $errores[] = 'Hubo un error al subir la imagen, la imagen debe tener un peso menor a 4 MB';
    }

    // Si no hay errores, realizar el proceso de inserción y mostrar éxito
    if (empty($errores)) {
        // Verifica si el autor ya existe en la base de datos
        $queryAutor = "SELECT id FROM autor WHERE nombre = '$nombreAutor'";
        $resultadoAutor = mysqli_query($DB, $queryAutor);

        if ($resultadoAutor->num_rows > 0) {
            // Si el autor existe, obtenemos su id
            $autor = mysqli_fetch_assoc($resultadoAutor);
            $autor_id = $autor['id'];
        } else {
            // Si el autor no existe, lo insertamos en la tabla autor
            $queryNuevoAutor = "INSERT INTO autor (nombre) VALUES ('$nombreAutor')";
            $resultadoNuevoAutor = mysqli_query($DB, $queryNuevoAutor);

            // Obtenemos el id del autor recién insertado
            $autor_id = mysqli_insert_id($DB);
        }

        // Insertar la nueva obra con el autor_id
        $queryObra = "INSERT INTO obras (titulo, descripcion, precio, imagen, autor_id)
                      VALUES ('$titulo', '$descripcion', '$precio', '$nombreImagen', '$autor_id')";

        $resultadoObra = mysqli_query($DB, $queryObra);

        if ($resultadoObra) {
            $exito = "propiedad insertada correctamente :)"; // Mensaje de éxito
        } else {
            $errores[] = "Error al insertar la propiedad :( " . mysqli_error($DB);
        }
    }

    // Mostrar los mensajes de error o éxito
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p class='mensaje-error'>$error</p>";
        }
    } else if ($exito) {
        echo "<p class='mensaje-exito'>$exito</p>"; // Mostrar mensaje de éxito
    }
}
?>


<main class="contenedor">
    <h1>crear Nueva Propiedad</h1>
    
    <a href="/Admin/Propiedades/Administrador.php" class="boton-tomato-inline-block">Volver al administrador</a>
</main>

<!--Formlario Nuevo C del CRUD-->
<div class="formulario-crear-propiedad">
  <legend class="text-form">Coloca los datos de la propiedad</legend>
  <form method="post" action="/Admin/Propiedades/crear.php" enctype="multipart/form-data">

      <div class="Img-propiedad">
          <legend>Sube una imagen de la propiedad</legend>
          <img src="../../src/Image/Sube Tu Imagen.png" id="imagenpreview" class="imagenpreview" name="imagenpreview" alt="Image">
          <div class="file-upload">
              <label for="imagen" class="custom-file-upload">Sube tu imagen</label>
              <input id="imagen" name="imagen" type="file" accept="image/*" required/>
          </div>
      </div>

      <div class="Informacion-de-la-propiedad">
          <div>
              <label for="titulo">Nombre de la Propiedad</label>
              <input type="text" id="titulo" name="titulo" required>
          </div>

          <div>
              <label for="descripcion">Descripción</label>
              <textarea id="descripcion" name="descripcion" required></textarea>
          </div>
      </div>

      <div class="Informacion-del-vendedor">
          <label for="autor">Vendedor</label>
          <input type="text" id="autor" name="autor" required>

          <label for="precio">Precio (USD):</label>
          <input type="number" id="precio" name="precio" min="1" required>
      </div>

      <button type="submit" class="Boton-enviar-propiedad">Enviar Propiedad</button>

  </form>
</div>

<!--footer.scss-->
<?php
include '../../includes/templades/footer.php';
?>

<!--Función de vista previa-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('imagen').addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = document.getElementById('imagenpreview');
                img.src = e.target.result;
                img.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        }
    });
  });
</script>
<script src="../../build/js/bundle.min.js"></script>

</body>
</html>