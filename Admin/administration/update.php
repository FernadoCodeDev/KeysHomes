<?php

session_start(); 
if (empty($_SESSION['login'])) {
    header('Location: /');
    exit; 
}
require '../../includes/Config/DataBases.php';

include '../../includes/templades/Navigation.php';

$DB = conectarDB(); 

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if(!$id) {
    header('Location: /Admin/administration/Administrator.php');
    exit(); 
}

//Obtener los datos de la obra actual
$consulta = "SELECT * FROM obras WHERE id = {$id}";
$datos = mysqli_query($DB, $consulta);
$resultado = mysqli_fetch_assoc($datos);

$TituloAntiguo = $resultado['titulo'];
$DescripcionAntigua = $resultado['descripcion'];
$PrecioAntiguo = $resultado['precio'];
$AutorAntiguo = $resultado['autor_id'];
$ImagenAntigua = $resultado['imagen'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errores = []; 
    $exito = ''; 

    $titulo = mysqli_real_escape_string($DB, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($DB, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($DB, $_POST['precio']);
    $nombreAutor = mysqli_real_escape_string($DB, $_POST['autor']); 

    if (empty($titulo) || empty($descripcion) || empty($precio) || empty($nombreAutor)) {
        $errores[] = 'Todos los campos son obligatorios.';
    }

    $imagen = $_FILES['imagen'];
    $nombreImagen = $ImagenAntigua; 

    if ($imagen['error'] === UPLOAD_ERR_OK) {
        $medida = 1024 * 4000; 

        if ($imagen['size'] > $medida) {
            $errores[] = 'La imagen es muy pesada, debe tener un peso menor a 4 MB.';
        } else {
            $carpetaImagenes = '../../imagenesBD/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes, 0755, true);
            }

            if (file_exists($carpetaImagenes . $ImagenAntigua)) {
                unlink($carpetaImagenes . $ImagenAntigua);
            }

            $nombreImagen = md5(uniqid(rand(), true)) . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        }
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

        $queryObra = "UPDATE obras SET titulo = '$titulo', descripcion = '$descripcion', precio = $precio, imagen = '$nombreImagen', autor_id = $autor_id WHERE id = $id";
        $resultadoObra = mysqli_query($DB, $queryObra);

        if ($resultadoObra) {
            $exito = "propiedad actualizada correctamente. :)"; 
        } else {
            $errores[] = "Error al actualizar la propiedad. :( " . mysqli_error($DB);
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
    <h1>Actualizar Propiedad</h1>

    <a href="/Admin/administration/Administrator.php" class="button-tomato-inline-block">Volver al administrador</a>
</main>

<div class="CreateAndUpdateForm">
    <form method="post" enctype="multipart/form-data">

        <div class="UploadImage">
            <img src="../../imagenesBD/<?php echo $ImagenAntigua; ?>" id="imagenpreview" class="ImagenPreview" name="imagenpreview" alt="Imagen actual de la propiedad">
            <div class="FileUpload">
                <label for="imagen" class="CustomFileUpload">Sube tu imagen</label>
                <input id="imagen" name="imagen" type="file" accept="image/*">
            </div>
        </div>
        <div class="FormFields">
            <div>
                <label for="titulo">Nombre de la Propiedad</label>
                <input type="text" id="titulo" name="titulo" required value="<?php echo $TituloAntiguo; ?>">
            </div>

            <div>
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" required><?php echo $DescripcionAntigua; ?></textarea>
            </div>
        </div>
        <div class="QuoteFormFields">
            <label for="autor">Vendedor</label>
            <input type="text" id="autor" name="autor" required value="<?php echo $AutorAntiguo; ?>">

            <label for="precio">Precio (USD):</label>
            <input type="number" id="precio" name="precio" min="1" required value="<?php echo $PrecioAntiguo; ?>">
        </div>
        <button type="submit">Actualizar Propiedad</button>

    </form>
</div>


<?php
include '../../includes/templades/footer.php';
?>

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