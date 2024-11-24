<?php
//Conexion a la base de datos
include  __DIR__ . '/../Config/DataBases.php';
$DB = conectarDB(); // Base de datos conectada 

//Validar ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /');
    exit; // Asegurarte de que el script no siga ejecutándose si no hay un ID válido
}

//Escribir el Query
$query = "SELECT * FROM obras WHERE id = ${id}";

//Consultar la Base de datos
$ConsultaBD = mysqli_query($DB, $query);

if ($ConsultaBD) {
    $obra = mysqli_fetch_assoc($ConsultaBD); // Asignar los datos de la obra a la variable
} else {
    echo "Error en la consulta: " . mysqli_error($DB); // Mostrar el error de SQL si la consulta falla
}

?>

<section class="seccion contenedor">
    <h1>Conoce mejor la propiedad</h1>
    <div class="contenedor-unico-anuncio">
        <?php if ($obra): ?> <!-- Verifica si hay una obra válida -->
            <!-- Unico Anuncio-->
            <div class="anuncio">
                <img src="../../imagenesBD/<?php echo $obra['imagen']; ?>" alt="Obra">

                <div class="resumen-anuncio">
                    <h3><?php echo $obra['titulo']; ?></h3>
                    <p><?php echo $obra['descripcion']; ?></p>
                    <p class="precio">$<?php echo $obra['precio']; ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>No se encontró ninguna obra con ese ID.</p>
        <?php endif; ?>
    </div>
</section>

<?php
//Cerrar la conexión
mysqli_close($DB);
?>
