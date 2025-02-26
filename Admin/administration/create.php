<?php

session_start(); 

if (empty($_SESSION['login'])) {
    header('Location: /');
    exit; 
}
require '../../includes/Config/DataBases.php';

include '../../includes/templades/Navigation.php';

$DB = conectarDB(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errores = []; 
    $exito = ''; 

    $titulo = mysqli_real_escape_string($DB, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($DB, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($DB, $_POST['precio']);
    $nombreAutor = mysqli_real_escape_string($DB, $_POST['autor']); 

    if (empty($titulo) || empty($descripcion) || empty($precio) || empty($nombreAutor)) {
        $errores[] = 'Todos los campos son obligatorios. Por favor, completa todos los campos. :)';
    }
    $imagen = $_FILES['imagen'];

    if ($imagen['error'] === UPLOAD_ERR_OK) {
        // Validar por tamaño (1000 KB)
        $medida = 1024 * 4000; 

        if ($imagen['size'] > $medida) {
            $errores[] = 'La imagen es muy pesada, la imagen debe tener un peso menor a 4 MB';
        } 

        $carpetaImagenes = '../../imagenesBD/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes, 0755, true); 
        }

        $nombreImagen = md5(uniqid(rand(), true)) . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);

        if (!move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen)) {
        } else {
        }

    } else {
        $errores[] = 'Hubo un error al subir la imagen, la imagen debe tener un peso menor a 4 MB';
    }
    if (empty($errores)) {
        $queryAutor = "SELECT id FROM autor WHERE nombre = '$nombreAutor'";
        $resultadoAutor = mysqli_query($DB, $queryAutor);

        if ($resultadoAutor->num_rows > 0) {
            $autor = mysqli_fetch_assoc($resultadoAutor);
            $autor_id = $autor['id'];
        } else {
            $queryNuevoAutor = "INSERT INTO autor (nombre) VALUES ('$nombreAutor')";
            $resultadoNuevoAutor = mysqli_query($DB, $queryNuevoAutor);

            $autor_id = mysqli_insert_id($DB);
        }

        $queryObra = "INSERT INTO obras (titulo, descripcion, precio, imagen, autor_id)
                      VALUES ('$titulo', '$descripcion', '$precio', '$nombreImagen', '$autor_id')";

        $resultadoObra = mysqli_query($DB, $queryObra);

        if ($resultadoObra) {
            $exito = "propiedad insertada correctamente :)"; 
        } else {
            $errores[] = "Error al insertar la propiedad :( " . mysqli_error($DB);
        }
    }

    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p class='ErrorAlert'>$error</p>";
        }
    } else if ($exito) {
        echo "<p class='SuccessAlert'>$exito</p>"; 
    }
}
?>


<main>
    <h1>Crear Nueva Propiedad</h1>
    
    <a href="/Admin/administration/Administrator.php" class="button-tomato-inline-block">Volver al administrador</a>
</main>

<div class="CreateAndUpdateForm">
  <form method="post" action="/Admin/Administration/create.php" enctype="multipart/form-data">

      <div class="UploadImage">
          <img src="../../src/Image/Sube Tu Imagen.webp" id="imagenpreview" class="ImagenPreview" name="imagenpreview" alt="Image">
          <div class="FileUpload">
              <label for="imagen" class="CustomFileUpload">Sube tu imagen</label>
              <input id="imagen" name="imagen" type="file" accept="image/*" required/>
          </div>
      </div>

      <div class="FormFields">
          <div>
              <label for="titulo">Nombre de la Propiedad</label>
              <input type="text" id="titulo" name="titulo" placeholder="Nombre de la propiedad" required>
          </div>

          <div>
              <label for="descripcion">Descripción</label>
              <textarea id="descripcion" name="descripcion" placeholder="Describe la propiedad" required></textarea>
          </div>
      </div>

      <div class="QuoteFormFields">
          <label for="autor">Vendedor</label>
          <input type="text" id="autor" name="autor" placeholder="Nombre del vendedor" required>

          <label for="precio">Precio (USD):</label>
          <input type="number" id="precio" name="precio" min="1" placeholder="Precio de la propiedad" required>
      </div>

      <button type="submit">Enviar Propiedad</button>

  </form>
</div>

<!--footer.scss-->
<?php
include '../../includes/templades/footer.php';
?>
</body>
</html>

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

