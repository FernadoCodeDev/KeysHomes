<?php
if (!isset($_SESSION)) {
    session_start(); // Iniciar sesión
}

$auth = $_SESSION['login'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="src/Image/Keys Homes Logo Web.webp" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Keys Homes</title>
</head>

<body>

    <!--header.sss-->
    <header class="header">
        <div class="contenido-header">
            <a href="../../Index.php">
                <img src="src/Image/Keys Homes Logo.webp" class="Keys-Homes-Logo" alt="Keys Homes Logo">
            </a>

            <div class="mobile-menu">
                <img src="src/Image/mobile menu.webp" alt="Mobile Menu">
            </div>

            <!-- DARK MODE -->
            <div class="dark-mode-icon">
                <img src="src/Image/Luna Icono.webp" class="DarkMode" alt="Dark Mode">
            </div>

            <nav class="navegacion">
                <a href="../../Propiedades.php">Propiedades</a>
                <a href="../../Blog.php">Blog</a>
                <a href="../../Sobre-Keys-Homes.php">Nosotros</a>
                <?php if ($auth): ?>
                    <a href="../../cerrar-sesion.php">Cerrar sesión</a>
                <?php endif ?>
            </nav>

            <div class="general-information-KeysHomes">
                <div class="information-KeysHomes">
                    <h3>--Welcome Keys Homes</h3>
                    <h1>Nosotros tomamos el control de su sueño, su hogar & <span class="transparent-text">todo es muy fácil</span></h1>
                    <p>Nuestros agentes tienen un amplio conocimiento del mercado inmobiliario local y le brindaremos información valiosa sobre los vecindarios, casas y otros factores importantes que podrían afectar su decisión</p>
                    <div class="botones-info">
                        <a href="../../Propiedades.php" >
                            <button class="Ver-Propiedades">Ver propiedades</button>
                        </a>
                        <a href="#Data-KeysHomes">
                            <button class="Leer-más">Leer más</button>
                        </a>
                    </div>
                </div>
                <img src="src/Image/Edificio.webp" class="Edificio" alt="Edificio">
            </div>
        </div>
        <img src="src/Image/Background Green.webp" alt="Fondo principal" class="fondo-principal">

    </header>