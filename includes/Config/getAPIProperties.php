<?php
include __DIR__ . '/DataBases.php';
$DB = conectarDB();

$query = "SELECT id, titulo, imagen FROM obras";  
$result = mysqli_query($DB, $query);

$properties = [];

while ($obra = mysqli_fetch_assoc($result)) {
    $properties[] = [
        'id' => $obra['id'],
        'titulo' => $obra['titulo'],
        'imagen' => $obra['imagen']
    ];
}

header('Content-Type: application/json');
echo json_encode($properties);

mysqli_close($DB);
?>

