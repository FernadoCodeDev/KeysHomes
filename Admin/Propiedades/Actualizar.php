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


//Conectar a la base de datos
$DB = conectarDB(); 

//Validar la URL por un ID válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /Admin/Propiedades/Administrador.php');
    exit(); 
}

//Obtener los datos de la obra actual
$consulta = "SELECT * FROM obras WHERE id = ${id}";
$datos = mysqli_query($DB, $consulta);
$resultado = mysqli_fetch_assoc($datos);

$TituloAntiguo = $resultado['titulo'];
$DescripcionAntigua = $resultado['descripcion'];
$PrecioAntiguo = $resultado['precio'];
$AutorAntiguo = $resultado['autor_id'];
$ImagenAntigua = $resultado['imagen'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Inicializar un array para almacenar los errores
    $errores = []; 
    $exito = ''; 

    // Obtener datos actualizados del formulario
    $titulo = mysqli_real_escape_string($DB, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($DB, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($DB, $_POST['precio']);
    $nombreAutor = mysqli_real_escape_string($DB, $_POST['autor']); 

    // Validar si los campos están vacíos
    if (empty($titulo) || empty($descripcion) || empty($precio) || empty($nombreAutor)) {
        $errores[] = 'Todos los campos son obligatorios.';
    }

    // Manejar la imagen
    $imagen = $_FILES['imagen'];
    $nombreImagen = $ImagenAntigua; // Mantener la imagen anterior por defecto

    if ($imagen['error'] === UPLOAD_ERR_OK) {
        // Validar tamaño de la imagen (1000 KB)
        $medida = 1024 * 4000; 

        if ($imagen['size'] > $medida) {
            $errores[] = 'La imagen es muy pesada, debe tener un peso menor a 4 MB.';
        } else {
            // Crear la carpeta de imágenes si no existe
            $carpetaImagenes = '../../imagenesBD/';
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes, 0755, true);
            }

            // Eliminar la imagen anterior si existe
            if (file_exists($carpetaImagenes . $ImagenAntigua)) {
                unlink($carpetaImagenes . $ImagenAntigua);
            }

            // Subir la nueva imagen
            $nombreImagen = md5(uniqid(rand(), true)) . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        }
    }

    // Si no hay errores, actualizar los datos
    if (empty($errores)) {
        // Verifica si el autor ya existe
        $queryAutor = "SELECT id FROM autor WHERE nombre = '$nombreAutor'";
        $resultadoAutor = mysqli_query($DB, $queryAutor);

        if ($resultadoAutor->num_rows > 0) {
            $autor = mysqli_fetch_assoc($resultadoAutor);
            $autor_id = $autor['id'];
        } else {
            // Insertar un nuevo autor
            $queryNuevoAutor = "INSERT INTO autor (nombre) VALUES ('$nombreAutor')";
            $resultadoNuevoAutor = mysqli_query($DB, $queryNuevoAutor);
            $autor_id = mysqli_insert_id($DB);
        }

        // Actualizar la obra, incluyendo la nueva imagen
        $queryObra = "UPDATE obras SET titulo = '$titulo', descripcion = '$descripcion', precio = $precio, imagen = '$nombreImagen', autor_id = $autor_id WHERE id = $id";
        $resultadoObra = mysqli_query($DB, $queryObra);

        if ($resultadoObra) {
            $exito = "propiedad actualizada correctamente. :)"; 
        } else {
            $errores[] = "Error al actualizar la propiedad. :( " . mysqli_error($DB);
        }
    }

    // Mostrar mensajes de error o éxito
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p class='mensaje-error'>$error</p>";
        }
    } else if ($exito) {
        echo "<p class='mensaje-exito'>$exito</p>";
    }
}
?>



<main class="contenedor">
    <h1>Actualizar</h1>

    <a href="/Admin/Propiedades/Administrador.php" class="boton-tomato-inline-block">Volver al administrador</a>
</main>

<!--Formlario Viejo CON EL Código de PHP Y la U del CRUD-->
<!--Formulario Combinado-->
<div class="formulario-crear-propiedad">
    <legend class="text-form">Actualiza los datos de la propiedad</legend>
    <form method="post" enctype="multipart/form-data">

        <!-- Imagen de la propiedad -->
        <div class="Img-propiedad">
            <legend>Sube una imagen de la propiedad</legend>
            <img src="../../imagenesBD/<?php echo $ImagenAntigua; ?>" id="imagenpreview" class="imagenpreview" name="imagenpreview" alt="Imagen actual de la propiedad">
            <div class="file-upload">
                <label for="imagen" class="custom-file-upload">Sube tu imagen</label>
                <input id="imagen" name="imagen" type="file" accept="image/*">
            </div>
        </div>

        <!-- Información de la propiedad -->
        <div class="Informacion-de-la-propiedad">
            <div>
                <label for="titulo">Nombre de la Propiedad</label>
                <input type="text" id="titulo" name="titulo" required value="<?php echo $TituloAntiguo; ?>">
            </div>

            <div>
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" required><?php echo $DescripcionAntigua; ?></textarea>
            </div>
        </div>

        <!-- Información del vendedor -->
        <div class="Informacion-del-vendedor">
            <label for="autor">Vendedor</label>
            <input type="text" id="autor" name="autor" required value="<?php echo $AutorAntiguo; ?>">

            <label for="precio">Precio (USD):</label>
            <input type="number" id="precio" name="precio" min="1" required value="<?php echo $PrecioAntiguo; ?>">
        </div>

        <!-- Botón de actualización -->
        <button type="submit" class="Boton-enviar-propiedad">Actualizar Propiedad</button>

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