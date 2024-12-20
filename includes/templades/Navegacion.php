<?php
if(!isset($_SESSION)) {
    session_start(); // Iniciar sesión
}

$auth = $_SESSION['login'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="src/Image/Keys Homes Logo Web.webp" type="image/webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="/build/css/app.css">

    <title>Keys Homes</title>
</head>
<body>

   <!--navegacion.scss-->
   <header class="header-Navegacion">
      <div class="contenido-header">
          <a href="../../Index.php">
              <img src="/src/Image/Keys Homes Logo.webp" class="Keys-Homes-Logo" alt="Keys Homes Logo">
          </a>
  
          <div class="mobile-menu">
              <img src="/src/Image/mobile menu.webp" alt="mobile menu">
          </div>
  
          <!--DARK MODE-->
          <div class="LunaIcono">
              <img src="/src/Image/Luna Icono.webp" class="DarkMode" alt="DarkMode">
          </div>
  
          <nav class="navegacion">
              <a href="../../Propiedades.php">Propiedades</a>
              <a href="../../Blog.php">Blog</a>
              <a href="../../Sobre-Keys-Homes.php">Nosotros</a>
              <?php if($auth): ?>
                <a href="../../cerrar-sesion.php">Cerrar sessión</a>
              <?php endif ?>
          </nav>
      </div>
    </header>