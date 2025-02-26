<?php
if(!isset($_SESSION)) {
    session_start(); 
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

<div class="AllContent"> <!--start of the div with the AllContent class. The end is in Footer-->
   
<!--navigation.scss-->
   <header class="headerNavigation">
      <div class="contenido-header">
          <a href="../../Index.php">
              <img src="/src/Image/Keys Homes Logo.webp" class="KeysHomesLogo" alt="Keys Homes Logo">
          </a>
  
          <div class="mobileMenu">
              <img src="/src/Image/mobile menu.webp" alt="mobile menu">
          </div>
  
          <!--DARK MODE-->
          <div class="LunaIcon">
              <img src="/src/Image/Luna Icono.webp" class="DarkMode" alt="DarkMode">
          </div>  
  
          <nav class="navigation">
              <a href="../../Properties.php">Propiedades</a>
              <a href="../../Blog.php">Blog</a>
              <a href="../../AboutKeysHomes.php">Nosotros</a>
              <?php if($auth): ?>
                <a href="../../CloseSession.php">Cerrar sessión</a>
              <?php endif ?>
          </nav>
      </div>
    </header>